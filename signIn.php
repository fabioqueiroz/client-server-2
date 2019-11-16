<?php
session_start();
require_once ('Models/UserDataSet.php');

$view = new stdClass();
$view->isLogged = false;
//$_SESSION['signed_in'] = false;

$userDataSet = new UserDataSet();

if(isset($_POST['email']) && isset($_POST['password'])) {
    $result = $userDataSet->authenticateUser($_POST['email'], $_POST['password']);
    $firstName = '';
    $lastName ='';

    foreach ($result as $value) {
        $firstName = $value->getFirstName();
        $lastName = $value->getLastName();
    }

    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['signed_in'] = true;
    $_COOKIE['logged'] = true;
    $view->isLogged = true;
}
else {
    session_destroy();
}

require_once('Views/signIn.phtml');
