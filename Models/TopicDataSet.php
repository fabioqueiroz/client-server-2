<?php

require_once ('Models/Database.php');
require_once ('Models/Topic.php');
require_once ('Models/BaseDataSet.php');

class TopicDataSet extends BaseDataSet
{
//    protected $_dbHandle, $_dbInstance;

    public function __construct() {
//        $this->_dbInstance = Database::getInstance();
//        $this->_dbHandle = $this->_dbInstance->getdbConnection();
        parent::__construct();
    }
    public function getCategoryID($category) {
        $value = $category;
        global $id;

        switch ($value) {
            case "Countries":
                return $id = 1;
                break;
            case "Regions":
                return $id = 2;
                break;
            case "Red Wine":
                return $id = 3;
                break;
            case "White Wine":
                return $id = 4;
                break;
            case "Food Pairing":
                return $id = 5;
                break;
            default:
                return -1;
        }
    }

    public function createTopic($topicSubject, $topicCategory, $postingUser, $topicDescription) {
        $sqlQuery = "INSERT INTO laf873.topics (topicSubject, topicDate, topicCategory, postingUser, topicDescription) VALUES (?,NOW(),?,?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$topicSubject, $topicCategory, $postingUser, $topicDescription]);
    }

}