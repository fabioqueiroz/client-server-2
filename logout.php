<?php

unset($_SESSION);
$_SESSION['signed_in'] = false;
$_SESSION['login_error'] = false;
$_SESSION['firstName'] = '';

require_once ('signIn.php');

//header('Location: signIn.php');
//setcookie('first', '');
//setcookie('second', '');

