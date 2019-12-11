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

    /**
     * @return the user's first name
     * coming from the inner join
     */
    public function getReplierFirstName()
    {
        return $this->_replierFirstName;
    }

    /**
     * @return the user's last name
     * coming from the inner join
     */
    public function getReplierLastName()
    {
        return $this->_replierLastName;
    }

    /**
     * @return the user's photo
     * coming from the inner join
     */
    public function getReplyImage()
    {
        return $this->_replyImage;
    }
}