<?php

class Menu {

  public $menuData = [];
  

  public function renderMenu($items = [], $level = 0) {
    if ($level == 0) {
      $items = $this->$menuData;
    }
    $html = "<ul>";
    foreach ($items[$level] as $item) {
      $html .= "<li>" . $item["name"];

      if(isset($items[$item["id"]])) {
        $html .= "<ul>";
        $html .= $this->renderMenu($items, $item["id"]);
        $html .= "</ul>";
      }

      $html .= "</li>";
    }

    $html .= "</ul>";
    return $html;
  }

}


$mainMenu = new Menu();
$footerMenu = new Menu();

$mainMenu->$menuData = [
    0 => [
      [ 'id' => 1, 'name' => 'About'],
      [ 'id' => 2, 'name' => 'Services'],
      [ 'id' => 3, 'name' => 'Contacts']
    ],
    1 => [
      [ 'id' => 4, 'name' => 'Our History'],
      [ 'id' => 5, 'name' => 'Out Mission']
    ],
    3 => [
      [ 'id' => 6, 'name' => 'Address'],
      [ 'id' => 7, 'name' => 'Send request']
    ],
    4 => [
      [ 'id' => 8, 'name' => 'Founders'],
      [ 'id' => 9, 'name' => 'First project'],
      [ 'id' => 10, 'name' => 'Milestones']
    ]
  ];

$footerMenu->$menuData = [
    0 => [
      [ 'id' => 1, 'name' => 'Home'],
      [ 'id' => 2, 'name' => 'Add info'],
      [ 'id' => 3, 'name' => 'News']
    ],
    1 => [
      [ 'id' => 4, 'name' => 'History'],
      [ 'id' => 5, 'name' => 'Mission']
    ],
    3 => [
      [ 'id' => 6, 'name' => 'Address'],
      [ 'id' => 7, 'name' => 'Send request']
    ],
    4 => [
      [ 'id' => 8, 'name' => 'Founders'],
      [ 'id' => 9, 'name' => 'First project'],
      [ 'id' => 10, 'name' => 'Milestones']
    ]
  ];  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MENU - 03</title>
</head>
<body>
<?php
  echo $mainMenu->renderMenu();
  echo $footerMenu->renderMenu();
?>
</body>
</html>