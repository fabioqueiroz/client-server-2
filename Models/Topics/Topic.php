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

    /**
     * @return the topic id
     */
    public function getTopicID()
    {
        return $this->_topicID;
    }

    /**
     * @return a string containing
     * the subject
     */
    public function getTopicSubject()
    {
        return $this->_topicSubject;
    }

    /**
     * @return the datetime information
     */
    public function getTopicDate()
    {
        return $this->_topicDate;
    }

    /**
     * @return the foreign key
     * for the category table
     */
    public function getTopicCategory()
    {
        return $this->_topicCategory;
    }

    /**
     * @return the foreign key
     * for the users table
     */
    public function getPostingUser()
    {
        return $this->_postingUser;
    }

    /**
     * @return a string containing
     * the description
     */
    public function getTopicDescription()
    {
        return $this->_topicDescription;
    }
}