<?php
session_start();
require_once ('Models/Watchlist/WatchlistDataSet.php');

$view = new stdClass();
$watchlistDataSet = new WatchlistDataSet();

$subscribedPosts = $watchlistDataSet->getSubscriptions($_SESSION['userID']);
//var_dump($subscribedPosts);

$ids = $_POST['id'];
//var_dump($ids);

if (isset($_POST['id'])) {
    foreach($ids as $id)
    {
        if(isset($_POST['remove-from-watchlist']) && $_POST['remove-rand-check'] == $_SESSION['unsubscribe-rand']) {
            $watchlistDataSet->removeFromWatchlist($id);
            $subscribedPosts = $watchlistDataSet->getSubscriptions($_SESSION['userID']);
        }
    }
}

require_once('Views/watchList.phtml');