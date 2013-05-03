<?php
    require_once "classes/Conn.php";
    require_once 'classes/Init.php';
    require_once "classes/Koszyk.php";
   include_once("PDFMerger/PDFMerger.php");
    $koszyk = new Koszyk();
    $pdf = new PDFMerger;
     
   
    
    if(isset($_POST['id_artykulu'])){
            if($koszyk->dodaj($_POST['id_artykulu'], $_SESSION['id_uzytkownika']))  // jak na sztywno wpisze '2,'3' to sie dodaje :)
              echo 'ok';
            else
              echo 'blad';

    }
    
    if( isset( $_POST['tab_artykuly']) )
   {    
       $_conn = new Conn();
       for ( $i=0; $i < count( $_POST['tab_artykuly'] ); $i++ )
       {
                $pdf->addPDF($_POST['tab_artykuly'][$i], 'all');
       }

          $pdf->merge('file', 'documents/merged/'.preg_replace("/\\.[^.\\s]{3,4}$/", "", $_POST['newName']).'.pdf');
          
          // wstaw zmergowany pdf do tabeli artykuly
           $d = array(
              'idWydanie'     => '1',
              'Tytul'       => preg_replace("/\\.[^.\\s]{3,4}$/", "", $_POST['newName']),
              'data'          => date("Y-m-d"), 
              'Sciezka'       => '/xampplite/htdocs/ppz-gazeta/documents/merged/'.preg_replace("/\\.[^.\\s]{3,4}$/", "", $_POST['newName']).'.pdf',
              'Cena'          => $_POST['cena'],
              'LiczbaPobran'  => '0'
            );
           
         $tmp = $_POST['newName'];
         
        $_conn->insert('artykul', $d);
        
       //----------------------------------------------------------------------
       for ( $i=0; $i < count( $_POST['tab_artykuly'] ); $i++ )
       {
           $pom;
           $sql = "SELECT idArtykul
                        FROM artykul a WHERE a.Sciezka='".$_POST['tab_artykuly'][$i]."'";

           $artyk = $_conn->fetchRow($sql);
          foreach ($artyk as $val){$pom=$val;}
           $_conn->delete('koszyk', 'idArtykul', $pom);    // to przeba zmienic usuwa wszystkie id o numerze id
       }
       
        //---------------------------------------------------------------------
          $v;
           $sql = "SELECT idArtykul
                        FROM artykul a WHERE a.Sciezka='/xampplite/htdocs/ppz-gazeta/documents/merged/".preg_replace('/\\.[^.\\s]{3,4}$/', '', $_POST['newName']).".pdf'";  // /xampplite/htdocs/ppz-gazeta/documents/merged/'".preg_replace('/\\.[^.\\s]{3,4}$/', '', $_POST['newName'])."'.pdf'";
          $artyk = $_conn->fetchRow($sql);
          foreach ($artyk as $val) {$v=$val;}
         $k = array(
            'idArtykul'         => $v,
            'idUzytkownik'      => $_SESSION['id_uzytkownika']
         );

          $_conn->insert('koszyk', $k);

      echo 'ok';

    }

?>