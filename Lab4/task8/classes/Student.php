<?php

class Student extends Human{
    public $university;
    public $course;

    public function setUniversity($value){
        $this->university = $value;
    }
    public function setCourse($value){
        $this->course = $value;
    }
    public function getUniversity(){
        return $this->university;
    }
    public function getCourse()
    {
        return $this->course;
    }

    public function __construct($name, $height, $weight, $age, $university, $course)
    {
        parent::__construct($name, $height, $weight, $age);
        $this->university = $university;
        $this->course = $course;
    }

    public function nextCourse(){
        return $this->course++;
    }
    public function getStudentInfo()
    {
        return parent::getInfo() . ", University: {$this->university}, Course: {$this->course} <br>";
    }
}