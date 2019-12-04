<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$userDataSet = new UserDataSet();

$user = $userDataSet->getUserById($_SESSION['userID']);

if(strlen($_POST['firstName']) < 0 || strlen($_POST['firstName']) > 45 || strlen($_POST['lastName']) < 0 || strlen($_POST['lastName']) > 45) {
    $errors = 'Max 45 characters';
}

$hashedPwdInDb = $userDataSet->passwordChecker($_SESSION['email']);

if(isset($_POST['password']) && !empty(isset($_POST['password']))) {

    if(password_verify($_POST['password'], $hashedPwdInDb)) {

        if(isset($_POST['firstName']) && !empty($_POST['firstName'])) {
            if(isset($_POST['firstName']) && $_POST['rand-check'] == $_SESSION['rand']) {
                $firstName = strip_tags(trim(($_POST['firstName'])));
                $userDataSet->updateFirstName($firstName, $_SESSION['userID']);
            }
        }

        if(isset($_POST['lastName']) && !empty($_POST['lastName'])) {
            if(isset($_POST['lastName']) && $_POST['rand-check'] == $_SESSION['rand']) {
                $lastName = strip_tags(trim(($_POST['lastName'])));
                $userDataSet->updateLastName($lastName, $_SESSION['userID']);
            }
        }
    }

    else {
        $view->loginError = true;
    }

    $user = $userDataSet->getUserById($_SESSION['userID']);
}

require_once('Views/profile.phtml');