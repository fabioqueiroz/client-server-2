<?php
session_start();
require_once('Models/Topics/TopicDataSet.php');
require_once ('Models/PostDataSet.php');
require_once('Models/Replies/ReplyDataSet.php');
require_once ('Models/Watchlist/WatchlistDataSet.php');

$view = new stdClass();
$topicDataSet = new TopicDataSet();
$postDataSet = new PostDataSet();
$replyDataSet = new ReplyDataSet();
$watchlistDataSet = new WatchlistDataSet();

//var_dump($watchlistDataSet->getSubscriptions($_SESSION['userID']));

$topics = $topicDataSet->getAllTopics();
//$posts = $postDataSet->getAllPosts();
//var_dump($posts);

// pagination - adapted from https://stackoverflow.com/questions/3705318/simple-php-pagination-script
// get the total number of posts
$total = $postDataSet->getTotalNoOfPosts();

// limit per page
$limit = 5;

// How many pages will there be
$pages = ceil($total / $limit);

// Determine the current page
$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

// Calculate the offset for the query
$offset = ($page - 1)  * $limit;

// Some information to display to the user
$start = $offset + 1;
$end = min(($offset + $limit), $total);

// Prepare the paged query
$posts = $postDataSet->makePageQuery($limit, $offset);
//var_dump($posts);


if(isset($_POST['filter']) && !empty($_POST['filter']) && $_SESSION['userID'] != null) {
   $posts = $postDataSet->filterPostsByTitle($_POST['filter']);
   unset($_POST);
   $view->isFiltered = true;

} else {
    $view->erroMessage = true;
}

require_once('Views/forum.phtml');
