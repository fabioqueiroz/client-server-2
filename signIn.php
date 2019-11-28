<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$view->isLogged = false;

$userDataSet = new UserDataSet();


if(isset($_POST['email']) && isset($_POST['password'])) {

    $hashedPwdInDb = $userDataSet->passwordChecker($_POST['email']);

    if($hashedPwdInDb == sha1($_POST['password'])) {

        // Verify if the captcha has been checked
        if(isset($_POST['g-recaptcha-response'])) {
            $captcha = $_POST['g-recaptcha-response'];
        }
        if(!$captcha){
            //Captcha hasn't been checked
            echo "Captcha hasn't been checked";
        }
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfrJcUUAAAAACcl0TPtIJZj1iyoN0raZ6BK1Hz5&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

        if($response['success'] == false){
            //Captcha incorrect
            echo "Captcha incorrect";
        }
        else {
            // Code to handle a successful verification
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
        }

//        $result = $userDataSet->authenticateUser($_POST['email'], $_POST['password']);
//        $firstName = $lastName = $email = $password = '';
//        $userID = $photo = $registrationDate = '';
//
//        foreach ($result as $value) {
//            $userID = $value->getUserID();
//            $firstName = $value->getFirstName();
//            $lastName = $value->getLastName();
//            $email = $value->getEmail();
//            $password = $value->getPassword();
//            $photo = $value->getPhoto();
//            $registrationDate = $value->getRegistrationDate();
//        }
//
//        if($firstName != null && $lastName != null) {
//            $_SESSION['userID'] = $userID;
//            $_SESSION['firstName'] = $firstName;
//            $_SESSION['lastName'] = $lastName;
//            $_SESSION['email'] = $email;
//            $_SESSION['password'] = $password;
//            $_SESSION['photo'] = $photo;
//            $_SESSION['registrationDate'] = $registrationDate;
//
//            $_SESSION['signed_in'] = true;
//            $view->isLogged = true;
//        }

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
