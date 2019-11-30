<?php

require_once('Models/Database.php');
require_once('Models/Users/User.php');
require_once('Models/BaseDataSet.php');

class UserDataSet extends BaseDataSet
{

    public function __construct() {

        parent::__construct();
    }

    public function createUser($firstName, $lastName, $email, $password) {
//        $hashedPassword = sha1($password);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sqlQuery = "INSERT INTO laf873.users (firstName, lastName, email, password, registrationDate, isAdmin) VALUES (?,?,?,?, NOW(),0)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$firstName, $lastName, $email, $hashedPassword]);

    }

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

    public function emailChecker($email) {
        $sqlQuery = "SELECT email FROM laf873.users WHERE email = ? ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$email]);

        $emailInDB = $statement->fetchColumn();

        return $emailInDB;
    }

    public function passwordChecker($email) {
        $sqlQuery = "SELECT password FROM laf873.users WHERE email = ? ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$email]);

        $hashedResult = $statement->fetchColumn();

        return $hashedResult;
    }

    public function authenticateUser($email, $password) {
//        $hashedPassword = sha1($password);
        $sqlQuery = 'SELECT * FROM laf873.users WHERE email = ? AND password = ? ';

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$email, $password]);

        $row = $statement->fetch();

        $result[] = new User($row);

        return $result;

    }

    // ******* to complete ********
    public function updateUser($email, $password) {
       $user = $this->authenticateUser($email, $password);
       $sqlQuery = 'UPDATE laf873.users SET laf873.users.password = ?  WHERE email = ? AND password = ? ';

    }

    public function deleteUser($email, $password) {
        $hashedPassword = sha1($password);
        $sqlQuery = 'DELETE FROM laf873.users WHERE email = ? AND password = ? ';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$email, $hashedPassword]);
    }
}