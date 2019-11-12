<?php
session_start();

$_SESSION['inputName'] = $_POST['name'];
$_SESSION['inputDOB'] = $_POST['birthday'];

$view = new stdClass();
$view->pageTitle = 'Persistence';

if (isset($_SESSION['inputName']) && !empty($_SESSION['inputName'])) {
    setcookie('first', $_POST['name']);
    setcookie('second', $_POST['birthday']);
}

elseif (isset($_COOKIE['first']) && isset($_COOKIE['second'])) {
    $view->cookieMessage = "Welcome " .$_COOKIE['first'] . " DOB: " .$_COOKIE['second'];
}


// input data
$name = $_POST['name'].PHP_EOL;
$birthday = $birthdayError = " ";

$message = "Hello " .$name."<br>";


if (empty($_POST['birthday'])) {
    $birthdayError = "Invalid date (not in method check)";

} else {
    $birthday = dateValidation($_POST['birthday']);
}

function dateValidation($date) {

    $testDate = explode('/', $date);

    if (checkdate($testDate[1], $testDate[0], $testDate[2])) {

        if ($testDate[2] < 1919) {
            echo "Invalid year"."<br>";

        } else {
//            echo "Birthday:  " .$date."<br>";
            global $view;
            $view->loggedIn = true;
        }
    }
}

require_once('Views/persistence.phtml');