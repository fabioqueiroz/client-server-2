<?php
session_start();
require_once ('Models/CategoryDataSet.php');

$view = new stdClass();
$categoryDataSet = new CategoryDataSet();

if(isset($_POST['category-name']) && isset($_POST['category-description'])) {
    $categoryDataSet->createCategory($_POST['category-name'], $_POST['category-description']);
    $view->isCategoryCreated = true;
}

// uncomment to stop using modal
require_once('Views/newCategory.phtml');
