<?php
session_start();
require_once('Models/Topics/TopicDataSet.php');
require_once('Models/Categories/CategoryDataSet.php');

$view = new stdClass();
$topicDataSet = new TopicDataSet();
$categoryDataSet = new CategoryDataSet();
$postingUser = $_SESSION['userID'];

$categories = $categoryDataSet->getAllCategories();

$categoryID = '';

if(isset($_POST['subject']) && isset($_POST['category']) && isset($_POST['description'])) {
    // get the id from the category selection
    foreach ($categories as $category) {
        if($_POST['category'] == $category->getCategoryName()) {
            $categoryID = $category->getCategoryID();
        }
    }
    if(strlen($_POST['description']) > 0 && strlen($_POST['description']) <= 100) {
        // Prevent the submission of the same values if the page is reloaded
        if(isset($_POST['description']) && $_POST['rand-check'] == $_SESSION['rand']) {
            $result = $topicDataSet->createTopic(strip_tags(trim(($_POST['subject']))), $categoryID, $postingUser, strip_tags(trim(($_POST['description']))));

            $view->isTopicCreated = true;
        }
    }
    else {
        $view->isWrongLimit = true;
    }

}


require_once('Views/newTopic.phtml');
