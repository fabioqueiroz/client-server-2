<?php

require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$view->isRegistered = false;
$userDataSet = new UserDataSet();

$errors = array();

if (!isset($_POST['firstName']) || empty(($_POST['firstName']))) {
    $errors = 'You must insert your first name';
}

if (!isset($_POST['lastName']) || empty(($_POST['lastName']))) {
    $errors = 'You must insert your last name';
}

if (!isset($_POST['email']) || empty(($_POST['email']))) {
    $errors = 'You must insert a valid email';
}

if (!isset($_POST['password']) || empty(($_POST['password']))) {
    $errors = 'You must insert a password';
}

if (!isset($_POST['re-typed-password']) || empty(($_POST['re-typed-password']))) {
    $errors = 'You must re-type your password.';
}

if (isset($_POST['password'])) {
    if ($_POST['password'] != $_POST['re-typed-password']) {
        $errors = 'The passwords do not match';
    }
}

// Sanitize the email input
$email = strip_tags(trim(($_POST['email'])));

// Check if the email already exists in the db
$emailInDB = $userDataSet->emailChecker($email);
$emailInDB == $email ? $errors = 'This email is already registered' : '';

if(empty($errors) && isset($_POST['password']) && !empty(($_POST['password']))) {

    $firstName = strip_tags(trim(($_POST['firstName'])));
    $lastName = strip_tags(trim(($_POST['lastName'])));
    $password = strip_tags(trim(($_POST['password'])));

    $userDataSet->createUser($firstName, $lastName, $email, $password);

    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email'] = $email;
    $_SESSION['signed_in'] = true;

    $view->isRegistered = true;

    $userDataSet->authenticateUser($email, $password);
}

require_once('Views/registerUser.phtml');
