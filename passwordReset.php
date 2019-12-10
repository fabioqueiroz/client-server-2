<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$userDataSet = new UserDataSet();
$errors = array();

// Ensure the old password field has been filled
if (!isset($_POST['old-password']) || empty(($_POST['old-password']))) {
    $errors = 'You must insert your old password';
}

// Ensure the new password field has been filled
if (!isset($_POST['new-password']) || empty(($_POST['new-password']))) {
    $errors = 'You must insert your new password';
}

// Ensure the re-type new password field has been filled
if (!isset($_POST['re-typed-password']) || empty(($_POST['re-typed-password']))) {
    $errors = 'You must re-type your new password';
}

// Ensure the new password has been re-typed correctly and matches the previous password field
if (isset($_POST['new-password'])) {

    if ($_POST['old-password'] == $_POST['new-password']) {
        $errors = 'The new password must be different from the old one';
    }

    if ($_POST['new-password'] != $_POST['re-typed-password']) {
        $errors = 'The new password values do not match';
    }

    if (!(strlen($_POST['new-password']) >= 3 && strlen($_POST['new-password']) <= 20)) {
        $errors = 'The password must be between 3 and 20 characters';
    }
}

// Update the password
if(empty($errors) && isset($_POST['new-password']) && !empty(($_POST['new-password']))) {

    // Check if the old password is correct
    $hashedPwdInDb = $userDataSet->passwordChecker($_SESSION['email']);

    if(password_verify($_POST['old-password'], $hashedPwdInDb)) {

        if($_POST['rand-check'] == $_SESSION['rand']) {
            // Change the password in the database
            $userDataSet->updatePassword(strip_tags(trim(($_POST['new-password']))), $_SESSION['userID']);
            $view->isInfoUpdated = true;
        }
    }

    else {
        $errors = 'Your password is incorrect';
        $view->loginError = true;
    }
}

require_once('Views/passwordReset.phtml');
