<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    
    $uzytkownicy = new Uzytkownicy();
    $uzytkownicy->wyloguj();

    header("Location: index.php")
?>
