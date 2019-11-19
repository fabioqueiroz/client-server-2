<?php


class PostDisplay extends Post
{
    private $_firstName, $_lastName;

    public function __construct($dbRow) {
        parent::__construct($dbRow);
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

}