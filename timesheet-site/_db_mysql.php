<?php
$host = "127.0.0.1";
$port = 3306;
$username = "root";
$password = "senha123";
$database = "timesheet";

$db = new PDO("mysql:host=$host;port=$port",
               $username,
               $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE DATABASE IF NOT EXISTS `$database`");
$db->exec("use `$database`");

function tableExists($dbh, $id)
{
    $results = $dbh->query("SHOW TABLES LIKE '$id'");
    if(!$results) {
        return false;
    }
    if($results->rowCount() > 0) {
        return true;
    }
    return false;
}

$exists = tableExists($db, "resources");

if (!$exists) {

  //create the database
  $db->exec("CREATE TABLE IF NOT EXISTS resources (
                        id INTEGER PRIMARY KEY AUTO_INCREMENT,
                        name VARCHAR(200))");


  $db->exec("CREATE TABLE IF NOT EXISTS events (
                        id INTEGER PRIMARY KEY AUTO_INCREMENT,
                        name TEXT,
                        resource_id INTEGER,
                        start DATETIME,
                        end DATETIME)");

  $data = array(
      array('name' => 'Pedro'),
      array('name' => 'Juan'),
      array('name' => 'Thelma'),
      array('name' => 'Bruno')
  );

  $insert = "INSERT INTO resources (name) VALUES (:name)";
  $stmt = $db->prepare($insert);

  $stmt->bindParam(':name', $name);

  foreach ($data as $m) {
    $name = $m['name'];
    $stmt->execute();
  }

}