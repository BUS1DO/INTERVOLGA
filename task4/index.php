<?php
//создаем массив
$array = range(0, 100);
//заполняем массив случайными значениями
for ($i = 1; $i <= 100; $i++) {
    $array[$i] = mt_rand(0, 50);
    
}
//находим кол-во повторений
print_r(array_count_values($array));
?>