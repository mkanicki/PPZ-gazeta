<?php

    require_once 'classes/Init.php';
    require_once 'classes/Wydanie.php';
    
    //---------------------------------
    
    $init = new Init();
    $smarty = $init->getSmarty();
    $view = new Wydanie();
    
    
     //Jesli user kliknal miniature wydania to pokaz podglad wydania i informacje o artykulach w nim zawartych  
   if(isset($_POST['id_wydania'])) {
        $smarty->assign('artykuly_wydania' , $view->Pokaz_Wydanie($_POST["id_wydania"]));
        $smarty->assign('wydanie_name' , $_POST["wydanie_name"]);
        $smarty->display('publication_view.tpl');
        
    }  
    
?>
