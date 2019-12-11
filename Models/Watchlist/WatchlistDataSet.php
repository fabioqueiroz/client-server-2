<?php

require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/Watchlist/Watchlist.php');
require_once ('Models/Watchlist/WatchlistDisplay.php');

class WatchlistDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    // Allow the user to subscribe to a post
    public function createSubscription($sub_userID, $sub_postID) {
        $sqlQuery = "INSERT INTO laf873.watchlist(sub_userID, sub_postID) VALUES (?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$sub_userID, $sub_postID]);
    }

    // Retrieve the list of subscribed posts by the user
    public function getSubscriptions($sub_userID) {
        $sqlQuery = "select distinct p.title, p.message, p.messageDate, ru.firstName, ru.lastName, ru.photo, w.watchlistID, w.sub_userID, w.sub_postID
                    from laf873.watchlist w
                    inner join laf873.users u on w.sub_userID = u.userID
                    inner join laf873.posts p on w.sub_postID = p.ID
                    inner join laf873.users ru on ru.userID = p.postingUser
                    where w.sub_userID  = ? 
                    order by p.messageDate desc";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$sub_userID]);

        $subscriptions = [];
        while ($row = $statement->fetch()) {
            $subscriptions[] = new WatchlistDisplay($row);
        }
        return $subscriptions;
    }

    // Verify if the post is already in the user's watchlist
    public function checkPostInWatchlist($postID, $userID) {
        $sqlQuery = "select count(*) from laf873.watchlist where sub_postID = ? and sub_userID = ?";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$postID, $userID]);

        $count = $statement->fetchColumn();

        return $count;
    }

    // Allow the user to remove a post from the watchlist
    public function removeFromWatchlist($postID, $userID) {
        $sqlQuery = "delete from laf873.watchlist where sub_postID = ? and sub_userID = ?";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$postID, $userID]);
    }

    // Retrieve a list of all users that subscribe to the post
    public function getSubscribedUsers($sub_postID) {
        $sqlQuery = "select distinct w.watchlistID, w.sub_userID, w.sub_postID from laf873.watchlist w
                    inner join laf873.notifications n on w.sub_postID = ?";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$sub_postID]);

        $subscribers = [];
        while ($row = $statement->fetch()) {
            $subscribers[] = new Watchlist($row);
        }
        return $subscribers;
    }
}