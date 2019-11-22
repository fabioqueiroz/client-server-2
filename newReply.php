<?php
session_start();
require_once('Models/Replies/ReplyDataSet.php');

$view = new stdClass();


require_once('Views/newReply.phtml');
