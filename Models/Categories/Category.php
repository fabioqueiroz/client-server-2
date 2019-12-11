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
     * @return the category id
     */
    public function getCategoryID()
    {
        return $this->_categoryID;
    }

    /**
     * @return the category name
     */
    public function getCategoryName()
    {
        return $this->_categoryName;
    }

    /**
     * @return the description
     */
    public function getDescription()
    {
        return $this->_description;
    }

}