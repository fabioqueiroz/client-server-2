<?php

require_once('Models/Database.php');
require_once('Models/Categories/Category.php');
require_once('Models/BaseDataSet.php');

class CategoryDataSet extends BaseDataSet
{
    public function __construct() {
        parent::__construct();
    }

    public function getAllCategories() {
        $sqlQuery = "SELECT * FROM laf873.categories";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $categories = [];
        while ($row = $statement->fetch()) {
            $categories[] = new Category($row);
        }
        return $categories;
    }
    public function getCategoryID($category)  {

    }

    public function createCategory($categoryName, $description) {
        $sqlQuery = "INSERT INTO laf873.categories (categoryName, description) VALUES (?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$categoryName, $description]);
    }

}