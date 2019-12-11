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
     * @return the notification id
     */
    public function getNotificationID()
    {
        return $this->_notificationID;
    }

    /**
     * @return the notified post id
     */
    public function getNtfPostID()
    {
        return $this->_ntf_postID;
    }

    /**
     * @return the notified watchlist id
     */
    public function getNtfWatchlistID()
    {
        return $this->_ntf_watchlistID;
    }

}