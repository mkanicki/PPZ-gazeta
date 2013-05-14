<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy admin

    if (isset($_GET['id'])) {
        $uzytkownicy = new Uzytkownicy();
        $uzytkownicy->usun($_GET['id']);
    }

    header("Location: admin_index.php");
?>
