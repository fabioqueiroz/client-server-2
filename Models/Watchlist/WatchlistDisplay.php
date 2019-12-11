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

    /**
     * @return the post title
     * coming from the inner join
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return the post message
     * coming from the inner join
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @return the datetime
     * coming from the inner join
     */
    public function getMessageDate()
    {
        return $this->_messageDate;
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