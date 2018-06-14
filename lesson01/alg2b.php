<?php

$testName = "for";

$testArray = [];

const ARRAY_LENGTH = 20000;
const MIN_LOOPS = 10;
const MAX_LOOPS = 5000;

for ($i = 0; $i < ARRAY_LENGTH; $i++) {
  $testArray[$i] = "test";
}

echo "***" . "Min LOOPS = " . MIN_LOOPS . "\n";

$count = count($testArray);
$start = microtime(true);

for ($k = 0; $k < MIN_LOOPS; $k++) {
  for ($j = 0; $j < $count; $j++) {
    $temp = $testArray[$j];
  }
}

echo "Time to make " . $testName . " = " . round(microtime(true) - $start, 4) . "sec \n";
echo memory_get_usage() . " bytes used by " . $testName . "\n";


echo "\n\n" . "MAX LOOPS = " . MAX_LOOPS . "\n";

$count1 = count($testArray);
$start1 = microtime(true);

for ($k = 0; $k < MAX_LOOPS; $k++) {
  for ($j = 0; $j < $count1; $j++) {
    $temp = $testArray[$j];
  }
}

echo "Time to make " . $testName . " = " . round(microtime(true) - $start1, 4) . "sec \n";
echo memory_get_usage() . " bytes used by " . $testName . "\n";