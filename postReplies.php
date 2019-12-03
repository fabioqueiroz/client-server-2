<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');
require_once('Models/Posts/PostDataSet.php');
require_once ('Models/Watchlist/WatchlistDataSet.php');
require_once ('Models/Messages/MessageDataSet.php');
require_once ('Models/Notifications/NotificationDataSet.php');

$view = new stdClass();
$replyDataSet = new ReplyDataSet();
$postDataSet = new PostDataSet();
$watchlistDataSet = new WatchlistDataSet();
$messageDataSet = new MessageDataSet();
$notificationDataSet = new NotificationDataSet();

$postID = $_GET['postID'];
$postingUser = $_GET['postingUser'];

$post = $postDataSet->getPostById($_GET['postID']);
//var_dump($post);

$replies = $replyDataSet->getAllRepliesById($_GET['postingUser'], $postID);
//var_dump($replies);

// check if the post is already in the watchlist
$count = $watchlistDataSet->checkPostInWatchlist($_GET['postID'], $_SESSION['userID']);
$count == 1 ? $view->isInWatchlist = true : $view->isInWatchlist = false;


// check if the reply message is within the limit
if(isset($_POST['reply']) && !empty($_POST['reply']) && isset($_POST['getUserID']) && isset($_POST['getPostingUser']) && isset($_POST['getID'])) {

    if(strlen($_POST['reply']) > 0 && strlen($_POST['reply']) <= 300) {
        if(isset($_POST['reply']) && $_POST['rand-check'] == $_SESSION['rand']) {
            $replyDataSet->createReply(strip_tags(trim(($_POST['reply']))), $_POST['getUserID'], $_POST['getPostingUser'], $_POST['getID']);
            $replies = $replyDataSet->getAllRepliesById($_GET['postingUser'], $postID);

            // get all subscribers to the post
            $subscribers = $watchlistDataSet->getSubscribedUsers($_GET['postID']);
            $msgCounter = $messageDataSet->getNoOfNotificationMessages();

            foreach ($subscribers as $subscriber) {
                $notificationMessage = 'New Notification #'. $msgCounter++ . ' for post '.$_GET['postID'];
                $messageDataSet->createMessage($notificationMessage, 87, $subscriber->getSubUserID());
//                $mailboxDataSet->createMailIn($subscriber->getSubUserID(), $notificationMessage, 87); // fails here
            }
        }
    }
    else {
        $view->isWrongLimit = true;
    }
}

// add to the watchlist
if(isset($_POST['add-to-watchlist']) && $_POST['watchlist-rand-check'] == $_SESSION['watchlist-rand']) {
    $watchlistDataSet->createSubscription($_SESSION['userID'], $_GET['postID']);
    $view->isInWatchlist = true;

    // add to the notifications
    $notificationDataSet->addToNotificationList($_GET['postID']);
}

// remove from the watchlist
if(isset($_POST['remove-from-watchlist']) && $_POST['watchlist-rand-check'] == $_SESSION['watchlist-rand']) {
    $watchlistDataSet->removeFromWatchlist($_GET['postID']);
    $view->isInWatchlist = false;

    // remove from the notifications
    $notificationDataSet->deleteFromNotificationList($_GET['postID']);
}

require_once('Views/postReplies.phtml');