<?php

unset($_SESSION);
setcookie('first', '');
setcookie('second', '');
header('Location: signIn.php');
//require_once ('persistence.php');
