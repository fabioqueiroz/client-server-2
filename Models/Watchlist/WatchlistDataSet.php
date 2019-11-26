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

    public function createSubscription($sub_userID, $sub_postID) {
        $sqlQuery = "INSERT INTO laf873.watchlist(sub_userID, sub_postID) VALUES (?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$sub_userID, $sub_postID]);
    }


    public function getSubscriptions($sub_userID) {
        $sqlQuery = "select distinct p.title, p.message, p.messageDate, ru.firstName, ru.lastName, ru.photo, w.watchlistID, w.sub_userID, w.sub_postID
                    from laf873.watchlist w
                    inner join laf873.users u on w.sub_userID = u.userID
                    inner join laf873.posts p on w.sub_postID = p.ID
                    inner join laf873.replies r on p.postingUser = r.replyTo
                    inner join laf873.users ru on ru.userID = r.replyTo
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

    public function checkPostInWatchlist($postID) {
        $sqlQuery = "select count(*) from laf873.watchlist where sub_postID = ?";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$postID]);

        $count = $statement->fetchColumn();

        return $count;
    }

    public function removeFromWatchlist($postID) {
        $sqlQuery = "delete from laf873.watchlist where sub_postID = ? ";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$postID]);
    }
}