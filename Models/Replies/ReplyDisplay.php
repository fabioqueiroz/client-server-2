<?php


class ReplyDisplay extends Reply
{
    private $_replierFirstName, $_replierLastName;

    public function __construct($dbRow)
    {
        parent::__construct($dbRow);

        $this->_replierFirstName = $dbRow['firstName'];
        $this->_replierLastName = $dbRow['lastName'];
    }

    public function getReplierFirstName()
    {
        return $this->_replierFirstName;
    }

    public function getReplierLastName()
    {
        return $this->_replierLastName;
    }
}