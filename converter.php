<?php
session_start();

$view = new stdClass();
$view->pageTitle = 'Converter';
require_once('Models/Converter.php');;

if(isset($_POST['submit']))
{
    $converter = new Converter($_POST['number'],$_POST['unit']);
    var_dump($converter);
    $result = $converter->convert();

//    $view->result = 'Converting ' . $_POST['number'] . ' from ' . $_POST['unit'] . ' is ' . $result . '.';
    if (!$result)
    {
        $view->result = 'Not a valid number.';
    }
    else
    {
        $view->result = 'Converting ' . $_POST['number'] . ' from ' . $_POST['unit'] . ' is ' . $result . '.';
	}
}
require_once('Views/converter.phtml');