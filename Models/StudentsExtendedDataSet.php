<?php

require_once 'Models/Database.php';
require_once 'Models/StudentExtendedData.php';

class StudentsExtendedDataSet {

    protected $_dbConnection, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbConnection = $this->_dbInstance->getDbConnection();
    }

    public function fetchAll() {
        $sqlQuery = 'select id, first_name, last_name, international, course_name, programme_leader
                     from students, course
                     where students.courseID = course.courseID
                     order by id';

        $statement = $this->_dbConnection->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new StudentExtendedData($row);
        }
        return $dataSet;
    }
}
