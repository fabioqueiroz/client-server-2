<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$view->isRegistered = false;
$userDataSet = new UserDataSet();

$errors = array();

// Ensure the first name field has been filled
if (!isset($_POST['firstName']) || empty(($_POST['firstName']))) {
    $errors = 'You must insert your first name';
}

// Ensure the last name field has been filled
if (!isset($_POST['lastName']) || empty(($_POST['lastName']))) {
    $errors = 'You must insert your last name';
}

// Ensure both first and last names are within the max 45 characters length
if (strlen($_POST['firstName']) < 0 || strlen($_POST['firstName']) > 45 || strlen($_POST['lastName']) < 0 || strlen($_POST['lastName']) > 45) {
    $errors = 'Max 45 characters';
}

// Ensure the last name field has been filled
if (!isset($_POST['email']) || empty(($_POST['email']))) {
    $errors = 'You must insert a valid email';
}

// Verify it's a valid email that matches patterns such as user@aol.com, user@wrox.co.uk, user@domain.info
if(isset($_POST['email']) && !preg_match( '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', trim($_POST['email']))) {
    $errors = 'Please ensure it is a valid email';
}

// Ensure the password field has been filled
if (!isset($_POST['password']) || empty(($_POST['password']))) {
    $errors = 'You must insert a password';
}

// Ensure the re-type password field has been filled
if (!isset($_POST['re-typed-password']) || empty(($_POST['re-typed-password']))) {
    $errors = 'You must re-type your password.';
}

// Ensure the password has been re-typed correctly and matches the previous password field
if (isset($_POST['password'])) {
    if ($_POST['password'] != $_POST['re-typed-password']) {
        $errors = 'The passwords do not match';
    }
    if (!(strlen($_POST['password']) >= 3 && strlen($_POST['password']) <= 20)) {
        $errors = 'The password must be between 3 and 20 characters';
    }
}

// Sanitize the email input
$email = strip_tags(trim(($_POST['email'])));

// Check if the email already exists in the db
$emailInDB = $userDataSet->emailChecker($email);
$emailInDB == $email ? $errors = 'This email is already registered' : '';

// Process a new user registration
if(empty($errors) && isset($_POST['password']) && !empty(($_POST['password']))) {

    $firstName = strip_tags(trim(($_POST['firstName'])));
    $lastName = strip_tags(trim(($_POST['lastName'])));
    $password = strip_tags(trim(($_POST['password'])));

    // Verify if the captcha has been checked
    if(isset($_POST['g-recaptcha-response'])) {
        $captcha = $_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        //Captcha hasn't been checked
        $errors = "Captcha hasn't been checked";
    }
    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfrJcUUAAAAACcl0TPtIJZj1iyoN0raZ6BK1Hz5&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

    if($response['success'] == false){
        //Captcha incorrect
        $errors = "Captcha incorrect";
    }
    else {

        $userDataSet->createUser($firstName, $lastName, $email, $password);
        $hashedPwdInDb = $userDataSet->passwordChecker(strip_tags(trim(($_POST['email']))));

        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['signed_in'] = true;

        $view->isRegistered = true;

        $result = $userDataSet->authenticateUser(strip_tags(trim(($_POST['email']))), $hashedPwdInDb);
        foreach ($result as $value) {
            $_SESSION['userID'] = $value->getUserID();
        }
    }
}

require_once('Views/registerUser.phtml');
