<?php
function autoload($class)
{
    $class = str_replace("\\", "/", $class);
    $path = "./{$class}.php";  

    if (file_exists($path)) {
        require_once($path);
    } 
}

spl_autoload_register("autoload");

$programmer = new classes\Programmer("Evgeniy", 180, 90, 19, ["C#", "C++", "PHP"], 3);
$student = new classes\Student("Bogdan", 160, 80, 21, "Zhytomyr Polytechnic", 2);

echo $programmer->getProgrammerInfo();
echo $student->getStudentInfo();

echo $student->cleanKitchen();
echo $programmer->cleanRoom();