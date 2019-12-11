<?php
session_start();
require_once ('Models/Watchlist/WatchlistDataSet.php');

$view = new stdClass();
$watchlistDataSet = new WatchlistDataSet();

// Get all the posts in the watchlist
$subscribedPosts = $watchlistDataSet->getSubscriptions($_SESSION['userID']);

// Get the id of the post selected in the checkbox
$ids = $_POST['id'];

// Allow the user to remove a post from the watchlist
if (isset($_POST['id'])) {
    foreach($ids as $id)
    {
        if(isset($_POST['remove-from-watchlist']) && $_POST['remove-rand-check'] == $_SESSION['unsubscribe-rand']) {
            $watchlistDataSet->removeFromWatchlist($id, $_SESSION['userID']);
            $subscribedPosts = $watchlistDataSet->getSubscriptions($_SESSION['userID']);
        }
    }
}

require_once('Views/watchList.phtml');