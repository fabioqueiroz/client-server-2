<?php

require_once('Models/Database.php');
require_once('Models/Users/User.php');
require_once('Models/BaseDataSet.php');

class UserDataSet extends BaseDataSet
{

    public function __construct() {

        parent::__construct();
    }

    // Register a new user
    public function createUser($firstName, $lastName, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sqlQuery = "INSERT INTO laf873.users (firstName, lastName, email, password, photo, registrationDate, isAdmin) 
                    VALUES (?,?,?,?, 'https://robohash.org/hiceumquas.jpg?size=50x50&set=set1', NOW(),0)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$firstName, $lastName, $email, $hashedPassword]);
    }

    // Retrieve a list of all users
    public function getAllUsers() {
        $sqlQuery = 'SELECT * FROM laf873.users';

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new User($row);
        }
        return $dataSet;
    }

    // Get the user's information by their id
    public function getUserById($userID) {
        $sqlQuery = "SELECT * FROM laf873.users where userID = '{$userID}'";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new User($row);
        }
        return $dataSet;
    }

    // Verify if the email already exists in the database
    public function emailChecker($email) {
        $sqlQuery = "SELECT email FROM laf873.users WHERE email = ? ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$email]);

        $emailInDB = $statement->fetchColumn();

        return $emailInDB;
    }

    // Get the hashed value of the user's password from the database
    public function passwordChecker($email) {
        $sqlQuery = "SELECT password FROM laf873.users WHERE email = ? ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$email]);

        $hashedResult = $statement->fetchColumn();

        return $hashedResult;
    }

    // Validate if the user's login details are correct
    public function authenticateUser($email, $password) {
        $sqlQuery = 'SELECT * FROM laf873.users WHERE email = ? AND password = ? ';

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$email, $password]);

        $row = $statement->fetch();

        $result[] = new User($row);

        return $result;
    }

    // Allow the user to change the first and last names
    public function updateName($firstName, $lastName, $userID) {
        $sqlQuery = 'UPDATE laf873.users SET firstName = ?, lastName = ?  WHERE userID = ?';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$firstName, $lastName, $userID]);
    }

    // Allow the user to change their password
    public function updatePassword($password, $userID) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sqlQuery = 'UPDATE laf873.users SET password = ? WHERE userID = ?';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$hashedPassword, $userID]);
    }
}