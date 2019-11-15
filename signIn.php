<?php
session_start();
require_once ('Models/UserDataSet.php');
//$_SESSION['email'] = $_POST['email'];
//$_SESSION['password'] = $_POST['password'];

$view = new stdClass();
$view->isLogged = false;

$userDataSet = new UserDataSet();

if(isset($_POST['email']) && isset($_POST['password'])) {
    $result = $userDataSet->authenticateUser($_POST['email'], $_POST['password']);

    foreach ($result as $value) {
        echo $value->getFirstName();
        echo $result[1];
    }

}

require_once('Views/signIn.phtml');
