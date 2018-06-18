<?php

class Db {
  private static $_instance = null;

  private $db;

  public static function getInstance() {
    if (self::$_instance == null) {
      self::$_instance = new Db();
    }
    return self::$_instance;

  }

  private function __construct() {}
  private function __sleep() {}
  private function __wakeup() {}
  private function __clone() {}

  public function Connect($user = 'useralg', $password = '1234', $base = 'phpalg', $host = '192.168.0.100', $port = 3306) {
    $connectString = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $base . ';charset=UTF8;';
    $this->db = new PDO($connectString, $user, $password,
      [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
    );
  }

  public function Query($query, $params = array()) {
    $res = $this->db->prepare($query);
    $res->execute($params);
    return $res;
  }

  public function Select($query, $params = array()) {
    $result = $this->Query($query, $params);
    if ($result) {
      return $result->fetchAll();
    }
  }

}

class Menu {

  public $menuData = [];

  public function __construct($rootId) {
    Db::getInstance()->Connect();
    $dbData = Db::getInstance()->Select("select c.id, c.name, cl.parent_id, cl.child_id, cl.level 
      from clmenucat as c inner join clmenulink as cl on c.id = cl.child_id 
      WHERE cl.parent_id = $rootId ORDER BY c.id ASC");

    // var_dump($dbData);

    foreach ($dbData as $item) {
      $sqlLevel = $item["level"] + 1;
      $sqlParent = $item["id"];
      $sql = "select c.id, c.name, cl.parent_id, cl.child_id, cl.level from clmenucat as c
        inner join clmenulink as cl on c.id = cl.child_id
        where cl.parent_id = $sqlParent and level = $sqlLevel ORDER BY c.id ASC";

      $subMenu = Db::getInstance()->Select($sql);

      if (count($subMenu) != 0) {
        $this->menuData[$sqlParent] = [];
        foreach ($subMenu as $elem) {
          $this->menuData[$sqlParent][] = [ 'id' => $elem["id"], 'name' => $elem["name"] ];
        }
      }
    }
  }
  

  public function renderMenu($items = [], $level = 1) {
    if ($level == 1) {
      $items = $this->menuData;
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


$mainMenu = new Menu(1);

echo $mainMenu->renderMenu();



