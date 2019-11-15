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

        $sqlQuery = "INSERT INTO laf873.users (firstName, lastName, email, password)
                     VALUES (?,?,?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$firstName, $lastName, $email,$hashedPassword]);

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

    public function authenticateUser($email, $password) {
        $sqlQuery = 'SELECT firstName, lastName FROM laf873.users WHERE email = '."$email".' AND password = '."$password".' ';

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $row = $statement->fetch();
        $result[] = new User($row);

        return $result;

    }

}