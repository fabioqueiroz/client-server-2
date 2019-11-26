<?php


class WatchlistDisplay extends Watchlist
{
    private $_title, $_message, $_messageDate, $_firstName, $_lastName, $_image;

    public function __construct($dbRow)
    {
        parent::__construct($dbRow);

        $this->_title = $dbRow['title'];
        $this->_message = $dbRow['message'];
        $this->_messageDate = $dbRow['messageDate'];
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
        $this->_image = $dbRow['photo'];
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getMessageDate()
    {
        return $this->_messageDate;
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