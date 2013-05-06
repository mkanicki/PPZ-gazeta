<?php
    require_once 'classes/Init.php';
    require_once 'classes/Uzytkownicy.php';
    
    $init = new Init();
    $smarty = $init->getSmarty();
    $uzytkownicy = new Uzytkownicy();
    
	if(isset($_POST['register'])){
        $wynik = $uzytkownicy->zapisz($_POST);
        
        if($wynik === true) {
            header("Location: index.php?msg=1");
        } else {
            // bledy
            /**
             * w przypadku gdy $wynik nie zwroci true, czyli w classes/Uzytkownicy.php funckja zapisz() zwroci jakies bledy
             * do smarty przypisujemy $bledy wykryte przy zapisywaniu (zapisz())
             * dzieki temu i zastosowaniu w templates/layout_register.tpl w input pozycji np. class="{$bledy.Imie}"
             * mozemy podswietlic na czerwono niewypelniony input
             */
            $smarty->assign('bledy', $wynik);
        }
        /**
         * Dzieki temu mozemy w templates/layout_register.tpl uzywac np. value="{$uzytkownik.Imie}" w input
         * co pozwala na zachowywanie czesci informacji w trakcie rejestracji, w przypadku gdy uzytkownik
         * wypelni jedynie czesc potrzebnych danych do zaakceptowania rejestracji
         */
        $smarty->assign('uzytkownik', $_POST);
        
    }    
    
    $smarty->assign('obiekt2' , $smarty->fetch("layout_register.tpl"));
    $smarty->display('layout_main.tpl');
?>



