<?php

require_once ('Models/Database.php');
require_once ('Models/Post.php');
require_once ('Models/BaseDataSet.php');

class PostDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createPost($title, $postMessage, $topicSubject, $postingUser) {
        $sqlQuery = "INSERT INTO laf873.posts (title, postMessage, postDate, topicSubject, postingUser) VALUES (?,?,NOW(),?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$title, $postMessage, $topicSubject, $postingUser]);
    }

    public function getAllPosts() {
        $sqlQuery = "SELECT * FROM laf873.posts";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $posts = [];
        while ($row = $statement->fetch()) {
            $posts[] = new Post($row);
        }
        return $posts;
    }
}