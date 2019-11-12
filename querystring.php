<?php

$view = new stdClass();
$view->pageTitle = 'Query';

$host = 'poseidon.salford.ac.uk';
$dbName = 'laf873';
$user = 'laf873';
$pass = 'Testlaf873';

$rows = [];
$data = [];

$dbHandle = new PDO("mysql:host=$host;dbname=$dbName",$user,$pass);

$sqlQuery = "SELECT * FROM laf873.students WHERE courseID='SE'";
//echo $sqlQuery;

$statement = $dbHandle->prepare($sqlQuery);
$statement->execute();

echo "<table border='1'>";
while ($row = $statement->fetch()) {
//    echo "<tr><td>" . $row[0] ."</td><td>". $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[4];
    array_push($rows, $row[0], $row[1], $row[2], $row[4]);
}
array_push($data, $rows);

echo "</table>";
$dbHandle = null;

require_once('Views/querystring.phtml');
