<?php

require_once('Models/Database.php');
require_once('Models/BaseDataSet.php');
require_once('Models/Replies/Reply.php');

class ReplyDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createReply($replyMessage, $replyFrom, $replyTo, $postID) {
        $sqlQuery = "INSERT INTO laf873.replies(replyMessage, replyDate, replyFrom, replyTo, postID) VALUES (?,NOW(),?,?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$replyMessage, $replyFrom, $replyTo, $postID]);
    }

//    public function getAllReplies() {
//        $sqlQuery = "select r.replyID, r.replyMessage, r.replyDate, r.replyFrom, r.replyTo, r.replyImage, r.postID,
//                           p.title, p.message
//                    from laf873.replies r
//                    inner join laf873.posts p on r.postID = p.ID
//                    where r.replyTo = 41
//                    order by r.replyDate desc";
//
//        $statement = $this->_dbHandle->prepare($sqlQuery);
//        $statement->execute();
//
//        $replies = [];
//        while ($row = $statement->fetch()) {
//            $replies[] = new Reply($row);
//        }
//        return $replies;
//    }
    public function getAllReplies($postingUser) {
        $sqlQuery = "select r.replyID, r.replyMessage, r.replyDate, r.replyFrom, r.replyTo, r.replyImage, r.postID,
                           p.title, p.message
                    from laf873.replies r
                    inner join laf873.posts p on r.postID = p.ID
                    where r.replyTo = '{$postingUser}'
                    order by r.replyDate asc";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $replies = [];
        while ($row = $statement->fetch()) {
            $replies[] = new Reply($row);
        }
        return $replies;
    }

}