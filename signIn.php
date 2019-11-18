<?php
session_start();
require_once ('Models/UserDataSet.php');

$view = new stdClass();
$view->isLogged = false;

$userDataSet = new UserDataSet();

if(isset($_POST['email']) && isset($_POST['password'])) {

    $result = $userDataSet->authenticateUser($_POST['email'], $_POST['password']);
    $firstName = $lastName = $email = $password = '';
    $userID = $photo = $registrationDate = '';

    foreach ($result as $value) {
        $userID = $value->getUserID();
        $firstName = $value->getFirstName();
        $lastName = $value->getLastName();
        $email = $value->getEmail();
        $password = $value->getPassword();
        $photo = $value->getPhoto();
        $registrationDate = $value->getRegistrationDate();
    }

    if($firstName != null && $lastName != null) {
        $_SESSION['userID'] = $userID;
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['photo'] = $photo;
        $_SESSION['registrationDate'] = $registrationDate;

        $_SESSION['signed_in'] = true;
        $view->isLogged = true;
    }
    else {
        $view->loginError = true;
        session_destroy();
    }
}
else {
    session_destroy();
}

require_once('Views/signIn.phtml');
