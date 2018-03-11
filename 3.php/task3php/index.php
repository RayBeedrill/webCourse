<?php
/*
*
* file to get data from class and make logical operations
*/
include('config.php');
include('lib/FileReadEdit.php');

$text = new FileReadEdit();

$dataStringRead = $text->getTextByStrings();
$dataCharsRead = $text->getTextBySymbols();

include('template/index.php');
