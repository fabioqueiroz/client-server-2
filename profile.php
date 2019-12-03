<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$userDataSet = new UserDataSet();

$user = $userDataSet->getUserById($_SESSION['userID']);
//var_dump($user);

require_once('Views/profile.phtml');