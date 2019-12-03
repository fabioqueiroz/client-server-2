<?php


class Notification
{
    private $_notificationID, $_ntf_postID, $_ntf_watchlistID;

    public function __construct($dbRow)
    {
        $this->_notificationID = $dbRow['notificationID'];
        $this->_ntf_postID = $dbRow['ntf_postID'];
        $this->_ntf_watchlistID = $dbRow['ntf_watchlistID'];
    }

    /**
     * @return mixed
     */
    public function getNotificationID()
    {
        return $this->_notificationID;
    }

    /**
     * @return mixed
     */
    public function getNtfPostID()
    {
        return $this->_ntf_postID;
    }

    /**
     * @return mixed
     */
    public function getNtfWatchlistID()
    {
        return $this->_ntf_watchlistID;
    }

}