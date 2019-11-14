<?php


class Post
{
    private $_postID, $_postingUser, $_topicSubject, $_content, $_postDate, $_image;

    public function __construct($dbRow)
    {
        $this->_postID = $dbRow['postID'];
        $this->_postingUser = $dbRow['postingUser'];
        $this->_topicSubject = $dbRow['topicSubject'];
        $this->_content = $dbRow['content'];
        $this->_postDate = $dbRow['postDate'];
        $this->_image = $dbRow['image'];
    }

    public function getPostID()
    {
        return $this->_postID;
    }

    public function getPostingUser()
    {
        return $this->_postingUser;
    }

    public function getTopicSubject()
    {
        return $this->_topicSubject;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getPostDate()
    {
        return $this->_postDate;
    }

    public function getImage()
    {
        return $this->_image;
    }
}