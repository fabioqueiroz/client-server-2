<?php

require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/Watchlist/Watchlist.php');

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
        $sqlQuery = "select * from laf873.watchlist where sub_userID = ?";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$sub_userID]);

        $subscriptions = [];
        while ($row = $statement->fetch()) {
            $subscriptions[] = new Watchlist($row);
        }
        return $subscriptions;
    }

}