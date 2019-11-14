<?php


class User
{
    private $_userID, $_firstName, $_lastName, $_email, $_password, $_photo, $_registrationDate;

    public function __construct($dbRow)
    {
        $this->_userID = $dbRow['userID'];
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
        $this->_email = $dbRow['email'];
        $this->_password = $dbRow['password'];
        $this->_photo = $dbRow['photo'];
        $this->_registrationDate = $dbRow['registrationDate'];
    }

    public function getUserID()
    {
        return $this->_userID;
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getPhoto()
    {
        return $this->_photo;
    }

    public function getRegistrationDate()
    {
        return $this->_registrationDate;
    }
}