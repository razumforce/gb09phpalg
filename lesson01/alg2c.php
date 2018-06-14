<?php

$testName = "iterator";

$testArray = [];

const ARRAY_LENGTH = 20000;
const MIN_LOOPS = 10;
const MAX_LOOPS = 5000;

for ($i = 0; $i < ARRAY_LENGTH; $i++) {
  $testArray[$i] = "test";
}

echo "***" . "Min LOOPS = " . MIN_LOOPS . "\n";

$iter = new ArrayIterator($testArray);
$start = microtime(true);

for ($k = 0; $k < MIN_LOOPS; $k++) {
  $iter->rewind();
  while ($iter->valid()) {
    $temp = $iter->current();
    $iter->next();
  }
}

echo "Time to make " . $testName . " = " . round(microtime(true) - $start, 4) . "sec \n";
echo memory_get_usage() . " bytes used by " . $testName . "\n";


echo "\n\n" . "MAX LOOPS = " . MAX_LOOPS . "\n";

$iter1 = new ArrayIterator($testArray);
$start1 = microtime(true);

for ($k = 0; $k < MAX_LOOPS; $k++) {
  $iter1->rewind();
  while ($iter1->valid()) {
    $temp = $iter1->current();
    $iter1->next();
  }
}

echo "Time to make " . $testName . " = " . round(microtime(true) - $start1, 4) . "sec \n";
echo memory_get_usage() . " bytes used by " . $testName . "\n";