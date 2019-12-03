<?php


class PostDisplay extends Post
{
    private $_firstName, $_lastName, $_image;

    public function __construct($dbRow) {
        parent::__construct($dbRow);
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
        $this->_image = $dbRow['photo'];
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

    public function getImage()
    {
        return $this->_image;
    }

}