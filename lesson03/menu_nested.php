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
    $dbData = Db::getInstance()->Select("SELECT * FROM menu WHERE root = $rootId ORDER BY id ASC");

    foreach ($dbData as $item) {
      if ($item["level"] == 0) {
        continue;
      }
      $sqlLevel = $item["level"] - 1;
      $sqlLft = $item["lft"];
      $sqlRgt = $item["rgt"];
      $sql = "SELECT id FROM menu WHERE root = $rootId AND level = $sqlLevel
        AND lft < $sqlLft AND rgt > $sqlRgt";

      $pid = Db::getInstance()->Select($sql)[0]["id"];

      if (!isset($this->menuData[$pid])) {
        $this->menuData[$pid] = [];
      }
      $this->menuData[$pid][] = [ 'id' => $item["id"], 'name' => $item["name"] ];
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


// $mainMenu = new Menu(1);

// echo $mainMenu->renderMenu();



