<?php
require_once ('Models/Database.php');
require_once ('Models/BaseDataSet.php');
require_once ('Models/ChatMessages/ChatMessage.php');

class ChatMessageDataSet extends BaseDataSet
{
    public function __construct()
    {
        parent::__construct();
    }

}