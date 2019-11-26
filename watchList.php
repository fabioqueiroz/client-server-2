<?php
session_start();
require_once ('Models/Watchlist/WatchlistDataSet.php');

$view = new stdClass();
$watchlistDataSet = new WatchlistDataSet();

$subscribedPosts = $watchlistDataSet->getSubscriptions($_SESSION['userID']);
//var_dump($subscribedPosts);

echo $_POST['getWatchlistID'];

//if(isset($_POST['remove-from-watchlist']) && $_POST['remove-rand-check'] == $_SESSION['unsubscribe-rand']) {
//
//}

require_once('Views/watchList.phtml');