<?php


class Watchlist
{
    private $_sub_userID, $_sub_postID;

    public function __construct($dbRow)
    {
        $this->_sub_userID = $dbRow['sub_userID'];
        $this->_sub_postID = $dbRow['sub_postID'];
    }

    public function getSubUserID()
    {
        return $this->_sub_userID;
    }

    public function getSubPostID()
    {
        return $this->_sub_postID;
    }
}