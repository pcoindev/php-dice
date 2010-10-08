<?php

require 'PEG/Parser.php' ;

class Dice extends Parser {

/*Parser:Dice

number: /[0-9]/
letter: /[A-Za-z]/
plus: '+'
minus: '-'
operand: (plus | minus)?
amount: number*
type: letter
sides: number*

element: amount type sides
	function __construct( &$self ) {
	    $self['amount'] = NULL;
        $self['type'] = NULL;
	    $self['val'] = NULL;
	    $self['sides'] = NULL;
	    $self['throw'] = array();
	}
    function amount(&$self, $sub) {
        $self['amount'] = $sub['text'];
    }
    function type(&$self, $sub) {
        $self['type'] = $sub['text'];
    }
    function sides(&$self, $sub) {
        $self['sides'] = $sub['text'];
		for($i=0; $i<$self['amount']; $i++) {
			$throw = mt_rand(1, $self['sides']);
			$self['val'] += $throw;
			$self['throw'][] = $throw;
	    }
    }

roll: (> operand > element >)*
    function __construct( &$self ) {
        $self['val'] = 0;
	    $self['operand'] = NULL;
    }
	function operand(&$self, $sub) {
        switch($sub['text']) {
		    case "+":
            	$self['operand'] = 1;
				break;
			case "-":
            	$self['operand'] = -1;
				break;
			default:
            	$self['operand'] = 1;
		}
	}
	function element(&$self, $sub) {
        print_r($sub);
	    $self['operand']  = (isset($self['operand'])) ? $self['operand'] : 1;
		$self['val'] += $self['operand'] * $sub['val'];
	}
		
*/

}
