<?php
session_start();

$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];

$view = new stdClass();

$view->isLogged = false;

require_once('Views/signIn.phtml');
