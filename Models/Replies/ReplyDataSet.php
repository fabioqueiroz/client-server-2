<?php

require_once('Models/Database.php');
require_once('Models/BaseDataSet.php');
require_once('Models/Replies/Reply.php');
require_once('Models/Replies/ReplyDisplay.php');

class ReplyDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    // Create a new reply to a post
    public function createReply($replyMessage, $replyFrom, $replyTo, $postID) {
        $sqlQuery = "INSERT INTO laf873.replies(replyMessage, replyDate, replyFrom, replyTo, postID) VALUES (?,NOW(),?,?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$replyMessage, $replyFrom, $replyTo, $postID]);
    }

    // Retrieve all replies
    public function getAllReplies($postingUser) {
        $sqlQuery = "select r.replyID, r.replyMessage, r.replyDate, r.replyFrom, r.replyTo, r.postID,
                            p.title, p.message, u.firstName, u.lastName, u.photo
                    from laf873.replies r
                    inner join laf873.posts p on r.postID = p.ID
                    inner join laf873.users u on u.userID = r.replyFrom
                    where r.replyTo = '{$postingUser}'
                    order by r.replyDate asc";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $replies = [];
        while ($row = $statement->fetch()) {
            $replies[] = new ReplyDisplay($row);
        }
        return $replies;
    }

    // Retrieve all replies linked to a specific post
    public function getAllRepliesById($postingUser, $ID) {
        $sqlQuery = "select r.replyID, r.replyMessage, r.replyDate, r.replyFrom, r.replyTo, r.postID,
                            p.title, p.message, u.firstName, u.lastName, u.photo
                    from laf873.replies r
                    inner join laf873.posts p on r.postID = p.ID
                    inner join laf873.users u on u.userID = r.replyFrom
                    where r.replyTo = '{$postingUser}'
                    and p.ID = '{$ID}'
                    order by r.replyDate asc";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $replies = [];
        while ($row = $statement->fetch()) {
            $replies[] = new ReplyDisplay($row);
        }
        return $replies;
    }
}