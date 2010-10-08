<?php

require 'PEG/Parser.php' ;

class Dice extends Parser {

/* number: /[0-9]/ */
function match_number () {
	$result = array("name"=>"number", "text"=>"");
	$substack = array();
	$_0 = new ParserExpression( $this, $substack, $result );
	if (( $subres = $this->rx( $_0->expand('/[0-9]/') ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $result;
	}
	else { return FALSE; }
}


/* letter: /[A-Za-z]/ */
function match_letter () {
	$result = array("name"=>"letter", "text"=>"");
	$substack = array();
	$_2 = new ParserExpression( $this, $substack, $result );
	if (( $subres = $this->rx( $_2->expand('/[A-Za-z]/') ) ) !== FALSE) {
		$result["text"] .= $subres;
		return $result;
	}
	else { return FALSE; }
}


/* plus: '+' */
function match_plus () {
	$result = $this->construct( "plus" );
	$substack = array();
	if (substr($this->string,$this->pos,1) == '+') {
		$this->pos += 1;
		$result["text"] .= '+';
		return $result ;
	}
	else { return FALSE; }
}


/* minus: '-' */
function match_minus () {
	$result = $this->construct( "minus" );
	$substack = array();
	if (substr($this->string,$this->pos,1) == '-') {
		$this->pos += 1;
		$result["text"] .= '-';
		return $result ;
	}
	else { return FALSE; }
}


/* operand: (plus | minus)? */
function match_operand () {
	$result = $this->construct( "operand" );
	$substack = array();
	$res_12 = $result;
	$pos_12 = $this->pos;
	$_11 = NULL;
	do {
		$_9 = NULL;
		do {
			$res_6 = $result;
			$pos_6 = $this->pos;
			$key = "plus"; $pos = $this->pos;
			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_plus() ) );
			if ($subres !== FALSE) {
				$this->store( $result, $subres );
				$_9 = TRUE; break;
			}
			$result = $res_6;
			$this->pos = $pos_6;
			$key = "minus"; $pos = $this->pos;
			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_minus() ) );
			if ($subres !== FALSE) {
				$this->store( $result, $subres );
				$_9 = TRUE; break;
			}
			$result = $res_6;
			$this->pos = $pos_6;
			$_9 = FALSE; break;
		}
		while(0);
		if( $_9 === FALSE) { $_11 = FALSE; break; }
		$_11 = TRUE; break;
	}
	while(0);
	if( $_11 === TRUE ) { return $result ; }
	if( $_11 === FALSE) {
		$result = $res_12;
		$this->pos = $pos_12;
		unset( $res_12 );
		unset( $pos_12 );
	}
}


/* amount: number* */
function match_amount () {
	$result = $this->construct( "amount" );
	$substack = array();
	while (true) {
		$res_13 = $result;
		$pos_13 = $this->pos;
		$key = "number"; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_number() ) );
		if ($subres !== FALSE) { $this->store( $result, $subres ); }
		else {
			$result = $res_13;
			$this->pos = $pos_13;
			unset( $res_13 );
			unset( $pos_13 );
			break;
		}
	}
	return $result ;
}


/* type: letter */
function match_type () {
	$result = $this->construct( "type" );
	$substack = array();
	$key = "letter"; $pos = $this->pos;
	$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_letter() ) );
	if ($subres !== FALSE) {
		$this->store( $result, $subres );
		return $result ;
	}
	else { return FALSE; }
}


/* sides: number* */
function match_sides () {
	$result = $this->construct( "sides" );
	$substack = array();
	while (true) {
		$res_15 = $result;
		$pos_15 = $this->pos;
		$key = "number"; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_number() ) );
		if ($subres !== FALSE) { $this->store( $result, $subres ); }
		else {
			$result = $res_15;
			$this->pos = $pos_15;
			unset( $res_15 );
			unset( $pos_15 );
			break;
		}
	}
	return $result ;
}


/* element: amount type sides */
function match_element () {
	$result = $this->construct( "element" );
	$substack = array();
	$_19 = NULL;
	do {
		$key = "amount"; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_amount() ) );
		if ($subres !== FALSE) { $this->store( $result, $subres ); }
		else { $_19 = FALSE; break; }
		$key = "type"; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_type() ) );
		if ($subres !== FALSE) { $this->store( $result, $subres ); }
		else { $_19 = FALSE; break; }
		$key = "sides"; $pos = $this->pos;
		$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_sides() ) );
		if ($subres !== FALSE) { $this->store( $result, $subres ); }
		else { $_19 = FALSE; break; }
		$_19 = TRUE; break;
	}
	while(0);
	if( $_19 === TRUE ) { return $result ; }
	if( $_19 === FALSE) { return FALSE; }
}

function element__construct (  &$self  ) { 
	    $self['amount'] = NULL;
        $self['type'] = NULL;
	    $self['val'] = NULL;
	    $self['sides'] = NULL;
	    $self['throw'] = array();
	}

function element_amount ( &$self, $sub ) { 
        $self['amount'] = $sub['text'];
    }

function element_type ( &$self, $sub ) { 
        $self['type'] = $sub['text'];
    }

function element_sides ( &$self, $sub ) { 
        $self['sides'] = $sub['text'];
		for($i=0; $i<$self['amount']; $i++) {
			$throw = mt_rand(1, $self['sides']);
			$self['val'] += $throw;
			$self['throw'][] = $throw;
	    }
    }

/* roll: (> operand > element >)* */
function match_roll () {
	$result = $this->construct( "roll" );
	$substack = array();
	while (true) {
		$res_27 = $result;
		$pos_27 = $this->pos;
		$_26 = NULL;
		do {
			if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
			$key = "operand"; $pos = $this->pos;
			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_operand() ) );
			if ($subres !== FALSE) { $this->store( $result, $subres ); }
			else { $_26 = FALSE; break; }
			if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
			$key = "element"; $pos = $this->pos;
			$subres = ( $this->packhas( $key, $pos ) ? $this->packread( $key, $pos ) : $this->packwrite( $key, $pos, $this->match_element() ) );
			if ($subres !== FALSE) { $this->store( $result, $subres ); }
			else { $_26 = FALSE; break; }
			if (( $subres = $this->whitespace(  ) ) !== FALSE) { $result["text"] .= $subres; }
			$_26 = TRUE; break;
		}
		while(0);
		if( $_26 === FALSE) {
			$result = $res_27;
			$this->pos = $pos_27;
			unset( $res_27 );
			unset( $pos_27 );
			break;
		}
	}
	return $result ;
}

function roll__construct (  &$self  ) { 
        $self['val'] = 0;
	    $self['operand'] = NULL;
    }

function roll_operand ( &$self, $sub ) { 
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

function roll_element ( &$self, $sub ) { 
        print_r($sub);
	    $self['operand']  = (isset($self['operand'])) ? $self['operand'] : 1;
		$self['val'] += $self['operand'] * $sub['val'];
	}



}
