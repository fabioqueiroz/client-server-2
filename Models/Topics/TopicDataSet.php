<?php

require_once('Models/Database.php');
require_once('Models/Topics/Topic.php');
require_once('Models/BaseDataSet.php');

class TopicDataSet extends BaseDataSet
{

    public function __construct() {

        parent::__construct();
    }

    // Generate a new topic
    public function createTopic($topicSubject, $topicCategory, $postingUser, $topicDescription) {
        $sqlQuery = "INSERT INTO laf873.topics (topicSubject, topicDate, topicCategory, postingUser, topicDescription) VALUES (?,NOW(),?,?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$topicSubject, $topicCategory, $postingUser, $topicDescription]);
    }

    // Retrieve all topics in the database
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

    // Get the number of posts linked to a topic id
    public function getPostCountByTopicId($topicID) {
        $sqlQuery = "select count(*) from laf873.topics t
                    inner join laf873.posts p on t.topicID = p.topicSubject
                    where t.topicID = ?";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$topicID]);

        $count = $statement->fetchColumn();

        return $count;
    }
}