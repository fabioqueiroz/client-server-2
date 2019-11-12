<?php

//require_once('Models/StudentsExtendedDataSet.php');

require_once('Models/StudentsDataSet.php');


$view = new stdClass();
$view->pageTitle = 'Student Information System';


$studentsDataSet = new StudentsDataSet();
$view->studentsDataSet = $studentsDataSet->fetchAllStudents();

//$studentsExtendedDataSet = new StudentsExtendedDataSet();
//$view->studentsExtendedDataSet = $studentsExtendedDataSet->fetchAll();


require_once('Views/studentISv1.phtml');
//require_once('Views/studentExtISv1.phtml');
