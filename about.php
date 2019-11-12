<?php
session_start();

$view = new stdClass();
$view->pageTitle = 'About';
require_once('Views/about.phtml');