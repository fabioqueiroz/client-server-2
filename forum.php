<?php
session_start();
require_once('Models/Topics/TopicDataSet.php');
require_once('Models/Posts/PostDataSet.php');
require_once('Models/Replies/ReplyDataSet.php');
require_once ('Models/Watchlist/WatchlistDataSet.php');


$view = new stdClass();
$topicDataSet = new TopicDataSet();
$postDataSet = new PostDataSet();
$replyDataSet = new ReplyDataSet();
$watchlistDataSet = new WatchlistDataSet();

$topics = $topicDataSet->getAllTopics();

// Pagination - adapted and modified from https://stackoverflow.com/questions/3705318/simple-php-pagination-script
// Get the total number of posts
$total = $postDataSet->getTotalNoOfPosts();

// Define the limit per page
$limit = 20;

// Calculate the number of pages to be displayed
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

// Add the information to be displayed to the user
$start = $offset + 1;
$end = min(($offset + $limit), $total);

// Prepare the paged query
$posts = $postDataSet->makePageQuery($limit, $offset);
//var_dump($posts);


// Allow the user to filter the posts
if(isset($_POST['filter']) && !empty($_POST['filter'])) {
    $posts = $postDataSet->filterPostsByTitle(strip_tags(trim(($_POST['filter']))));
    unset($_POST);
    $view->isFiltered = true;

} else {
    $view->erroMessage = true;
}

require_once('Views/forum.phtml');
