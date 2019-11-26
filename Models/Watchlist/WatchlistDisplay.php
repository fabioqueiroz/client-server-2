<?php


class WatchlistDisplay extends Watchlist
{
    private $_title, $_messageDate, $_firstName, $_lastName;

    public function __construct($dbRow)
    {
        parent::__construct($dbRow);

        $this->_title = $dbRow['title'];
        $this->_messageDate = $dbRow['messageDate'];
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
    }

    public function getTitle()
    {
        return $this->_title;
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

}