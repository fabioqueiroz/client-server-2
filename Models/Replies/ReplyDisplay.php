<?php


class ReplyDisplay extends Reply
{
    private $_replierFirstName, $_replierLastName, $_replyImage;

    public function __construct($dbRow)
    {
        parent::__construct($dbRow);

        $this->_replierFirstName = $dbRow['firstName'];
        $this->_replierLastName = $dbRow['lastName'];
        $this->_replyImage = $dbRow['photo'];
    }

    public function getReplierFirstName()
    {
        return $this->_replierFirstName;
    }

    public function getReplierLastName()
    {
        return $this->_replierLastName;
    }

    public function getReplyImage()
    {
        return $this->_replyImage;
    }
}