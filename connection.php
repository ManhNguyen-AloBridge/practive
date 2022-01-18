<?php
class DB
{
  private static $instance = NULl;
  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      try {
        self::$instance =  new PDO(
          'mysql:host=127.0.0.1;dbname=db_practive',
          'root',
          'root'
        );
      } catch (PDOException $ex) {
        die($ex->getMessage());
      }
    }
    return self::$instance;
  }
}