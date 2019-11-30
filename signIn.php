<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();

$userDataSet = new UserDataSet();

if(isset($_POST['email']) && isset($_POST['password'])) {

    $hashedPwdInDb = $userDataSet->passwordChecker(strip_tags(trim(($_POST['email']))));

    // if($hashedPwdInDb == sha1($_POST['password']))

    if(password_verify($_POST['password'], $hashedPwdInDb)) {

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
//            $result = $userDataSet->authenticateUser(strip_tags(trim(($_POST['email']))), strip_tags(trim(($_POST['password']))));
            $result = $userDataSet->authenticateUser(strip_tags(trim(($_POST['email']))), $hashedPwdInDb);
            $firstName = $lastName = $email = $password = '';
            $userID = $photo = $registrationDate = $isAdmin = '';

            foreach ($result as $value) {
                $userID = $value->getUserID();
                $firstName = $value->getFirstName();
                $lastName = $value->getLastName();
                $email = $value->getEmail();
                $password = $value->getPassword();
                $photo = $value->getPhoto();
                $registrationDate = $value->getRegistrationDate();
                $isAdmin = $value->getIsAdmin();
            }

            if($firstName != null && $lastName != null) {
                $_SESSION['userID'] = $userID;
                $_SESSION['firstName'] = $firstName;
                $_SESSION['lastName'] = $lastName;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['photo'] = $photo;
                $_SESSION['registrationDate'] = $registrationDate;
                $_SESSION['isAdmin'] = $isAdmin;

                $_SESSION['signed_in'] = true;
                $view->isLogged = true;
            }
        }
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

