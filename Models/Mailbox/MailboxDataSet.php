<?php

require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/Mailbox/Mailbox.php');

class MailboxDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createMailOut($mboxUser, $messageID) {
        $sqlQuery = "INSERT INTO laf873.mailboxes(mboxUser, mailbox, messageID) VALUES (?,'Out',?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$mboxUser, $messageID]);
    }

    public function createMailIn($mboxUser, $messageID) {
        $sqlQuery = "INSERT INTO laf873.mailboxes(mboxUser, mailbox, messageID) VALUES (?,'In',?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$mboxUser, $messageID]);
    }

}