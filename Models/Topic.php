<?php


class Topic
{
    private $_topicID, $_topicSubject, $_topicDate, $_topicCategory, $_postingUser, $_topicDescription;

    public function __construct($dbRow)
    {
        $this->_topicID = $dbRow['topicID'];
        $this->_topicSubject = $dbRow['topicSubject'];
        $this->_topicDate = $dbRow['topicDate'];
        $this->_topicCategory = $dbRow['topicCategory'];
        $this->_postingUser = $dbRow['postingUser'];
        $this->_topicDescription = $dbRow['topicDescription'];
    }

    public function getTopicID()
    {
        return $this->_topicID;
    }

    public function getTopicSubject()
    {
        return $this->_topicSubject;
    }

    public function getTopicDate()
    {
        return $this->_topicDate;
    }

    public function getTopicCategory()
    {
        return $this->_topicCategory;
    }

    public function getPostingUser()
    {
        return $this->_postingUser;
    }

    public function getTopicDescription()
    {
        return $this->_topicDescription;
    }
}