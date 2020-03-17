<?php
require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/ChatMessages/ChatMessage.php');

class ChatMessageDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    // Get all the messages sent to a user
    public function getReceivedMessages($userID) {
        $sqlQuery = "select c.chatMessageID, c.message, c.senderID, c.receiverID, c.messageDate
                    from laf873.chats c
                    where c.receiverID = ?
                    order by c.messageDate desc";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$userID]);

        $inbox = [];
        while ($row = $statement->fetch()) {
            $inbox[] = new ChatMessage($row);
        }
        return $inbox;
    }


    // Get all the messages sent to a user //
    public function getMessagesBySenderId($userID, $senderID) {
        $sqlQuery = "select c.chatMessageID, c.message, c.senderID, c.receiverID, c.messageDate, c.image
                    from laf873.chats c
                    where (c.receiverID = ? and c.senderID = ?) or (c.senderID = ? and c.receiverID = ?)
                    order by c.messageDate";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$userID,$senderID,$userID,$senderID]);

        $inbox = [];

        while ($row = $statement->fetch()) {
            $inbox[] = new ChatMessage($row);
        }
        return $inbox;
    }


    // Allow a user to message another user
    public function sendNewMessage($message, $senderID, $receiverID) {
        $sqlQuery = "INSERT INTO laf873.chats (message, senderID, receiverID, messageDate) VALUES (?,?,?,NOW())";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$message, $senderID, $receiverID]);
    }

    // Allow a user to send an image to another user
    public function sendImage($senderID, $receiverID, $image) {
        $sqlQuery = "INSERT INTO laf873.chats (senderID, receiverID, messageDate, image) VALUES (?,?,NOW(),?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$senderID, $receiverID, $image]);
    }

    // Check the number of messages in the inbox
    public function messageCounter($receiverID) {
        $sqlQuery = "select count(c.chatMessageID) from laf873.chats c where c.receiverID = ?"; // select count(c.chatMessageID) from laf873.chats c where c.receiverID = 81;

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$receiverID]);

        $total = $statement->fetchColumn();

        return $total;
    }

}