<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $init->sprawdzAdmin(); // sprawdza, czy admin
    
    if (isset($_GET['id'])) {
        $uzytkownicy = new Uzytkownicy();
        $pass = $init->randomString(12);
        $ret = $uzytkownicy->zmianaHasla($_GET['id'],$pass);
        /*if ($ret) {
            echo 'Has³o zosta³o zresetowane';
        } else {
            echo 'Nie uda³o siê zresetowaæ has³a';
        }*/
    }
    
    header("Location: admin_index.php");
?>
