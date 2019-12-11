<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');
require_once('Models/Posts/PostDataSet.php');
require_once('Models/Watchlist/WatchlistDataSet.php');
require_once('Models/Messages/MessageDataSet.php');
require_once('Models/Mailbox/MailboxDataSet.php');
require_once('Models/Notifications/NotificationDataSet.php');

$view = new stdClass();
$replyDataSet = new ReplyDataSet();
$postDataSet = new PostDataSet();
$watchlistDataSet = new WatchlistDataSet();
$messageDataSet = new MessageDataSet();
$mailboxDataSet = new MailboxDataSet();
$notificationDataSet = new NotificationDataSet();

// Get the post information
$post = $postDataSet->getPostById($_GET['postID']);

// Get all the replies linked to the post
$replies = $replyDataSet->getAllRepliesById($_GET['postingUser'], $_GET['postID']);

// Check if the post is already in the watchlist of the user
$count = $watchlistDataSet->checkPostInWatchlist($_GET['postID'], $_SESSION['userID']);
$count == 1 ? $view->isInWatchlist = true : $view->isInWatchlist = false;

// Check if the reply message is within the limit
if(isset($_POST['reply']) && !empty($_POST['reply']) && isset($_POST['getUserID']) && isset($_POST['getPostingUser']) && isset($_POST['getID'])) {

    if(strlen($_POST['reply']) > 0 && strlen($_POST['reply']) <= 300) {

        if(isset($_POST['reply']) && $_POST['rand-check'] == $_SESSION['rand']) {
            // Post a new reply
            $replyDataSet->createReply(htmlentities(trim(($_POST['reply']))), $_POST['getUserID'], $_POST['getPostingUser'], $_POST['getID']);
            $replies = $replyDataSet->getAllRepliesById($_GET['postingUser'], $_GET['postID']);

            // Get all subscribers to the post
            $subscribers = $watchlistDataSet->getSubscribedUsers($_GET['postID']);
            $msgCounter = $messageDataSet->getNoOfNotificationMessages();

            $postTitle = '';
            foreach ($post as $p) {
                $postTitle = $p->getTitle();
            }

            foreach ($subscribers as $subscriber) {
                // Message all subscribers except the user who is replying
                if ($subscriber->getSubUserID() != $_SESSION['userID']){
                    // Generate a notification
                    $notificationMessage = 'New Notification #'. $msgCounter++ . ' for post "'.$postTitle. '". Read it here: <a href="postReplies.php?postID='.$_GET['postID'].'&postingUser='.$_GET['postingUser'].'">view reply</a>.';

                    // Send message and add it to the subscribers' mailboxes
                    $messageDataSet->createMessage($notificationMessage, 87, $subscriber->getSubUserID());
                    $mailboxDataSet->createMailIn($subscriber->getSubUserID(), $notificationMessage, 87);
                }
            }
        }
    }
    else {
        $view->isWrongLimit = true;
    }
}

// Add to the watchlist
if(isset($_POST['add-to-watchlist']) && $_POST['watchlist-rand-check'] == $_SESSION['watchlist-rand']) {
    $watchlistDataSet->createSubscription($_SESSION['userID'], $_GET['postID']);
    $view->isInWatchlist = true;

    // Add to the notifications
    $notificationDataSet->addToNotificationList($_GET['postID']);
}

// Remove from the watchlist
if(isset($_POST['remove-from-watchlist']) && $_POST['watchlist-rand-check'] == $_SESSION['watchlist-rand']) {
    $watchlistDataSet->removeFromWatchlist($_GET['postID'], $_SESSION['userID']);
    $view->isInWatchlist = false;

    // Remove from the notifications
    $notificationDataSet->deleteFromNotificationList($_GET['postID']);
}

require_once('Views/postReplies.phtml');