<?php
require_once('Models/Posts/PostDataSet.php');

$postDataSet = new PostDataSet();
$posts = $postDataSet->getAllPosts();
//var_dump($posts);
// ******** Live Search ********
// get the q parameter, the text typed in, from URL

$query = $_GET["q"];
$hint = "";
var_dump($query);


// lookup all hints from array if $q is different from ""
if ($query !== "" && $hint !== "") {
    $query = strtolower($query);
    $length = strlen($query);

    foreach ($posts as $post) {
        $titleName = $post->getTitle();
        var_dump($titleName);

        if (!empty($titleName) && stristr($query, substr($titleName, 0, $length))) {

            if ($hint === "") {
                $hint = $titleName;

            } else {
                $hint .= ", $titleName";
            }
        }

    }

}


// Output "no suggestion" if no hint was found or output results
echo $hint === "" ? ("no suggestion for " . $query) : json_encode($hint);