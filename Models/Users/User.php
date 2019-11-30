<?php


class User
{
    private $_userID, $_firstName, $_lastName, $_email, $_password, $_photo, $_registrationDate, $_isAdmin;

    public function __construct($dbRow)
    {
        $this->_userID = $dbRow['userID'];
        $this->_firstName = $dbRow['firstName'];
        $this->_lastName = $dbRow['lastName'];
        $this->_email = $dbRow['email'];
        $this->_password = $dbRow['password'];
        $this->_photo = $dbRow['photo'];
        $this->_registrationDate = $dbRow['registrationDate'];
        $this->_isAdmin = $dbRow['isAdmin'];
    }

    public function getUserID()
    {
        return $this->_userID;
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function getPhoto()
    {
        return $this->_photo;
    }

    public function setPhoto($photo)
    {
        $this->_photo = $photo;
    }

    public function getRegistrationDate()
    {
        return $this->_registrationDate;
    }

    public function getIsAdmin()
    {
        return $this->_isAdmin;
    }
}