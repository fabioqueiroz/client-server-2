<?php

require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/Messages/Message.php');
require_once('Models/Messages/MessageDisplay.php');

class MessageDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    // Allow a user to message another user
    public function createMessage($message, $sentBy, $sentTo) {
        $sqlQuery = "INSERT INTO laf873.messages(message, sentBy, sentTo, messageDate) VALUES (?,?,?,NOW())";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$message, $sentBy, $sentTo]);
    }

    // Retrieve all message information directed to a user
    public function getInboxMail($userID) {
        $sqlQuery = "select msg.messageID, msg.message, msg.sentBy, msg.sentTo, msg.messageDate,
                           mbox.mboxID, mbox.mailbox, u.firstName, u.lastName
                    from laf873.messages msg
                    inner join laf873.mailboxes mbox on msg.messageID = mbox.messageID
                    inner join laf873.users u on msg.sentBy = u.userID
                    where mbox.mboxUser = ? and mbox.mailbox = 'In'
                    order by msg.messageDate desc";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$userID]);

        $inbox = [];
        while ($row = $statement->fetch()) {
            $inbox[] = new MessageDisplay($row);
        }
        return $inbox;
    }

    // Retrieve all message information created by a user
    public function getOutboxMail($userID) {

        $sqlQuery = "select msg.messageID, msg.message, msg.sentBy, msg.sentTo, msg.messageDate,
                           mbox.mboxID, mbox.mailbox, u.firstName, u.lastName
                    from laf873.messages msg
                    inner join laf873.mailboxes mbox on msg.messageID = mbox.messageID
                    inner join laf873.users u on msg.sentTo = u.userID
                    where mbox.mboxUser = ? and mbox.mailbox = 'Out'
                    order by msg.messageDate desc";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$userID]);

        $outbox = [];
        while ($row = $statement->fetch()) {
            $outbox[] = new MessageDisplay($row);
        }
        return $outbox;
    }

    // Get the amount of generated notifications
    public function getNoOfNotificationMessages() {
        $sqlQuery = "select count(*) from laf873.messages where sentBy = 87;";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $count = $statement->fetchColumn();

        return $count;
    }
}