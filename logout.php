<?php

unset($_SESSION);
setcookie('first', '');
setcookie('second', '');
$_SESSION['signed_in'] = false;
$_SESSION['firstName'] = '';

header('Location: signIn.php');

