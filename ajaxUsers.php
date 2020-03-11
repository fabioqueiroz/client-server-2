<?php
require_once('Models/Users/UserDataSet.php');

$userDataSet = new UserDataSet();
$users = $userDataSet->getAllUsers();

echo json_encode($users);