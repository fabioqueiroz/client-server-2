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

    /**
     * @return the user id
     */
    public function getUserID()
    {
        return $this->_userID;
    }

    /**
     * @return the user's first name
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * allow the user to set the first name
     * @param $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @return the user's first name
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * allow the user to set the last name
     * @param $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * @return the user's email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return the user's password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return the user's photo
     */
    public function getPhoto()
    {
        return $this->_photo;
    }

    /**
     * allow the user to change the photo
     * @param $photo
     */
    public function setPhoto($photo)
    {
        $this->_photo = $photo;
    }

    /**
     * @return the datetime the
     * profile was created
     */
    public function getRegistrationDate()
    {
        return $this->_registrationDate;
    }

    /**
     * @return a tinyint (0 or 1)
     */
    public function getIsAdmin()
    {
        return $this->_isAdmin;
    }
}