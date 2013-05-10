<?php
    require_once "classes/Conn.php";
    require_once 'classes/Init.php';
    require_once "classes/Koszyk.php";
    $koszyk = new Koszyk();

     
   
    // dla obslugi dodawania do koszyka. Wywoluje funkcje dodaj z klasy \Koszyk\ ktora wstawia dane do tabeli \koszyk\
    if(isset($_POST['id_artykulu'])){
            $_conn = new Conn();
            $sql = "SELECT idArtykul
                        FROM koszyk k WHERE k.idArtykul='".$_POST['id_artykulu']."'";
            
           
            
           if(! $_conn->fetchRow($sql)){
              $koszyk->dodaj($_POST['id_artykulu']);
              echo  'ok';
           }
           else{
               echo 'blad';
           }
    }

    // obsluga usuwania z tabeli \koszyk\ rekordu o idKoszyka przekazanym przez zadanie POST z formsa 
    if(isset($_POST['usun'])) {
        
        if($koszyk->usun($_POST['idKoszyk']))
            echo 'ok';
        else
            echo 'blad';
    }
?>