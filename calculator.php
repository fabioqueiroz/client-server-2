<?php
session_start();
//$_SESSION['firstNumber'] = $_POST['numberOne'];
//$_SESSION['secondNumber'] = $_POST['numberTwo'];

$view = new stdClass();
$view->pageTitle = 'Calculator';
require_once('Models/Calculator.php');



if(isset($_POST['submit'])) {

    $calculator = new Calculator($_POST['numberOne'], $_POST['numberTwo'], $_POST['operation']);
    $result = $calculator->calculate();

    if (!$result)
    {
        $view->result = 'Not a valid number.';
    }
    else
    {
        $view->result = 'Result: '  . $result;
    }

}

require_once('Views/calculator.phtml');