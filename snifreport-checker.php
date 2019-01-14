<?php

$inputFile = $argv[1];

if (!file_exists($inputFile)) {
	throw new InvalidArgumentException('Invalid input file provided');
}

$xml = new SimpleXMLElement(file_get_contents($inputFile));
$errors = $xml->xpath("//error[@severity='error']");

if ( count($errors) ) {
	echo 'PSR2 style ORDERS MUST BE OBAYED AT ALL TIMES';
	exit(1);

} else {
	echo 'Well done citizin';
}
