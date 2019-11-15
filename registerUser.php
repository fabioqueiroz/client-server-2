<?php
session_start();

require_once ('Models/UserDataSet.php');

$view = new stdClass();
$userDataSet = new UserDataSet();

$errors =[];

if (!isset($_POST['firstName']) && empty(($_POST['firstName']))) {
    $errors = 'You must insert your first name';
}

if (!isset($_POST['lastName']) && empty(($_POST['lastName']))) {
    $errors = 'You must insert your last name';
}

if (!isset($_POST['email']) && empty(($_POST['email']))) {
    $errors = 'You must insert a valid email';
}

if (!isset($_POST['password']) && empty(($_POST['password']))) {
    $errors = 'You must insert a password';
}

if (!isset($_POST['re-typed-password']) && empty(($_POST['re-typed-password']))) {
    $errors = 'You must re-type your password';
}

if (isset($_POST['password'])) {
    if ($_POST['password'] != $_POST['re-typed-password']) {
        $errors = 'The passwords do not match';
    }
}

//if(!empty($errors)) {
//
//    echo '<ul>';
//    foreach($errors as $key => $value)
//    {
//        echo '<li>' . $value . '</li>';
//    }
//    echo '</ul>';
//}

else {

    $userDataSet->createUser($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password']);

    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['email'] = $_POST['email'];

}

require_once('Views/registerUser.phtml');
