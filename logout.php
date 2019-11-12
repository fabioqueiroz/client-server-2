<?php

unset($_SESSION);
setcookie('first', '');
setcookie('second', '');
header('Location: shop.php');
//require_once ('persistence.php');
