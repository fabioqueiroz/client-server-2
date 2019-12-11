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

    /**
     * @return the user's first name
     * coming from the inner join
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @return the user's last name
     * coming from the inner join
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @return the user's photo
     * coming from the inner join
     */
    public function getImage()
    {
        return $this->_image;
    }

}