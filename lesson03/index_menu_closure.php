<?php
require("./menu_closure.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>MENU - 03 - CLOSURE</title>
</head>
<body>
<?php
  $mainMenu = new Menu(1);
  echo $mainMenu->renderMenu();
?>
</body>
</html>