<?php

require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/Messages/Message.php');

class MessageDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createMessage($message, $sentBy, $sentTo) {
        $sqlQuery = "INSERT INTO laf873.messages(message, sentBy, sentTo, messageDate) VALUES (?,?,?,NOW())";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$message, $sentBy, $sentTo]);
    }

}