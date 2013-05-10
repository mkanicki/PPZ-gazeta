<?php
    require_once "classes/Conn.php";
    require_once 'classes/Init.php';
   include_once("PDFMerger/PDFMerger.php");
    $pdf = new PDFMerger;
     
   
   //------------------ dla obslugi laczenia wybranych pdf'ow w jeden --------------------------------- 
    if( isset( $_POST['tab_artykuly']) )
   {    
       $_conn = new Conn();
       for ( $i=0; $i < count( $_POST['tab_artykuly'] ); $i++ )
       {
                $pdf->addPDF($_POST['tab_artykuly'][$i], 'all');
       }

          $pdf->merge('file', 'documents/merged/'.preg_replace("/\\.[^.\\s]{3,4}$/", "", $_POST['newName']).'.pdf');
          
          //----------- wstaw zmergowany pdf do tabeli artykuly -------------------------------------
           $d = array(
              'idWydanie'     => '1',
              'Tytul'       => preg_replace("/\\.[^.\\s]{3,4}$/", "", $_POST['newName']),
              'data'          => date("Y-m-d"), 
              'Sciezka'       => '/xampplite/htdocs/ppz-gazeta/documents/merged/'.preg_replace("/\\.[^.\\s]{3,4}$/", "", $_POST['newName']).'.pdf',
              'Cena'          => $_POST['cena'],
              'LiczbaPobran'  => '0',
              'idWlasciciel'  => $_SESSION['id_uzytkownika']
            );
           
         $tmp = $_POST['newName'];
         
        $_conn->insert('artykul', $d);
        
       //-----------usuwam z tabeli koszyk artykuly dla pol checked=checked -----------------------------------
       for ( $i=0; $i < count( $_POST['tab_artykuly'] ); $i++ )
       {
           $pom;
           $sql = "SELECT idArtykul
                        FROM artykul a WHERE a.Sciezka='".$_POST['tab_artykuly'][$i]."'";
         
           $artyk = $_conn->fetchRow($sql);
           foreach ($artyk as $val){$pom=$val;}
           $_conn->delete('koszyk', 'idArtykul', $pom);
           
        }
       
        //---------- aktualizuje liczbe pobran artykolow wchodzacych w sklad nowoutworzonego  pdf'a  ----------------------------
       for ( $i=0; $i < count( $_POST['tab_artykuly'] ); $i++ )
       {
              $sql = "SELECT LiczbaPobran
                      FROM artykul 
                      WHERE Sciezka=".$_POST['tab_artykuly'][$i]."";

             $ret = $_conn->fetchRow($sql);
                $wyn = intval($ret[0]) + 1;
                     $d = array(
                       'LiczbaPobran'   => $wyn,
                    );

                    $_conn->update('artykul', $d, "Sciezka='".$_POST['tab_artykuly'][$i]."'");
       }
    
    
       //------------wstawiam rekozd z nowym pdfem do tabeli \koszyk\ -------------------------
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