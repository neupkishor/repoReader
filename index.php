<?php

require_once __DIR__ . '/RepositoryReader.php';

$codeDirectory = __DIR__ . '/code';
$outputFile = 'repositoryCode.txt';

$repositoryReader = new RepositoryReader($codeDirectory, $outputFile);
$repositoryReader->processRepository();
