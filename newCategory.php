<?php
session_start();
require_once('Models/Categories/CategoryDataSet.php');

$view = new stdClass();
$categoryDataSet = new CategoryDataSet();

if(isset($_POST['category-name']) && isset($_POST['category-description'])) {

    if(strlen($_POST['category-description']) > 0 && strlen($_POST['category-description']) <= 100) {
        // Prevent the submission of the same values if the page is reloaded
        if(isset($_POST['category-name']) && $_POST['rand-check'] == $_SESSION['rand']) {
            $categoryDataSet->createCategory(strip_tags(trim(($_POST['category-name']))), strip_tags(trim(($_POST['category-description']))));
            $view->isCategoryCreated = true;
        }
    }
}

require_once('Views/newCategory.phtml');
