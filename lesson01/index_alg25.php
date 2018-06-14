<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ALGORITHMS lesson 1</title>
</head>
<body>

<?php

$testString = '([(([{}]))]){}([])';

$rawData = str_split($testString);

$result = true;
const MAP_TABLE = [')' => '(', ']' => '[', '}' => '{'];
$stack = new SplStack();

echo $testString . '<br>' . '<br>';

foreach ($rawData as $char) {
  if ($char == '(' || $char == '[' || $char == '{') {
    $stack->push($char);
  } else if ($char == ')' || $char == ']' || $char == '}') {
    if ($stack->count() == 0) {
      $result = false;
      break;
    }
    if ($stack->top() != MAP_TABLE[$char]) {
      $result = false;
      break;
    } else {
      $stack->pop();
    }
  } else {
    $result = false;
    break;
  }
}


if ($result) {
  echo 'ALL OK!';
} else {
  echo 'ERROR!';
}
  


?>




  
</body>
</html>