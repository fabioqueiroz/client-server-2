<?php
require_once('Models/Posts/PostDataSet.php');

$postDataSet = new PostDataSet();
$query = $_GET["q"];

$posts = $postDataSet->getLiveSearchResults($query);

echo empty($posts) ? "no suggestion" : json_encode($posts);