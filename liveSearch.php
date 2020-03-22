<?php
session_start();
require_once('Models/Posts/PostDataSet.php');

$postDataSet = new PostDataSet();
$query = $_GET["q"];
$token = "";

if(isset($_SESSION["live-search-token"])) {
    $token = $_SESSION["live-search-token"];
}

if(!isset($_GET["token"]) || $_GET["token"] != $token) {

    $errorData = new stdClass();
    $errorData->error = "No data available";

    echo json_encode($errorData);

} else {

    $posts = $postDataSet->getLiveSearchResults($query);

    echo empty($posts) ? "no suggestion" : json_encode($posts);
}

//$posts = $postDataSet->getLiveSearchResults($query);
//
//echo empty($posts) ? "no suggestion" : json_encode($posts);