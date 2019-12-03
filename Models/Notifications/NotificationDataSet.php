<?php

require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/Notifications/Notification.php');

class NotificationDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addToNotificationList($postID) {
        $sqlQuery = "insert into laf873.notifications (ntf_postID) values(?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$postID]);
    }

    public function deleteFromNotificationList($postID) {
        $sqlQuery = "delete from laf873.notifications where ntf_postID = ?";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$postID]);
    }

}