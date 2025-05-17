<?php
class Human
{
    public $name;
    public $age;
    public $height;
    public $weight;

    public function getName(){
        return $this->name;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function getHeight()
    {
        return $this->height;
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function setName($value)
    {
        $this->name = $value;
    }
    public function setAge($value)
    {
        $this->age = $value;
    }
    public function setHeight($value)
    {
        $this->height = $value;
    }
    public function setWeight($value)
    {
        $this->weight = $value;
    }

    public function __construct($name, $height, $weight, $age)
    {
        $this->name = $name;
        $this->height = $height;
        $this->weight = $weight;
        $this->age = $age;
    }
    public function getInfo()
    {
        return "Name: {$this->name}; Height: {$this->height}; Weight: {$this->weight}; Age: {$this->age}";
    }
}
