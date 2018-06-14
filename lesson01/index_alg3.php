<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ALGORITHMS lesson 1</title>
</head>
<body>

<?php

$stack = new SplStack();

$socket = stream_socket_server("tcp://127.0.0.1:1777");

while ($connection = stream_socket_accept($socket, -1)) {
  fwrite($connection, "Hello, write me your message to place into stack or type get_last, to get last msg. \r\n");

  $data = fread($connection, 255);

  if (substr($data, 0, 8) == 'get_last') {
    $lastMessage = $stack->pop();
    fwrite($connection, $lastMessage);
  } else {
    $stack->push($data);
    fwrite($connection, $data);
  }

  fwrite($connection, "All the best!\r\n");
  var_dump($data);
  fclose($connection);

}




?>




  
</body>
</html>