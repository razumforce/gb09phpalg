<?php

$testString = 'ttststta';

$rawData = str_split($testString);
$halfLength = (int)(count($rawData) / 2);

echo $testString . "\n" . "\n";
echo $halfLength . "\n";

function checkPalindrom($toCheck, $n) {
  echo "iteration = " . $n . "\n";

  if ($n == 0) {
    return true;
  }

  if ($toCheck[$n - 1] != $toCheck[count($toCheck) - $n]) {
    return false;
  } else {
    return checkPalindrom($toCheck, $n - 1);
  }

}

if (checkPalindrom($rawData, $halfLength)) {
  echo 'YES!' . "\n";
} else {
  echo 'NO!' . "\n";
}

