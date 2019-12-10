<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$userDataSet = new UserDataSet();

// Get the stored user information
$user = $userDataSet->getUserById($_SESSION['userID']);

// Ensure the input information is within the limits
if(strlen($_POST['firstName']) < 0 || strlen($_POST['firstName']) > 45 || strlen($_POST['lastName']) < 0 || strlen($_POST['lastName']) > 45) {
    $errors = 'Max 45 characters';
}

$hashedPwdInDb = $userDataSet->passwordChecker($_SESSION['email']);

// Allow the user to update the first and last names
if(isset($_POST['password']) && !empty(isset($_POST['password']))) {

    if(password_verify($_POST['password'], $hashedPwdInDb)) {

        if(isset($_POST['firstName']) && !empty($_POST['firstName']) && isset($_POST['lastName']) && !empty($_POST['lastName'])) {

            if($_POST['rand-check'] == $_SESSION['rand']) {
                $firstName = strip_tags(trim(($_POST['firstName'])));
                $lastName = strip_tags(trim(($_POST['lastName'])));

                $userDataSet->updateName($firstName, $lastName, $_SESSION['userID']);
                $_SESSION['firstName'] = $_POST['firstName'];

                $view->isInfoUpdated = true;
            }
        }
    }

    else {
        $view->loginError = true;
    }

    $user = $userDataSet->getUserById($_SESSION['userID']);
}

require_once('Views/profile.phtml');