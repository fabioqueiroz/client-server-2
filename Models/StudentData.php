<?php


class StudentData
{
    private $_id, $_firstName, $_lastName, $_international, $_courseID, $_photoName;

    public function __construct($dbRow)
    {
        $this->_id = $dbRow['id'];
        $this->_firstName = $dbRow['first_name'];
        $this->_lastName = $dbRow['last_name'];

        if ($dbRow['international']) {
            $this->_international = 'yes';
        } else {
            $this->_international = 'no';
        }

        $this->_courseID = $dbRow['courseID'];

        if($dbRow['photo_name'] != null){
            $this->_photoName = $dbRow['photo_name'];
        } else {
            $this->_photoName ='no image';
        }
    }

    public function getStudentId()
    {
        return $this->_id;
    }

    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function getLastName()
    {
        return $this->_lastName;
    }

    public function getInternational()
    {
        return $this->_international;
    }

    public function getCourseID()
    {
        return $this->_courseID;
    }

    public function getPhotoName()
    {
        return $this->_photoName;
    }
}