<?php


class PostReply extends Post
{
    private $_replyTo, $_postID;

    public function __construct($dbRow) {

        parent::__construct($dbRow);

        $this->_replyTo = $dbRow['replyTo'];
        $this->_postID = $dbRow['postID'];
    }

    public function getReplyTo()
    {
        return $this->_replyTo;
    }

    public function getPostID()
    {
        return $this->_postID;
    }
}