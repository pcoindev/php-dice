#!/usr/bin/php

<?php
require 'Dice.php';

if($argc != 2 || in_array($argv[1], array('--help', '-help', '-h', '-?'))) {
    print "Usage: $argv[0] <roll code>\n";
    print "\n";
    print "Where <roll code> is the die roll code grammar to test\n";
    print "\n";
    exit();
} else {
    $roll = $argv[1];
}

$parser = new Dice( $roll );
$res = $parser->match_roll();

if($res === FALSE) {
    print "No Match\n";
} else {
    print_r($res);
}

?>
