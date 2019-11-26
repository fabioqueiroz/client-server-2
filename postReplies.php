<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');
require_once ('Models/PostDataSet.php');
require_once ('Models/PostDisplay.php');
require_once ('Models/Watchlist/WatchlistDataSet.php');

$view = new stdClass();
$replyDataSet = new ReplyDataSet();
$postDataSet = new PostDataSet();
$watchlistDataSet = new WatchlistDataSet();

$postID = $_GET['postID'];
$postingUser = $_GET['postingUser'];
//echo $postID . ' '.$postingUser;
//var_dump($_SESSION);

$post = $postDataSet->getPostById($_GET['postID']);
//var_dump($post);

$replies = $replyDataSet->getAllRepliesById($_GET['postingUser'], $postID);
//var_dump($replies);

// check if the post is already in the watchlist
$count = $watchlistDataSet->checkPostInWatchlist($_GET['postID']);
$count == 1 ? $view->isInWatchlist = true : $view->isInWatchlist = false;

if(isset($_POST['reply']) && !empty($_POST['reply']) && isset($_POST['getUserID']) && isset($_POST['getPostingUser']) && isset($_POST['getID'])) {

    if(isset($_POST['reply']) && $_POST['rand-check'] == $_SESSION['rand']) {
        $replyDataSet->createReply($_POST['reply'], $_POST['getUserID'], $_POST['getPostingUser'], $_POST['getID']);
        $replies = $replyDataSet->getAllRepliesById($_GET['postingUser'], $postID);
    }
}

if(isset($_POST['add-to-watchlist']) && $_POST['watchlist-rand-check'] == $_SESSION['watchlist-rand']) {
    $watchlistDataSet->createSubscription($_SESSION['userID'], $_GET['postID']);
    $view->isInWatchlist = true;
}

require_once('Views/postReplies.phtml');