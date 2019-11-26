<?php
session_start();
require_once ('Models/Watchlist/WatchlistDataSet.php');

$view = new stdClass();
$watchlistDataSet = new WatchlistDataSet();

var_dump($watchlistDataSet->getSubscriptions($_SESSION['userID']));

require_once('Views/watchList.phtml');