<?php
session_start();

$_SESSION['userName'] = $_POST['userName'];
$_SESSION['password'] = $_POST['password'];

$view = new stdClass();
$view->pageTitle = 'Shop';
$view->isLogged = false;

//$products = [
//    array('productId'=> '1', 'name'=> 'Sony TV', 'price'=>'£350'),
//    array('productId'=> '2', 'name'=> 'Panasonic DVD', 'price'=>'£40'),
//    array('productId'=> '3', 'name'=> 'HP Laptop', 'price'=>'£500'),
//    array('productId'=> '4', 'name'=> 'Desktop Monitor', 'price'=>'£150')
//];

if (isset($_SESSION['userName']) && !empty($_SESSION['password'])) {

    if($_POST['userName'] == 'x' && $_POST['password'] == 'x') {
        $view->isLogged = true;
        echo 'logged';
        require_once('productList.php');
    } else {
//        $view->isLogged = false;
//        echo 'not logged';
    }
}


require_once('Views/shop.phtml');