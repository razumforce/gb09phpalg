<?php

require("./FormulaTree.php");

// сам парсер не писал, предполагаю, что получаю уже в виде массива данные
$formula = ['(', 'x', '+', '42', ')', '^', '2', '+', '7', '*', 'y', '-', 'z'];


$tree = new FormulaTree();
$tree->generate($formula);

$var = ['x' => 2, 'y' => 5, 'z' => 1];

echo $tree->calculate($var) . "\n";

// var_dump($tree);



