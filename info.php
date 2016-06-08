<?php
// Читаем 14 символов, начиная с 21 символа
$section = file_get_contents('c:/people.txt', NULL, NULL, 20, 14);
var_dump($section);
?>