<?php
require_once('Models/Posts/PostDataSet.php');

$postDataSet = new PostDataSet();
$query = $_GET["q"];

$posts = $postDataSet->getALiveSearchResults($query);

//var_dump($posts);

//$hint = "";
//// lookup all hints from array if $q is different from ""
//if ($query !== "" && $hint !== "") {
//    $query = strtolower($query);
//    $length = strlen($query);
//
//    foreach ($posts as $post) {
//        $titleName = $post->getTitle();
//
//        if (!empty($titleName) && stristr($query, substr($titleName, 0, $length))) {
//
//            if ($hint === "") {
//                $hint = $titleName;
//
//            } else {
//                $hint .= ", $titleName";
//            }
//        }
//
//    }
//
//}

// Output "no suggestion" if no hint was found or output results
//echo $hint === "" ? ("no suggestion for " . $query) : json_encode($hint);

//echo json_encode($posts);
echo empty($posts) ? "no suggestion" : json_encode($posts);