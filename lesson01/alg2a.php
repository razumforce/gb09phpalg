<?php

$testName = "foreach";

$testArray = [];

const ARRAY_LENGTH = 20000;
const MIN_LOOPS = 10;
const MAX_LOOPS = 5000;

for ($i = 0; $i < ARRAY_LENGTH; $i++) {
  $testArray[$i] = "test";
}

echo "***" . "Min LOOPS = " . MIN_LOOPS . "\n";

$start = microtime(true);

for ($k = 0; $k < MIN_LOOPS; $k++) {
  foreach($testArray as $elem) {
    $temp = $elem;
  }
}

echo "Time to make " . $testName . " = " . round(microtime(true) - $start, 4) . "sec \n";
echo memory_get_usage() . " bytes used by " . $testName . "\n";


echo "\n\n" . "MAX LOOPS = " . MAX_LOOPS . "\n";

$start1 = microtime(true);

for ($k = 0; $k < MAX_LOOPS; $k++) {
  foreach($testArray as $elem) {
    $temp = $elem;
  }
}

echo "Time to make " . $testName . " = " . round(microtime(true) - $start1, 4) . "sec \n";
echo memory_get_usage() . " bytes used by " . $testName . "\n";