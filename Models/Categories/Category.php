<?php


class Category
{
    private $_categoryID, $_categoryName, $_description;

    public function __construct($dbRow)
    {
        $this->_categoryID = $dbRow['categoryID'];
        $this->_categoryName = $dbRow['categoryName'];
        $this->_description = $dbRow['description'];
    }

    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->_categoryID;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->_categoryName;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

}