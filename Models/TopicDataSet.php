<?php

require_once ('Models/Database.php');
require_once ('Models/Topic.php');

class TopicDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function createTopic($topicSubject, $topicCategory, $postingUser, $topicDescription) {
        $sqlQuery = "INSERT INTO laf873.topics (topicSubject, topicDate, topicCategory, postingUser, topicDescription) VALUES (?,?,?,?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$topicSubject, NOW(), $topicCategory, $postingUser, $topicDescription]);
    }


}