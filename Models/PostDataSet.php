<?php

require_once ('Models/Database.php');
require_once ('Models/Post.php');
require_once ('Models/PostDisplay.php');
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
        $sqlQuery = "SELECT postID, title, postMessage, postDate, topicSubject, firstName, lastName 
                     FROM laf873.users, laf873.posts 
                     WHERE postingUser = userID ORDER BY postDate DESC";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $posts = [];
        while ($row = $statement->fetch()) {
            $posts[] = new PostDisplay($row);
        }
        return $posts;
    }

    public function filterPostsByTitle($title) {
        $sqlQuery = "SELECT * 
                     FROM laf873.posts 
                     WHERE title LIKE '%{$title}%'
                     ORDER BY postDate DESC";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $filteredPosts = [];
        while ($row = $statement->fetch()) {
            $filteredPosts[] = new PostDisplay($row);
        }
        return $filteredPosts;
    }
}