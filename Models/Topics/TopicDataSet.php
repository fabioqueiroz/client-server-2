<?php

require_once('Models/Database.php');
require_once('Models/Topics/Topic.php');
require_once('Models/BaseDataSet.php');

class TopicDataSet extends BaseDataSet
{

    public function __construct() {

        parent::__construct();
    }

    public function createTopic($topicSubject, $topicCategory, $postingUser, $topicDescription) {
        $sqlQuery = "INSERT INTO laf873.topics (topicSubject, topicDate, topicCategory, postingUser, topicDescription) VALUES (?,NOW(),?,?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$topicSubject, $topicCategory, $postingUser, $topicDescription]);
    }

    public function getAllTopics() {
        $sqlQuery = "SELECT * FROM laf873.topics";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $topics = [];
        while ($row = $statement->fetch()) {
            $topics[] = new Topic($row);
        }
        return $topics;
    }

}