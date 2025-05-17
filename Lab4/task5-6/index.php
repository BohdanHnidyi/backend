<?php
require_once('classes/Circle.php');

$Circle1 = new Circle(2, 5, 1);

$Circle2 = new Circle(1, 4, 1);


if($Circle1 -> circlesCheck($Circle2)){
    echo 'Кола перетинаються';
}else{
    echo 'Кола не перетинаються';

}
