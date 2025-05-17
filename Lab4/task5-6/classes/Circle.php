<?php 
class Circle{
    private $x;
    private $y;
    private $radius;

    public function __get($key)
    {
        return $this->$key;
    }
    public function __set($key, $value){
        $this->$key = $value;
    }
    public function __construct($x, $y, $radius){
        $this->x = $x;
        $this->y = $y;
        $this->radius = $radius;
    }
    public function __toString() : string
    {
        return "Коло з центром в ($this->x, $this->y) і радіусом $this->radius";
    }

    public function circlesCheck($circle)
    {
        $distance = sqrt(pow($circle->x - $this->x, 2) + pow($circle->y - $this->y, 2));

        if ($distance <= ($this->radius + $circle->radius)) {
            return true;
        } else {
            return false;
        }
    }
}