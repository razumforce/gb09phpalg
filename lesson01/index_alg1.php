<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ALGORITHMS lesson 1</title>
</head>
<body>

<?php

$dirPath = $_GET['dir'];

$dir = new DirectoryIterator('./' . $dirPath);


foreach ($dir as $item) {
  $type = $item->getType();
  if ($type == 'dir') {
    switch ($item) {
      case '.':
        echo '<a href="./">' . $item . '</a>' . '<br>';
        break;
      case '..':
        $dirPrev = explode('/', $dirPath);
        array_pop($dirPrev);
        array_pop($dirPrev);
        $dir2 = implode('/', $dirPrev);
        echo '<a href="./?dir=' . $dir2 . '/">' . $item . '</a>' . '<br>';
        echo 'two-dot' . '<br>';
        break;
      default:
        echo '<a href="./?dir=' . $dirPath . $item . '/">' . $item . '</a>' . '<br>';
    }
  } else {
    echo $item . '<br>';
  }
  
  
  

}

?>




  
</body>
</html>