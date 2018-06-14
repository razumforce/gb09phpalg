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


function ShellSort($elements) { // 5 элементов отсортировал за 15 проходов
  $check = 0;

  $k = 0;
  $length = count($elements);
  $gap[0] = (int)($length / 2);

  while ($gap[$k] > 1) {
    $k++;
    $gap[$k] = (int)($gap[$k - 1] / 2);

    echo "while1 " . $check++ . "\n";

  }

  for ($i = 0; $i <= $k; $i++) { // log N раз (делим длину массивы на 2, потом еще раз на 2 и так до минимального)

    echo "for1 " . $check++ . "\n";

    $step = $gap[$i];
    for($j = $step; $j < $length; $j++) { //по идее в сумме N раз. итого 5 х 3. прочитал что этот алгоритм в общем случае работает за (N x N ^ (3/2))

      echo "for2 " . $check++ . "\n";

      $temp = $elements[$j];
      $p = $j - $step;

      while ($p >= 0 && $temp['price'] < $elements[$p]['price']) {

        echo "while2 " . $check++ . "\n";

        $elements[$p + $step] = $elements[$p];
        $p = $p - $step;
      }

      $elements[$p + $step] = $temp;
    }
  }

  return $elements;
}



$sortedPrices = ShellSort($prices);

var_dump($sortedPrices);


