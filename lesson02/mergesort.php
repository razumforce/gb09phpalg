<?php

$prices = [
  [
    'price' => 21999,
    'shop_name' => 'Shop1',
    'shop_link' => 'http://'
  ],
  [
    'price' => 21550,
    'shop_name' => 'Shop1',
    'shop_link' => 'http://'
  ],
  [
    'price' => 21950,
    'shop_name' => 'Shop1',
    'shop_link' => 'http://'
  ],
  [
    'price' => 21350,
    'shop_name' => 'Shop1',
    'shop_link' => 'http://'
  ],
  [
    'price' => 21050,
    'shop_name' => 'Shop1',
    'shop_link' => 'http://'
  ]
];


function mergeSort($elements, $check) { // всего за 12 операций в цикле

  if (count($elements) <= 1) {
    return $elements;
  } else {
    
    echo "step = " . $check++ . "\n";

    $q = (int)(count($elements) / 2);
    return merge(mergeSort(array_slice($elements, 0, $q), $check), mergeSort(array_slice($elements, $q), $check));
  }
}

function merge($leftArr, $rightArr) {
  $check2 = 0;

  $twoArrCount = count($leftArr) + count($rightArr);

  $leftArr[]['price'] = INF;
  $rightArr[]['price'] = INF;

  $l = 0;
  $r = 0;

  for ($i = 0; $i < $twoArrCount; $i++) {

    echo "for:  " . $check2++ . "\n";

    if ($leftArr[$l]['price'] <= $rightArr[$r]['price']) {
      $arr[] = $leftArr[$l];
      $l++;
    } else {
      $arr[] = $rightArr[$r];
      $r++;
    }
  }

  return $arr;
}




$sortedPrices = mergeSort($prices, 0);

var_dump($sortedPrices);


