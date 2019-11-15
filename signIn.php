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
    $firstName = '';
    $lastName ='';

    foreach ($result as $value) {
        $firstName = $value->getFirstName();
        $lastName = $value->getLastName();

        echo $firstName;
        echo $lastName;
    }

    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['signed_in'] = true;
    $view->isLogged = true;
}

require_once('Views/signIn.phtml');
