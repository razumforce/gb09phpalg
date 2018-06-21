<?php

require("./FormulaTree.php");

$formula = ['(', 'x', '+', '42', ')', '^', '2', '+', '7', '*', 'y', '-', 'z']; // сам парсер не писал,
                                                                               // предполагаю, что получаю уже в виде массива данные

$formulaDirect = ['-', '+', '^', '+', 'x', '42', '2', '*', '7', 'y', 'z']; // это для теста

$tree = new FormulaTree();
$tree->insert(['type' => 'ops', 'value' => '-']);
$tree->insert(['type' => 'ops', 'value' => '+']);
$tree->insert(['type' => 'ops', 'value' => '^']);
$tree->insert(['type' => 'ops', 'value' => '+']);
$tree->insert(['type' => 'var', 'value' => 'x']);
$tree->insert(['type' => 'num', 'value' => '42']);
$tree->insert(['type' => 'num', 'value' => '2']);
$tree->insert(['type' => 'ops', 'value' => '*']);
$tree->insert(['type' => 'num', 'value' => '7']);
$tree->insert(['type' => 'var', 'value' => 'y']);
$tree->insert(['type' => 'var', 'value' => 'z']);


var_dump($tree);
