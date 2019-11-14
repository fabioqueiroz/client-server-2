<?php

require_once ('Models/Database.php');
require_once ('Models/User.php');

class UserDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function createUser($firstName, $lastName, $email, $password) {
        $hashedPassword = sha1($password);
        $sqlQuery = 'INSERT INTO laf873.users (firstName, lastName, email, password)
                     VALUES ('."$firstName".', '."$lastName".', '."$email".', '."$hashedPassword".')';

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

    }

    public function fetchAllUsers() {
        $sqlQuery = 'SELECT * FROM laf873.users';

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new User($row);
        }
        return $dataSet;
    }

}