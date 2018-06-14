<?php

class Solution {
  
  public static function checkPalindrom($toCheck) {
    $rawData = str_split($toCheck);
    $halfLength = (int)(count($rawData) / 2);

    return self::compareChars($rawData, $halfLength);
  }

  private static function compareChars($toCheck, $n) {
    if ($n == 0) {
      return true;
    } else if ($toCheck[$n - 1] != $toCheck[count($toCheck) - $n]) {
      return false;
    } else {
      return self::compareChars($toCheck, $n - 1);
    }
  }

}


$testString = 'ttststt';

echo $testString . "\n" . "\n";

if (Solution::checkPalindrom($testString)) {
  echo 'YES!' . "\n";
} else {
  echo 'NO!' . "\n";
}

