<?php
// Функція для обчислення sin(x)
function my_sin($x) {
    return sin($x);
}

// Функція для обчислення cos(x)
function my_cos($x) {
    return cos($x);
}

// Функція для обчислення tg(x)
function my_tg($x) {
    return tan($x);
}

// Функція для обчислення x^y
function xy($x, $y) {
    return pow($x, $y);
}

// Функція для обчислення факторіалу x!
function factorial($x) {
    if ($x == 0) {
        return 1;
    } else {
        return $x * factorial($x - 1);
    }
}
?>
