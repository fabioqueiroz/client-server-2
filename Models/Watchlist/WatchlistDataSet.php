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
        $sqlQuery = "select distinct p.title, p.messageDate, ru.firstName, ru.lastName, w.sub_userID, w.sub_postID
                    from laf873.watchlist w
                    inner join laf873.users u on w.sub_userID = u.userID
                    inner join laf873.posts p on w.sub_postID = p.ID
                    inner join laf873.replies r on p.postingUser = r.replyTo
                    inner join laf873.users ru on ru.userID = r.replyTo
                    where w.sub_userID  = ?";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$sub_userID]);

        $subscriptions = [];
        while ($row = $statement->fetch()) {
            $subscriptions[] = new WatchlistDisplay($row);
        }
        return $subscriptions;
    }

}