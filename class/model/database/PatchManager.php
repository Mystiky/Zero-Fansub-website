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
		while(!empty($patch)) {
			$patch = trim($patch);
			$in0 = new PatchComment();
			$in1 = new PatchAttributes();
			$in2 = new PatchAddField();
			$in3 = new PatchRemoveField();
			$in4 = new PatchSetClassKey();
			$in5 = new PatchAddRecord();
			$in6 = new PatchRemoveRecord();
			$in7 = new PatchChangeRecordField();
			$in8 = new PatchChangeFieldAttribute();
			$matches = array();
			if (preg_match('#^('.$in0->getFormattedRegex('#').')\n.*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in0->setValue($instruction);
				$in0->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in0;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in0->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in1->getFormattedRegex('#').')\n.*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in1->setValue($instruction);
				$in1->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in1;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in1->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in2->getFormattedRegex('#').').*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in2->setValue($instruction);
				$in2->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in2;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in2->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in3->getFormattedRegex('#').').*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in3->setValue($instruction);
				$in3->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in3;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in3->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in4->getFormattedRegex('#').').*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in4->setValue($instruction);
				$in4->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in4;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in4->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in5->getFormattedRegex('#').').*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in5->setValue($instruction);
				$in5->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in5;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in5->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in6->getFormattedRegex('#').').*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in6->setValue($instruction);
				$in6->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in6;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in6->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in7->getFormattedRegex('#').').*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in7->setValue($instruction);
				$in7->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in7;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in7->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else if (preg_match('#^('.$in8->getFormattedRegex('#').').*$#s', $patch, $matches)) {
				$instruction = $matches[1];
				$in8->setValue($instruction);
				$in8->execute(Database::getDefaultDatabase());
				$this->instructions[] = $in8;
				$patch = substr($patch, strlen($instruction));
				/*
				echo '<b>'.$in8->getFormattedRegex('#').'</b> =X=> '.Debug::toString($matches);
				$patch = null;
				*/
			} else {
				throw new Exception("The given patch cannot be parsed from there: $patch");
			}
			echo '<br/>';
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
	
	public function getFormattedRegex($delimiter) {
		return PatchInstruction::formatRegex($this->getRegex(), $delimiter);
	}
	
	public function isSyntaxicallyCompatible($value) {
		return preg_match('#^'.$this->getFormattedRegex('#').'$#s', $value);
	}
}

/*************************************\
           LEAF INSTRUCTIONS
\*************************************/

abstract class LeafPatchInstruction extends PatchInstruction {
	protected function applyValue($instruction) {
		// nothing to do
	}
}

class PatchClass extends LeafPatchInstruction {
	protected function getRegex() {
		return '[0-9a-zA-Z]+';
	}
}

class PatchField extends LeafPatchInstruction {
	protected function getRegex() {
		return '[0-9a-zA-Z]+';
	}
}

class PatchFieldType extends LeafPatchInstruction {
	protected function getRegex() {
		return '[0-9a-zA-Z]+';
	}
}

class PatchFieldMandatoryValue extends LeafPatchInstruction {
	protected function getRegex() {
		return '(?:mandatory)|(?:optional)';
	}
}

class PatchFieldTypeValue extends LeafPatchInstruction {
	protected function getRegex() {
		return '(?:boolean)|(?:integer)|(?:double)|(?:array)|(?:resource)|(?:string(?:[1-9][0-9]*)?)';
	}
}

class PatchFieldAttribute extends LeafPatchInstruction {
	protected function getRegex() {
		return '(?:type)|(?:mandatory)';
	}
}

class PatchStringValue extends LeafPatchInstruction {
	protected function getRegex() {
		return '"(?:[^\\\\"]|(?:\\\\")|(?:\\\\\\\\))*"';
	}
}

class PatchBooleanValue extends LeafPatchInstruction {
	protected function getRegex() {
		return '(?:true)|(?:false)';
	}
}

class PatchIntegerValue extends LeafPatchInstruction {
	protected function getRegex() {
		return '[0-9]+';
	}
}

/*************************************\
        COMPOSED INSTRUCTIONS
\*************************************/

class ComposedPatchInstruction extends PatchInstruction {
	private $composition;
	
	public function __construct() {
		$composition = array();
		for ($i = 0 ; $i < func_num_args() ; $i ++) {
			$element = func_get_arg($i);
			if (is_string($element) || $element instanceof PatchInstruction) {
				$composition[] = $element;
			} else {
				throw new Exception("$element is not managed in composed instructions");
			}
		}
		$this->composition = $composition;
	}
	
	function __clone() {
		$composition = array();
		foreach($this->composition as $element) {
			if (is_string($element)) {
				$composition[] = $element;
			} else if ($element instanceof PatchInstruction) {
				$composition[] = clone $element;
			} else {
				throw new Exception($element." is not a managed element");
			}
		}
		$this->composition = $composition;
	}
	
	protected function getComposition() {
		return $this->composition;
	}
	
	private function generateRegex($catchInnerInstructions = false) {
		$globalRegex = "";
		foreach($this->getComposition() as $element) {
			if (is_string($element)) {
				$globalRegex .= preg_quote($element);
			} else if ($element instanceof PatchInstruction) {
				$regex = $element->getRegex();
				$regex = $catchInnerInstructions ? "($regex)" : "(?:$regex)";
				$globalRegex .= $regex;
			} else {
				throw new Exception($element." is not a managed element");
			}
		}
		return $globalRegex;
	}
	
	public function getInnerInstructions() {
		$instructions = array();
		foreach($this->getComposition() as $element) {
			if ($element instanceof PatchInstruction) {
				$instructions[] = $element;
			} else {
				continue;
			}
		}
		return $instructions;
	}
	
	public function getInnerInstruction($index) {
		$instructions = $this->getInnerInstructions();
		return $instructions[$index];
	}
	
	public function getInnerValues() {
		$innerValues = array();
		foreach($this->getInnerInstructions() as $instruction) {
			$innerValues[] = $instruction->getValue();
		}
		return $innerValues;
	}
	
	public function getInnerValue($index) {
		$values = $this->getInnerValues();
		return $values[$index];
	}
	
	protected function applyValue($instruction) {
		$regex = $this->generateRegex(true);
		preg_match('#^'.PatchInstruction::formatRegex($regex, '#').'$#s', $instruction, $matches);
		array_shift($matches); // remove the full match
		foreach($this->getInnerInstructions() as $instruction) {
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
		return $this->getInnerValue(1);
	}
}

class PatchIDFields extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct('[',new ListPatchInstruction(new PatchField(),','),']');
	}
	
	public function getIDFields() {
		return $this->getInnerInstruction(0)->getAllValues();
	}
}

class PatchIDValues extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct('[',new ListPatchInstruction(new PatchBasicValue(),','),']');
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(0)->getAllValues();
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
		return $this->getInnerValue(1);
	}
}

class PatchChainFieldValueAssignment extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct('(',new ListPatchInstruction(new PatchFieldValueAssignment(),','),')');
	}
	
	public function getAssignments() {
		$assignments = array();
		foreach($this->getInnerInstruction(0)->getAllInstructions() as $instruction) {
			$assignments[$instruction->getField()] = $instruction->getFieldValue();
		}
		return $assignments;
	}
}

class PatchBasicValue extends ComposedPatchInstruction {
	// TODO add variables or manage recursivity in order to manage not restricted only
	public function __construct() {
		parent::__construct(new AlternativePatchInstruction(
				new PatchStringValue(),
				new PatchBooleanValue(),
				new PatchIntegerValue()
		));
	}
}

class PatchFieldValue extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct(new AlternativePatchInstruction(
				new PatchBasicValue(),
				new PatchSelectRecordField()
		));
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
		return $this->getInnerValue(1);
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

class PatchSelectFieldAttribute extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct(new PatchSelectField(),'.',new PatchFieldAttribute());
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(0)->getField();
	}
	
	public function getAttribute() {
		return $this->getInnerValue(1);
	}
}

class PatchClassAttributeValue extends ComposedPatchInstruction {
	public function __construct() {
		parent::__construct(new AlternativePatchInstruction(
				new PatchFieldMandatoryValue(),
				new PatchFieldTypeValue()
		));
	}
}

/*************************************\
     ROOT INSTRUCTIONS (EXECUTABLE)
\*************************************/

interface PatchExecutableInstruction {
	public function execute(Database $db);
}

class PatchComment extends LeafPatchInstruction implements PatchExecutableInstruction {
	protected function getRegex() {
		return '#[^\n]*\n';
	}
	
	public function execute(Database $db) {
		// do nothing (ignore the comment)
		$comment = trim(substr($this->getValue(), 1));
		echo "(comment: $comment)";
	}
}

class PatchAttributes extends ComposedPatchInstruction implements PatchExecutableInstruction {
	public function __construct() {
		parent::__construct('[time=',new PatchIntegerValue(),',user=',new PatchStringValue(),']');
	}
	
	public function execute(Database $db) {
		$time = $this->getTime();
		$user = $this->getUser();
		echo "new patch: user <b>$user</b> at <b>$time</b> (".date("Y-m-d H:i:s", (integer) $time).")";
	}
	
	public function getTime() {
		return $this->getInnerValue(0);
	}
	
	public function getUser() {
		return Patch::cleanStringValue($this->getInnerValue(1));
	}
}

class PatchAddField extends ComposedPatchInstruction implements PatchExecutableInstruction {
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
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(0)->getField();
	}
	
	public function getType() {
		return $this->getInnerValue(1);
	}
	
	public function getMandatory() {
		return $this->getInnerValue(2);
	}
}

class PatchRemoveField extends ComposedPatchInstruction implements PatchExecutableInstruction {
	public function __construct() {
		parent::__construct('-',new PatchSelectField());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$field = $this->getField();
		
		echo "remove field <b>$field</b> from class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(0)->getField();
	}
}

class PatchSetClassKey extends ComposedPatchInstruction implements PatchExecutableInstruction {
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
		return $this->getInnerInstruction(1)->getIDFields();
	}
}

class PatchAddRecord extends ComposedPatchInstruction implements PatchExecutableInstruction {
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
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(0)->getIDValues();
	}
	
	public function getAssignments() {
		return $this->getInnerInstruction(1)->getAssignments();
	}
}

class PatchRemoveRecord extends ComposedPatchInstruction implements PatchExecutableInstruction {
	public function __construct() {
		parent::__construct('-',new PatchSelectRecord());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$values = $this->getIDValues();
		
		echo "remove the record <b>[".array_reduce($values, function($a, $b) {return $a = empty($a) ? $b:"$a,$b";})."]</b> from class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getIDValues() {
		return $this->getInnerInstruction(0)->getIDValues();
	}
}

class PatchChangeRecordField extends ComposedPatchInstruction implements PatchExecutableInstruction {
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
		return $this->getInnerValue(1);
	}
}

class PatchChangeFieldAttribute extends ComposedPatchInstruction implements PatchExecutableInstruction {
	public function __construct() {
		parent::__construct(new PatchSelectFieldAttribute(),'=',new PatchClassAttributeValue());
	}
	
	public function execute(Database $db) {
		$class = $this->getClass();
		$field = $this->getField();
		$attribute = $this->getAttribute();
		$attributeValue = $this->getAttributeValue();
		
		echo "set the attribute <b>$attribute($attributeValue)</b> of the field <b>$field</b> for class <b>$class</b>";
	}
	
	public function getClass() {
		return $this->getInnerInstruction(0)->getClass();
	}
	
	public function getField() {
		return $this->getInnerInstruction(0)->getField();
	}
	
	public function getAttribute() {
		return $this->getInnerInstruction(0)->getAttribute();
	}
	
	public function getAttributeValue() {
		return $this->getInnerValue(1);
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

class AlternativePatchInstruction extends PatchInstruction {
	private $alternatives;
	private $compatibleInstruction;
	
	public function __construct() {
		$alternatives = array();
		foreach(func_get_args() as $element) {
			if ($element instanceof PatchInstruction) {
				$alternatives[] = $element;
			} else {
				throw new Exception("$element is not managed in alternative instructions");
			}
		}
		$this->alternatives = $alternatives;
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
?>