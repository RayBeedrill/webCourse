<?php
/*
*
* file to get data from class and make logical operations
*/
include('config.php');
include('lib/FileReadEdit.php');

$text = new FileReadEdit();

$originalText = $text->getTextByStrings();
$textEditedString = $text->changeStringInText(1, "new line");
$textEditedChar = $text->changeSymbolsInString(1, 6, "p");
$text->saveChangesInText();
$editedText = $text->getTextBySymbols();

include('template/index1.php');
