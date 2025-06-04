<?php //This is probably matched up now
//Class to represent an entry in the users table
//Doesn't need update I believe
class User {
    //properties - match the columns in the users table
    private $userNo;
    private $userId;
    private $password;
    private $firstName;
    private $lastName;
    private $eMail;
    private $hireDate;
    private $extension;
    private $userLevelNo;
    public function __construct($userId, $firstName, $lastName, 
        $eMail, $password, $hireDate, $extension, $userLevelNo,
        $userNo = null) 
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->eMail = $eMail;
        $this->password = $password;
        $this->hireDate = $hireDate;
        $this->extension = $extension;
        $this->userLevelNo = $userLevelNo;
        $this->userNo = $userNo;
    }

    //get and set the person properties
    public function getUserNo() {
        return $this->userNo;
    }
    public function setUserNo($value) {
        $this->userNo = $value;
    }

    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($value) {
        $this->userId = $value;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($value) {
        $this->password = $value;
    }

    public function getFirstName() {
        return $this->firstName;
    }
    public function setFirstName($value) {
        $this->firstName = $value;
    }
    public function getLastName() {
        return $this->lastName;
    }
    public function setLastName($value) {
        $this->lastName = $value;
    }

    public function getHireDate() {
        return $this->hireDate;
    }
    public function setHireDate($value) {
        $this->hireDate = $value;
    }

    public function getExtension() {
        return $this->extension;
    }
    public function setExtension($value) {
        $this->extension = $value;
    }//added extension  into the mix
    public function getEMail() {
        return $this->eMail;
    }
    public function setEMail($value) {
        $this->eMail = $value;
    }
    
    
    public function getUserLevelNo() {
        return $this->userLevelNo;
    }
    public function setUserLevelNo($value) {
        $this->userLevelNo = $value;
    }
}