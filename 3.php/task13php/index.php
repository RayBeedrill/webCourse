<?php
include('config.php');
include('lib/Calc.php');
$calc = new Calc();

$calc->setFirstNum(40);
$calc->setSecondNum(30);

$firstVal = $calc->getFirstNum();
$secondVal = $calc->getSecondNum();
$memStore = $calc->setMemory($firstVal);
$memVal = $calc->getMemory();

$sum = $calc->sum();
$min = $calc->minus();
$divide = $calc->divide();
$multiply = $calc->multiply();
$percent = $calc->percent();

$sqrtNum1 = $calc->calcSqrt($firstVal);
$sqrtNum2 = $calc->calcSqrt($secondVal);

$memRec1 = $calc->getMemory();
$calc->memSum(5);
$memRec2 = $calc->getMemory();
$calc->memMinus(14);
$memRec3 = $calc->getMemory();
$calc->memClear();
$memRec4 = $calc->getMemory();

include('template/index.php');
