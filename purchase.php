<?php

$view = new stdClass();
$items = [
    array('productId'=> '1', 'name'=> 'test 1', 'price'=>'£350'),
    array('productId'=> '2', 'name'=> 'test 2', 'price'=>'£300'),
    array('productId'=> '3', 'name'=> 'test 3', 'price'=>'£500'),
    array('productId'=> '4', 'name'=> 'test 4', 'price'=>'£150')
];
$productName = $_GET['name'];
$productPrice = $_GET['price'];

require_once('Views/purchase.phtml');
