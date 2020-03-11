<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
//$userDataSet = new UserDataSet();
//
//$users = $userDataSet->getAllUsers();

require_once('Views/chat.phtml');