<?php
require_once '_db.php';
    
class Resource {}

$resources = array();

$stmt = $db->prepare('SELECT * FROM resources ORDER BY name');
$stmt->execute();
$timesheet_resources = $stmt->fetchAll();  

foreach($timesheet_resources as $resource) {
  $r = new Resource();
  $r->id = $resource['id'];
  $r->name = $resource['name'];
  $resources[] = $r;
}

header('Content-Type: application/json');
echo json_encode($resources);

?>
