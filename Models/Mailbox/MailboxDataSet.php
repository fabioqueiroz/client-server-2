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

    public function createMailOut($mboxUser, $message, $sentTo) {
//        $sqlQuery = "INSERT INTO laf873.mailboxes(mboxUser, mailbox, messageID) VALUES (?,'Out',?)";
        $sqlQuery = "INSERT INTO laf873.mailboxes(mboxUser, mailbox, messageID) 
                    VALUES (?,'Out',
                            (select messageID from laf873.messages m 
                            where m.message = ? 
                            and m.sentTo = ?))";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$mboxUser, $message, $sentTo]);
    }

    public function createMailIn($mboxUser, $message, $sentBy) {
//        $sqlQuery = "INSERT INTO laf873.mailboxes(mboxUser, mailbox, messageID) VALUES (?,'In',?)";
        $sqlQuery = "INSERT INTO laf873.mailboxes(mboxUser, mailbox, messageID) 
                    VALUES (?,'In',
                            (select messageID from laf873.messages m 
                            where m.message = ? 
                            and m.sentBy = ?))";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$mboxUser, $message, $sentBy]);
    }

}