<?php

require_once ('Models/Database.php');
require_once ('Models/Category.php');
require_once ('Models/BaseDataSet.php');

class CategoryDataSet extends BaseDataSet
{
    public function __construct() {
        parent::__construct();
    }

    public function createCategory($categoryName, $description) {
        $sqlQuery = "INSERT INTO laf873.categories (categoryName, description) VALUES (?,?)";

        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute([$categoryName, $description]);
    }

}