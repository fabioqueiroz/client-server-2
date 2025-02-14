<?php
session_start();
require_once('Models/Users/UserDataSet.php');

$view = new stdClass();
$userDataSet = new UserDataSet();

// Verify it's a valid email that matches patterns such as user@aol.com, user@wrox.co.uk, user@domain.info
if(isset($_POST['email']) && !preg_match( '/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/', trim($_POST['email']))) {
    $view->loginError = true;
}

// Allow the user to sign in if the email and password are correct
if(isset($_POST['email']) && isset($_POST['password'])) {

    // Get the hashed password stored in the database
    $hashedPwdInDb = $userDataSet->passwordChecker(strip_tags(trim(($_POST['email']))));

    // Check if the inserted password matches the stored one
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
            // Code to handle a successful authentication
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

