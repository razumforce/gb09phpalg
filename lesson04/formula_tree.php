<?php

require("./FormulaTree.php");

const OPS_MAP = ['+', '-', '*', '/', '^'];
const VAR_MAP = ['x', 'y', 'z'];

$formula = ['(', 'x', '+', '42', ')', '^', '2', '+', '7', '*', 'y', '-', 'z']; // сам парсер не писал,
                                                                               // предполагаю, что получаю уже в виде массива данные

$formulaDirect = ['-', '+', '^', '+', 'x', '42', '2', '*', '7', 'y', 'z']; // это для теста

$tree = new FormulaTree();
$var = ['x' => 2, 'y' => 5, 'z' => 1];

foreach ($formulaDirect as $token) {
  if (in_array($token, OPS_MAP)) {
    $type = 'ops';
  } else if (in_array($token, VAR_MAP)) {
    $type = 'var';
  } else {
    $type = 'num';
  }
  $tree->insert(['type' => $type, 'value' => $token]);
}

echo $tree->calculate($var) . "\n";


var_dump($tree);

// echo 44 ^ 2;


