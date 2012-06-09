<?php
require "class/util/PHP-Parser/lib/bootstrap.php";

class Debug {
	public static function toString( $object, $name = 'object' ) {
		
		//d�finition de la variable contenant le texte
		$string = '';
		
		//d�finition des couleurs d'affichage
		$COLOR_OTHER	= 'green';	//couleur par d�faut de la cha�ne
		$COLOR_QUOTE	= 'red';	//quotes dans les ['...'] des tableaux
		
		$COLOR_OBJECT	= 'blue';	//objets
		$COLOR_ARRAY	= 'blue';	//tableaux
		
		$COLOR_BOOL		= 'black';	//bool�en
		$COLOR_DOUBLE	= 'black';	//flottants
		$COLOR_INT		= 'black';	//entiers
		$COLOR_STRING	= 'black';	//cha�ne de caract�res
		$COLOR_NULL		= 'red';	//sans valeurs
		$COLOR_RESOURCE	= 'red';	//resources (types ext�rieurs)
		$COLOR_UNKNOWN	= 'red';	//autres
		
		//v�rification si tableau non NULL (�galit� souple pour prendre en compte un maximum de cas)
		if ( $object == NULL ) {
			$string .= '<font color="' . $COLOR_OTHER . '">';
			$string .= '<b>$</b>' . $name;
			$string .= ' = ';
			$string .= '(<font color="' . $COLOR_NULL . '">NULL</font>)';
			$string .= '</font>';
			$string .= '<br />';
		}
		else {
			//traitement de chaque entr�e du tableau
			foreach ( $object as $key => $value ) {
				
				//traitement de la cl�
				//cr�ation d'une variable donnant l'affichage format� de la cl�
				//le formatage d�pend du type de la cl�
				if ( is_array( $object ) ) {
					$key_format = '<b>[</b>';
					if ( is_int( $key ) ) {
						$key_format .= '<font color="' . $COLOR_ARRAY . '">' . $key . '</font>';
					}
					else {
						$key_format .= '<font color="' . $COLOR_ARRAY . '"><font color="' . $COLOR_QUOTE . '">\'</font>' . $key . '<font color="' . $COLOR_QUOTE . '">\'</font></font>';
					}
					$key_format .= '<b>]</b>';
				}
				elseif ( is_object( $object ) ) {
					$key_format = '<b>-></b>';
					$key_format .= '<font color="' . $COLOR_OBJECT . '">' . $key . '</font>';
				}
				else {
					$key_format = '<b>-></b>';
					$key_format .= '<font color="' . $COLOR_OTHER . '">' . $key . '</font>';
				}
				
				//traitement de la valeur
				//si c'est un tableau ou un objet, on relance la fonction dessus
				//(sauf si c'est un rebouclage non souhait�)
				//sinon on la consid�re comme une simple valeur et on l'affiche
				if ( is_array( $value ) ) {
					
					//condition anti-rebouclage
					if ( ( $key === $name ) && ( $key !== '0' ) ) {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '<font color="' . $COLOR_ARRAY . '">array $' . $key . '</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
					//traitement en tant que tableau
					else {
						$string .= Debug::toString( $value, $name . $key_format );
					}
				}
				elseif ( is_object( $value ) ) {
					
					//condition anti-rebouclage
					if ( ( $key === $name ) && ( $key !== '0' ) ) {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '-><font color="' . $COLOR_OBJECT . '">object $' . $key . '</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
					//traitement en tant qu'objet
					else {
						$string .= Debug::toString( $value, $name . $key_format );
					}
				}
				//affichage de la valeur si ce n'est pas un tableau ou un objet
				//l'affichage d�pend du type de variable
				else {
					if ( is_bool( $value ) ) {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '(bool) <font color="' . $COLOR_BOOL . '">' . ( $value ? 'TRUE' : 'FALSE' ) . '</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
					elseif ( is_float( $value ) || is_double( $value ) ) {	//float et double sont strictement identique (double n'est qu'un alias de float)
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '(float) <font color="' . $COLOR_DOUBLE . '">' . $value . '</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
					elseif ( is_int( $value ) ) {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '(int) <font color="' . $COLOR_INT . '">' . $value . '</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
					elseif ( is_string( $value ) ) {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '(string['. strlen( $value ) .']) <font color="' . $COLOR_QUOTE . '">\'</font><font color="' . $COLOR_STRING . '"><pre style="display:inline;">' . $value . '</pre></font><font color="' . $COLOR_QUOTE . '">\'</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
					elseif ( is_null( $value ) ) {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '(<font color="' . $COLOR_NULL . '">NULL</font>)';
						$string .= '</font>';
						$string .= '<br />';
					}
					elseif ( is_resource( $value ) ) {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '(resource) <font color="' . $COLOR_RESOURCE . '">' . $value . '(' . get_resource_type( $value ) . ')' . '</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
					else {
						$string .= '<font color="' . $COLOR_OTHER . '">';
						$string .= '<b>$</b>' . $name;
						$string .= $key_format . ' = ';
						$string .= '(' . gettype( $value ) . ') <font color="' . $COLOR_UNKNOWN . '">unknowm</font>';
						$string .= '</font>';
						$string .= '<br />';
					}
				}
			}
		}
		
		//on renvoie le texte
		return $string;
	}
	
	public static function createWarningTag($text) {
		return "<span class='warning'>".$text."</span>";
	}
	
	public static function getClassSourceCode($class) {
		$class = new ReflectionClass($class);
		$fileName = $class->getFileName();

		if(!empty($fileName)) {
			$fileContents = file_get_contents($fileName);
			$startLine = $class->getStartLine()-1; // getStartLine() seems to start after the {, we want to include the signature
			$endLine = $class->getEndLine();
			$numLines = $endLine - $startLine;
			$classSource = trim(implode('',array_slice(file($fileName),$startLine,$numLines))); // not perfect; if the class starts or ends on the same line as something else, this will be incorrect
			return $classSource;
		} else {
			throw new Exception("No file for the class $class");
		}
	}
	
	public static function getClassNameFromSourceCode($classSource) {
		$parser = new PHPParser_Parser(new PHPParser_Lexer());
		$stmts = $parser->parse("<?php ".$classSource." ?>");
		return $stmts[0]->name;
	}
	
	public static function changeClassNameInSourceCode($classSource, $oldClassName, $newClassName) {
		$parser = new PHPParser_Parser(new PHPParser_Lexer());
		$traverser = new PHPParser_NodeTraverser();
		$prettyPrinter = new PHPParser_PrettyPrinter_Zend();
		$traverser->addVisitor(new RenamerVisitor($oldClassName, $newClassName));
		$stmts = $parser->parse("<?php ".$classSource." ?>");
		$stmts = $traverser->traverse($stmts);
		$code = $prettyPrinter->prettyPrint($stmts);
		return $code;
	}
}

class RenamerVisitor extends PHPParser_NodeVisitorAbstract {
	private $oldClassName;
	private $newClassName;
	
	public function __construct($oldClassName, $newClassName) {
		$this->oldClassName = $oldClassName;
		$this->newClassName = $newClassName;
	}
	
	public function leaveNode(PHPParser_Node $node) {
		if ($node instanceof PHPParser_Node_Stmt_Class && $node->name == $this->oldClassName) {
			$node->name = $this->newClassName;
		}
	}
}
?>