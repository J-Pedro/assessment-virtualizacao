<?php

$db_exists = file_exists("daypilot.sqlite");

$db = new PDO('sqlite:daypilot.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$db_exists) {
    //create the database
    $db->exec("CREATE TABLE events (
        id          INTEGER  PRIMARY KEY AUTOINCREMENT NOT NULL,
        name        TEXT,
        start       DATETIME,
        [end]       DATETIME,
        resource_id INTEGER);");

    $db->exec("CREATE TABLE resources (
        id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
        name VARCHAR (200))");

    $data = array(
                    array('name' => 'Person 1'),
                    array('name' => 'Person 2'),
                    array('name' => 'Person 3'),
                    array('name' => 'Person 4')
                );

    $insert = "INSERT INTO resources (name) VALUES (:name)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(':name', $name);

    foreach ($data as $m) {
      $name = $m['name'];
      $stmt->execute();
    }

}
