<?php
class PatchManager {
	public static function buildPatch(StructureDiff $diff, $user, $time = time) {
		
	}
	
	public static function executePatch(Database $db, $patch) {
		$patch = new Patch($patch);
		// TODO
	}
}

/*************************************\
              PATCH BASE
\*************************************/

class Patch {
	private $instructions = array();
	
	public function __construct($patch = null) {
		if ($patch == null) {
			// do nothing
		} else {
			$this->addPatch($patch);
		}
	}
	
	public function getInstructions() {
		return $this->instructions;
	}
	
	public function addPatch($patch) {
		$prefix = "#^(";
		$suffix = ")(?:\n.*)?$#s";
		while(!empty($patch)) {
			$patch = trim($patch);
			$rootInstructions = array(
				new PatchComment(),
				new PatchAttributes(),
				new PatchAddField(),
				new PatchRemoveField(),
				new PatchSetClassKey(),
				new PatchAddRecord(),
				new PatchRemoveRecord(),
				new PatchChangeRecordField(),
				new PatchChangeFieldType(),
				new PatchChangeFieldMandatory(),
			);
			$instruction = null;
			$matches = array();
			do {
				$instruction = array_shift($rootInstructions);
			} while($instruction != null && !preg_match($prefix.$instruction->getFormattedRegex('#').$suffix, $patch, $matches));
			
			if ($instruction != null) {
				$extract = $matches[1];
				$instruction->setValue($extract);
				$instruction->execute(Database::getDefaultDatabase());
				$this->instructions[] = $instruction;
				$patch = substr($patch, strlen($extract));
				/*
				echo '<b>'.$in->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
				echo '<br/>';
				continue;
			} else {
				throw new Exception("The given patch cannot be parsed from there: $patch");
			}
		}
	}
	
	public static function protectStringValue($value) {
		$value = str_replace('\\', '\\\\', $value);
		$value = str_replace('"', '\\"', $value);
		$value = '"'.$value.'"';
		return $value;
	}
	
	public static function cleanStringValue($value) {
		$value = substr($value, 1, -1);
		$value = str_replace('\\"', '"', $value);
		$value = str_replace('\\\\', '\\', $value);
		return $value;
	}
}

abstract class PatchInstruction {
	abstract protected function getRegex();
	abstract protected function applyValue($value);
	
	private $value;
	public function setValue($value) {
		if ($this->isSyntaxicallyCompatible($value)) {
			$this->value = $value;
			$this->applyValue($value);
		} else {
			throw new Exception("Incompatible value for ".get_class($this).": $value");
		}
	}
	
	public function getValue() {
		return $this->value;
	}
	
	public static function formatRegex($regex, $delimiter) {
		if (strlen($delimiter) > 1) {
			throw new Exception("The delimiter should be a single character");
		} else if ($delimiter == ' ' || $delimiter == '\\') {
			throw new Exception("The delimiter cannot be a space nor a backslash");
		} else {
			return str_replace($delimiter, '\\'.$delimiter, $regex);
		}
	}
	
	public static function toInstructionOnly($array) {
		$result = array();
		foreach($array as $element) {
			if (is_string($element)) {
				$result[] = new TextPatchInstruction($element);
			} else if ($element instanceof PatchInstruction) {
				$result[] = $element;
			} else {
				throw new Exception("$element is not an instruction");
			}
		}
		return $result;
	}
	
	public function getFormattedRegex($delimiter) {
		return PatchInstruction::formatRegex($this->getRegex(), $delimiter);
	}
	
	public function isSyntaxicallyCompatible($value) {
		return preg_match('#^'.$this->getFormattedRegex('#').'$#s', $value);
	}
}

/*************************************\
           REGEX INSTRUCTIONS
\*************************************/

abstract class RegexPatchInstruction extends PatchInstruction {
	protected function applyValue($instruction) {
		// nothing to do
	}
}

class PatchClass extends RegexPatchInstruction {
	protected function getRegex() {
		return '[0-9a-zA-Z]+';
	}
}

class PatchField extends RegexPatchInstruction {
	protected function getRegex() {
		return '[0-9a-zA-Z]+';
	}
}

class PatchFieldType extends RegexPatchInstruction {
	protected function getRegex() {
		return '[0-9a-zA-Z]+';
	}
}

class PatchFieldTypeValue extends RegexPatchInstruction {
	protected function getRegex() {
		return '(?:boolean)|(?:integer)|(?:double)|(?:array)|(?:resource)|(?:string(?:[1-9][0-9]*)?)';
	}
}

class PatchStringValue extends RegexPatchInstruction {
	protected function getRegex() {
		return '"(?:[^\\\\"]|(?:\\\\")|(?:\\\\\\\\))*"';
	}
}

class PatchIntegerValue extends RegexPatchInstruction {
	protected function getRegex() {
		return '[0-9]+';
	}
}

/*************************************\
        COMPOSED INSTRUCTIONS
\*************************************/

class ComposedPatchInstruction extends PatchInstruction {
	private $innerInstructions;
	
	public function __construct() {
		$this->innerInstructions = PatchInstruction::toInstructionOnly(func_get_args());
	}
	
	function __clone() {
		$innerInstructions = array();
		foreach($this->innerInstructions as $element) {
			$innerInstructions[] = clone $element;
		}
		$this->innerInstructions = $innerInstructions;
	}
	
	public function getInnerInstructions() {
		return $this->innerInstructions;
	}
	
	public function getInnerInstruction($index) {
		return $this->innerInstructions[$index];
	}
	
	private function generateRegex($catchInnerInstructions = false) {
		$globalRegex = "";
		foreach($this->innerInstructions as $element) {
			$regex = $element->getRegex();
			$regex = $catchInnerInstructions ? "($regex)" : "(?:$regex)";
			$globalRegex .= $regex;
		}
		return $globalRegex;
	}
	
	public function getInnerValues() {
		$innerValues = array();
		foreach($this->innerInstructions as $instruction) {
			$innerValues[] = $instruction->getValue();
		}
		return $innerValues;
	}
	
	public function getInnerValue($index) {
		return $this->innerInstructions[$index]->getValue();
	}
	
	protected function applyValue($instruction) {
		$regex = $this->generateRegex(true);
		preg_match('#^'.PatchInstruction::formatRegex($regex, '#').'$#s', $instruction, $matches);
		array_shift($matches); // remove the full match
		foreach($this->innerInstructions as $instruction) {
			$instruction->setValue(array_shift($matches));
		}
	}
	
	protected function getRegex() {
		return $this->generateRegex(false);
	}
	
	
}

class PatchSelectField extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct(new PatchClass(),'.',new PatchField());
	}
	
	public function getClass() {
		return $this->getInnerValue(0);
	}
	
	public function getField() {
		return $this->getInnerValue(2);
	}
}

class PatchIDFields extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct('[',new ListPatchInstruction(new PatchField(),','),']');
	}
	
	public function getIDFields() {
		return $this->getInnerInstruction(1)->getAllValues();
	}
}

class PatchIDValues extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct('[',new ListPatchInstruction(new PatchBasicValue(),','),']');
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(1)->getAllValues();
	}
}

class PatchFieldValueAssignment extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct(new PatchField(),'=',new PatchFieldValue());
	}
	
	public function getField() {
		return $this->getInnerValue(0);
	}
	
	public function getFieldValue() {
		return $this->getInnerValue(2);
	}
}

class PatchChainFieldValueAssignment extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct('(',new ListPatchInstruction(new PatchFieldValueAssignment(),','),')');
	}
	
	public function getAssignments() {
		$assignments = array();
		foreach($this->getInnerInstruction(1)->getAllInstructions() as $instruction) {
			$assignments[$instruction->getField()] = $instruction->getFieldValue();
		}
		return $assignments;
	}
}

class PatchSelectRecordField extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct(new PatchSelectRecord(),'.',new PatchField());
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(0)->getIDValues();
	}
	
	public function getField() {
		return $this->getInnerValue(2);
	}
}

class PatchSelectRecord extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct(new PatchClass(),new PatchIDValues());
	}
	
	public function getClass() {
		return $this->getInnerValue(0);
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(1)->getIDValues();
	}
}

/*************************************\
 ALTERNATIVE INSTRUCTIONS (... OR ...)
\*************************************/

class AlternativePatchInstruction extends PatchInstruction {
	private $alternatives;
	private $compatibleInstruction;
	
	public function __construct() {
		$this->alternatives = PatchInstruction::toInstructionOnly(func_get_args());
	}
	
	function __clone() {
		$alternatives = array();
		foreach($this->alternatives as $element) {
			$alternatives[] = clone $element;
		}
		$this->alternatives = $alternatives;
		$this->compatibleInstruction = $this->compatibleInstruction === null ? null : clone $this->compatibleInstruction;
	}
	
	public function getAlternatives() {
		return $this->alternatives;
	}
	
	protected function getRegex() {
		$globaleRegex = "";
		foreach($this->alternatives as $instruction) {
			$regex = $instruction->getRegex();
			$globaleRegex .= "|(?:$regex)";
		}
		$globaleRegex = substr($globaleRegex, 1);
		return "(?:$globaleRegex)";
	}
	
	protected function applyValue($value) {
		foreach($this->alternatives as $instruction) {
			if ($instruction->isSyntaxicallyCompatible($value)) {
				$instruction->setValue($value);
				$this->compatibleInstruction = $instruction;
			} else {
				continue;
			}
		}
	}
	
	public function getCompatibleInstruction() {
		return $this->compatibleInstruction;
	}
}

class PatchBasicValue extends AlternativePatchInstruction {
	// TODO add variables or manage recursivity in order to manage not restricted only
	public function __construct() {
		parent::__construct(
				new PatchStringValue(),
				new PatchBooleanValue(),
				new PatchIntegerValue()
		);
	}
}

class PatchFieldValue extends AlternativePatchInstruction {
	public function __construct() {
		parent::__construct(
				new PatchBasicValue(),
				new PatchSelectRecordField()
		);
	}
}

class PatchFieldMandatoryValue extends AlternativePatchInstruction {
	public function __construct() {
		parent::__construct(
				'mandatory',
				'optional'
		);
	}
}

class PatchFieldAttribute extends AlternativePatchInstruction {
	public function __construct() {
		parent::__construct(
				'type',
				'mandatory'
		);
	}
}

class PatchBooleanValue extends AlternativePatchInstruction {
	public function __construct() {
		parent::__construct(
				'true',
				'false'
		);
	}
}

/*************************************\
   COMPLETE INSTRUCTIONS (EXECUTABLE)
\*************************************/

interface PatchCompleteInstruction {
	public function execute(Database $db);
}

class PatchComment extends RegexPatchInstruction implements PatchCompleteInstruction {
	protected function getRegex() {
		return '#[^\n]*\n';
	}
	
	public function execute(Database $db) {
		// do nothing (ignore the comment)
		$comment = trim(substr($this->getValue(), 1));
		echo "(comment: $comment)";
	}
}

class PatchAttributes extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct('[time=',new PatchIntegerValue(),',user=',new PatchStringValue(),']');
	}
	
	public function execute(Database $db) {
		$time = $this->getTime();
		$user = $this->getUser();
		echo "new patch: user <b>$user</b> at <b>$time</b> (".date("Y-m-d H:i:s", (integer) $time).")";
	}
	
	public function getTime() {
		return $this->getInnerValue(1);
	}
	
	public function getUser() {
		return Patch::cleanStringValue($this->getInnerValue(3));
	}
}

class PatchAddField extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct('+',new PatchSelectField(),'(',new PatchFieldType(),',',new PatchFieldMandatoryValue(),')');
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$field = $this->getField();
		$type = $this->getType();
		$mandatory = $this->getMandatory();
		
		echo "add <b>$mandatory $type</b> field <b>$field</b> in class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerInstruction(1)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(1)->getField();
	}
	
	public function getType() {
		return $this->getInnerValue(3);
	}
	
	public function getMandatory() {
		return $this->getInnerValue(5);
	}
}

class PatchRemoveField extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct('-',new PatchSelectField());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$field = $this->getField();
		
		echo "remove field <b>$field</b> from class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerInstruction(1)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(1)->getField();
	}
}

class PatchSetClassKey extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct(new PatchClass(),'=',new PatchIDFields());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$fields = $this->getIDFields();
		
		echo "set ID to <b>[".array_reduce($fields, function($a, $b) {return $a = empty($a) ? $b:"$a,$b";})."]</b> for class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerValue(0);
	}
	
	public function getIDFields() {
		return $this->getInnerInstruction(2)->getIDFields();
	}
}

class PatchAddRecord extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct('+',new PatchSelectRecord(),new PatchChainFieldValueAssignment());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$values = $this->getIDValues();
		$assignments = array();
		foreach($this->getAssignments() as $field => $value) {
			$assignments[] = "$field($value)";
		}
		
		echo "Add record <b>[".array_reduce($values, function($a, $b) {return $a = empty($a) ? $b:"$a,$b";})."]</b> for class <b>$class</b>,";
		if (empty($assignments)) {
			echo " setting no field";
		} else {
			echo " setting the fields <b>".array_reduce($assignments, function($a, $b) {return $a = empty($a) ? $b:"$a,$b";})."</b>";
		}
	}
	
	public function getClass() {
		return $this->getInnerInstruction(1)->getClass();
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(1)->getIDValues();
	}
	
	public function getAssignments() {
		return $this->getInnerInstruction(2)->getAssignments();
	}
}

class PatchRemoveRecord extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct('-',new PatchSelectRecord());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$values = $this->getIDValues();
		
		echo "remove the record <b>[".array_reduce($values, function($a, $b) {return $a = empty($a) ? $b:"$a,$b";})."]</b> from class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerInstruction(1)->getClass();
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(1)->getIDValues();
	}
}

class PatchChangeRecordField extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct(new PatchSelectRecordField(),'=',new PatchFieldValue());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$values = $this->getIDValues();
		$field = $this->getField();
		$fieldValue = $this->getFieldValue();
		
		echo "set the field <b>$field($fieldValue)</b> of the record <b>[".array_reduce($values, function($a, $b) {return $a = empty($a) ? $b:"$a,$b";})."]</b> for class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(0)->getIDValues();
	}
	
	public function getField() {
		return $this->getInnerInstruction(0)->getField();
	}
	
	public function getFieldValue() {
		return $this->getInnerValue(2);
	}
}

class PatchChangeFieldType extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct(new PatchSelectField(),'.type=',new PatchFieldTypeValue());
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(0)->getField();
	}
	
	public function getTypeValue() {
		return $this->getInnerValue(2);
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$field = $this->getField();
		$value = $this->getTypeValue();
		
		echo "set the type <b>$value</b> for the field <b>$field</b> of the class <b>$class</b>";
	}
}

class PatchChangeFieldMandatory extends ComposedPatchInstruction implements PatchCompleteInstruction {
	public function __construct() {
		parent::__construct(new PatchSelectField(),'.mandatory=',new PatchFieldMandatoryValue());
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(0)->getField();
	}
	
	public function getMandatoryValue() {
		return $this->getInnerValue(2);
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$field = $this->getField();
		$value = $this->getMandatoryValue();
		
		echo "set the mandatory attribute to <b>$value</b> for the field <b>$field</b> of the class <b>$class</b>";
	}
}

/*************************************\
         SPECIAL INSTRUCTIONS
\*************************************/

class ListPatchInstruction extends PatchInstruction {
	private $instruction;
	
	public function __construct(PatchInstruction $instruction, $separator = null, $min = 0, $max = null) {
		$repeat = new ComposedPatchInstruction(is_object($separator) ? clone $separator : $separator,clone $instruction);
		if ($separator == null) {
			$this->instruction = new RepetitivePatchInstruction($repeat, $min, $max);
		} else {
			$max = $max === null ? $max : $max - 1;
			$min = $min > 0 ? $min - 1 : $min;
			$this->instruction = new ComposedPatchInstruction(clone $instruction, new RepetitivePatchInstruction($repeat, $min, $max));
			if ($min <= 0) {
				$this->instruction = new OptionalPatchInstruction($this->instruction);
			} else {
				// keep as is
			}
		}
	}
	
	public function __clone() {
		$this->instruction = clone $this->instruction;
	}
	
	protected function getRegex() {
		return $this->instruction->getRegex();
	}
	
	protected function applyValue($value) {
		$this->instruction->setValue($value);
	}
	
	public function getAllInstructions() {
		$instructions = array();
		$reference = $this->instruction;
		if ($reference instanceof OptionalPatchInstruction) {
			$reference = $reference->getSingleInstruction();
		} else {
			// go directly to the next step
		}
		
		if ($reference == null) {
			// no result, just ignore everything until the end
		} else {
			if ($reference instanceof ComposedPatchInstruction) {
				$instructions[] = $reference->getInnerInstruction(0);
				$reference = $reference->getInnerInstruction(1);
			} else {
				// go directly to the next step
			}
			
			// now, we should have a RepetitivePatchInstruction
			foreach($reference->getAllInstructions() as $instruction) {
				// each instruction is a repeating stuff (ComposedPatchInstruction)
				// we need the last element (we do not know if there is 1 or 2 instructions)
				$in = $instruction->getInnerInstructions();
				$instructions[] = array_pop($in);
			}
		}
		return $instructions;
	}
	
	public function getAllValues() {
		$values = array();
		foreach($this->getAllInstructions() as $instruction) {
			$values[] = $instruction->getValue();
		}
		return $values;
	}
}

class RepetitivePatchInstruction extends PatchInstruction {
	private $instructions = array();
	private $reference;
	private $min;
	private $max;
	
	public function __construct(PatchInstruction $reference, $min = 0, $max = null) {
		$this->reference = $reference;
		$this->min = $min;
		$this->max = $max;
	}
	
	function __clone() {
		$this->reference = clone $this->reference;
		$instructions = array();
		foreach($this->instructions as $element) {
			$instructions[] = clone $element;
		}
		$this->instructions = $instructions;
	}
	
	public function getReference() {
		return $this->reference;
	}
	
	public function getMin() {
		$this->min = $min;
	}
	
	public function getMax() {
		$this->max = $max;
	}
	
	protected function getRegex() {
		$regex = $this->reference->getRegex();
		$min = $this->min;
		$max = $this->max;
		if ($min === 0 && $max === null) {
			$regex = "(?:$regex)*";
		} else if ($min === 1 && $max === null) {
			$regex = "(?:$regex)+";
		} else if ($min === 0 && $max === 1) {
			$regex = "(?:$regex)?";
		} else if ($min === $max) {
			$regex = "(?:$regex)\{$min\}";
		} else {
			$regex = "(?:$regex)\{$min,$max\}";
		}
		return $regex;
	}
	
	protected function applyValue($value) {
		$regex = $this->reference->getRegex();
		$this->instructions = array();
		while(!empty($value)) {
			$matches = array();
			preg_match('#^('.PatchInstruction::formatRegex($regex, '#').').*$#s', $value, $matches);
			$chunk = $matches[1];
			$instruction = clone $this->reference;
			$instruction->setValue($chunk);
			$this->instructions[] = $instruction;
			$value = substr($value, strlen($chunk));
		}
	}
	
	public function getAllValues() {
		$values = array();
		foreach($this->instructions as $instruction) {
			$values[] = $instruction->getValue();
		}
		return $values;
	}
	
	public function getAllInstructions() {
		return $this->instructions;
	}
}

class OptionalPatchInstruction extends RepetitivePatchInstruction {
	public function __construct(PatchInstruction $instruction) {
		parent::__construct($instruction, 0, 1);
	}
	
	public function getSingleInstruction() {
		$instructions = $this->getAllInstructions();
		return array_shift($instructions);
	}
}

class TextPatchInstruction extends RegexPatchInstruction {
	private $text;
	
	public function __construct($text) {
		$this->text = $text;
	}
	
	protected function getRegex() {
		return preg_quote($this->text);
	}
}
?>