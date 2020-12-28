<?php 
/**
 * Función que muestra datos por pantalla, se le da un parámetro
 * lo busca y lo muestra por pantalla
 */
function debug($var)
{
    $debug = debug_backtrace();
    echo "<prev>";
    echo $debug[0]['file'] . " " . $debug[0]['line'] . "<br><br>";
    print_r($var);
    echo "<pre>";
    echo "<br>";
}