<?php

namespace classes;

class Programmer extends Human
{
    public $programmingLanguages = [];
    public $experience;

    public function getprogrammingLanguages($value)
    {
        if($value != ""){
            if (array_key_exists($value, $this->programmingLanguages)) {
                return $this->programmingLanguages[$value];
            } else {
                return null;
            }
        }else{
            return implode(", ", $this->programmingLanguages);
        }
    }
    public function getExperience(){
        return $this->experience;
    }
    public function setProgrammingLanguages($key, $value){
        $this->programmingLanguages[$key] = $value;
    }
    public function setExperience($value){
        $this->experience = $value;
    }
    public function __construct($name, $height, $weight, $age, $programmingLanguages, $experience)
    {
        parent::__construct($name, $height, $weight, $age);
        $this->programmingLanguages = $programmingLanguages;
        $this->experience = $experience;
    }
    public function addLanguage($language){
        $this->programmingLanguages[] = $language;
    }
    public function getProgrammerInfo()
    {
        return parent::getInfo() . "<br> Programming language: ". implode(", ", $this->programmingLanguages)."; Experience: {$this->experience} years<br>";
    }

    protected function birthMessage(){
        return "Привіт, я програміст";
    }
    protected function cleanMessage()
    {
        return "Програміст";
    }

}
