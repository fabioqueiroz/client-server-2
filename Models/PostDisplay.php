<?php


class PostDisplay extends Post
{
    private $_firstName, $_lastName;

    public function __construct($dbRow) {
        parent::__construct($dbRow);
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

}