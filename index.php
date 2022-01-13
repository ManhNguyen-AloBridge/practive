<?php

try {
  $dbh = new PDO(
    'mysql:host=127.0.0.1;dbname=db_practive',
    'root',
    'root'
  );
  if ($dbh) {
    echo "Connected to the $db database successfully!";
  }
} catch (PDOException $ex) {
  var_dump($ex);
  echo $ex->getMessage();
}