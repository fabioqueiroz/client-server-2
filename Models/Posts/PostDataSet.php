<?php

require_once('Models/Database.php');
require_once('Models/Posts/Post.php');
require_once('Models/Posts/PostDisplay.php');
require_once('Models/BaseDataSet.php');

class PostDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

    // Allow the user to create a new post
    public function createPost($title, $postMessage, $topicSubject, $postingUser) {
        $sqlQuery = "INSERT INTO laf873.posts (title, message, messageDate, topicSubject, postingUser) VALUES (?,?,NOW(),?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$title, $postMessage, $topicSubject, $postingUser]);
    }

    // Retrieve all posts
    public function getAllPosts() {
        $sqlQuery = "SELECT p.ID, p.title, p.message, p.messageDate , p.topicSubject, p.postingUser, 
                            u.firstName, u.lastName, u.photo
                     FROM laf873.users u, laf873.posts p
                     WHERE p.postingUser = u.userID ORDER BY messageDate DESC";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $posts = [];
        while ($row = $statement->fetch()) {
            $posts[] = new PostDisplay($row);
        }
        return $posts;
    }

    // Retrieve all posts
    public function getAllPostsByTitle($title) {
        $sqlQuery = "SELECT p.ID, p.title, p.message, p.messageDate , p.topicSubject, p.postingUser, 
                            u.firstName, u.lastName, u.photo
                     FROM laf873.users u, laf873.posts p
                     WHERE p.postingUser = u.userID AND p.title LIKE '%{$title}%')  ORDER BY messageDate DESC";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $posts = [];
        while ($row = $statement->fetch()) {
            $posts[] = new PostDisplay($row);
        }
        return $posts;
    }

    // Allow the user to filter the posts
    public function filterPostsByTitle($title) {
        $title = strip_tags(trim(($title)));

        $sqlQuery = "SELECT p.ID, p.title, p.message, p.messageDate, p.topicSubject, p.postingUser, 
                            u.photo, u.firstName, u.lastName
                    FROM laf873.posts p
                    INNER JOIN laf873.users u ON u.userID = p.postingUser
                    WHERE (p.title LIKE '%{$title}%') OR (p.message LIKE '%{$title}%') 
                    OR (u.firstName LIKE '%{$title}%') OR (u.lastName LIKE '%{$title}%') 
                    ORDER BY messageDate DESC;";

        $this->_dbHandle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $filteredPosts = [];
        while ($row = $statement->fetch()) {
            $filteredPosts[] = new PostDisplay($row);
        }
        return $filteredPosts;
    }

    // Retrieve the post's information by its id
    public function getPostById($postID) {
        $sqlQuery = "select p.ID, p.title, p.message, p.messageDate, p.postingUser, p.topicSubject, 
                            u.firstName, u.lastName, u.photo
                    from laf873.posts p
                    inner join laf873.users u on u.userID = p.postingUser
                    where p.ID = '{$postID}'";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $post = [];
        while ($row = $statement->fetch()) {
            $post[] = new PostDisplay($row);
        }
        return $post;
    }

    // Obtain the total number of posts
    public function getTotalNoOfPosts() {
        $sqlQuery = "select count(*) from laf873.posts";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $total = $statement->fetchColumn();

        return $total;
    }

    // Create the pagination
    public function makePageQuery($limit, $offset) {
        $sqlQuery = "SELECT p.ID, p.title, p.message, p.messageDate, p.topicSubject, p.postingUser, 
                            u.firstName, u.lastName, u.photo
                     FROM laf873.users u, laf873.posts p
                     WHERE p.postingUser = u.userID ORDER BY messageDate DESC LIMIT ".$limit. " OFFSET "."$offset";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $posts = [];
        while ($row = $statement->fetch()) {
            $posts[] = new PostDisplay($row);
        }
        return $posts;
    }

    public function getLiveSearchResults($title) {
        $title = strip_tags(trim(($title)));

        $sqlQuery = "SELECT p.ID, p.title, p.message, p.messageDate , p.topicSubject, p.postingUser, 
                            u.firstName, u.lastName, u.photo
                     FROM laf873.users u, laf873.posts p
                     WHERE p.postingUser = u.userID AND p.title LIKE '%$title%' ORDER BY messageDate DESC LIMIT 50";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $posts = [];
        while ($row = $statement->fetch()) {
            $posts[] = new PostDisplay($row);
        }
        return $posts;
    }






















}