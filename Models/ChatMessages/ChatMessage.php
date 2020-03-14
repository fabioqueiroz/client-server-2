<?php


class ChatMessage implements JsonSerializable
{
    private $_chatMessageID, $_message, $_senderID, $_receiverID, $_messageDate, $_image;

    public function __construct($dbRow)
    {
        $this->_chatMessageID = $dbRow['chatMessageID'];
        $this->_message = $dbRow['message'];
        $this->_senderID = $dbRow['senderID'];
        $this->_receiverID = $dbRow['receiverID'];
        $this->_messageDate = $dbRow['messageDate'];
        //$this->_image = $dbRow['image'];
    }

    /**
     * @return mixed
     */
    public function getChatMessageID()
    {
        return $this->_chatMessageID;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @return mixed
     */
    public function getSenderID()
    {
        return $this->_senderID;
    }

    /**
     * @return mixed
     */
    public function getReceiverID()
    {
        return $this->_receiverID;
    }

    /**
     * @return mixed
     */
    public function getMessageDate()
    {
        return $this->_messageDate;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'chatMessageID' => $this->getChatMessageID(),
            'message' => $this->getMessage(),
            'senderID' => $this->getSenderID(),
            'receiverID' => $this->getReceiverID(),
            'messageDate' => $this->getMessageDate(),
        ];
    }

}