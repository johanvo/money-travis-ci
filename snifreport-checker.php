<?php

$inputFile = $argv[1];

if (!file_exists($inputFile)) {
	throw new InvalidArgumentException('Invalid input file provided');
}

$xml = new SimpleXMLElement(file_get_contents($inputFile));
$filesWithError = $xml->xpath("//error[@severity='error']/parent::file");

if (count($filesWithError) > 0) {
	echo PHP_EOL . 'STYLE FAILURE: ' . PHP_EOL;

	foreach ($filesWithError as $fileWithError) {
		$filename = $fileWithError['name'];
		$filename = str_replace(__DIR__, '', $filename);
		$errors = $fileWithError->xpath("error[@severity='error']");

		foreach ($errors as $error) {
			$error = (array)$error;
			$message = "\t{$filename}:{$error['@attributes']['line']}:{$error['@attributes']['column']} "
				. $error['@attributes']['message'] . PHP_EOL;
			echo $message;
		}
	}
	echo PHP_EOL . 'PSR2 style ORDERS MUST BE OBEYED AT ALL TIMES!!!' . PHP_EOL;

	exit(1);

}

echo 'Well done citizen!' . PHP_EOL;
