<?php
require_once "classes/Conn.php";

class Koszyk {
        public $_conn;
        
         /**
        * liczba elementow w koszyku
        * @var int
        */
        public $liczba_elementow;
        
            public function __construct()
            {
                 $this->_conn = new Conn();
            }

            /**
            * Pobiera liczbe artykulow  dodanych do koszyka aktualnie zalogowanego uzytkownika.
            *
            * @return liczba elementow w koszyku.
            */
            public function Zlicz_elementy(){
              $ile=0;
              if(isset($_SESSION['id_uzytkownika'])){
                    $sql = "SELECT *
                                FROM artykul a JOIN koszyk     k ON  a.idArtykul=k.idArtykul
                                               JOIN uzytkownik u ON k.idUzytkownik= u.idUzytkownik
                                WHERE u.idUzytkownik=".$_SESSION['id_uzytkownika']."";
                    $this->_conn = new Conn();        
                   $rows = $this->_conn->fetchAll($sql);  

                   foreach( $rows as $row){
                       $ile+=1;
                   }
              }
              
          $this->liczba_elementow = $ile;
          return $this->liczba_elementow;
        }    
            
          /**
            * Pobiera wszystkie artykuly  dodanych do koszyka aktualnie zalogowanego uzytkownika.
            *
            * @return informacje o artykulach
         **/
          public  function   Pokaz_Zawartosc_koszyka(){    

              $this->_conn = new Conn();
                    $sql = "SELECT *
                            FROM artykul a LEFT JOIN koszyk     k ON  a.idArtykul=k.idArtykul
                                           LEFT JOIN uzytkownik u ON k.idUzytkownik= u.idUzytkownik
                            WHERE u.idUzytkownik=".$_SESSION['id_uzytkownika']."";

               return $this->_conn->fetchAll($sql); //$ret_table;
            }
            /**
            * Dodaje do koszyka artykul o identydikatorze podanym w argumencie
            *
            * @param $idArt identyfikator dodawanego artykulu
            * @return odpowiedz czy wstawianie rekordu do tabeli powiodlo sie.
            */
        public  function dodaj($idArt){
             $this->_conn = new Conn();
             $d = array(
               'idArtykul'         => $idArt,
               'idUzytkownik'      => $_SESSION['id_uzytkownika']
            );

        return $this->_conn->insert('koszyk', $d);  
        }
        
        /**
        * Usuwa z koszyka rekord o identydikatorze podanym w argumencie
        * Gdyby usuwanym aartykulem bylby zlaczony pdf to usun go z tabeli \artykul\
         * oraz usun z serwera (to byl tymczasowy rekord)
         * 
        * @param $idKoszyka identyfikator koszyka-nie zrealizowanego zamowienia
        * @return boolean  true: odpowiedz czy usuwanie rekordu z tabeli powiodlo sie.
        */
        public function usun($idKoszyka)
            {
            $sql = "SELECT a.idArtykul
                    FROM artykul a LEFT JOIN koszyk k
                    ON  a.idArtykul  = k.idArtykul
                    WHERE  a.idWlasciciel IS NOT NULL";
            $idJoin = $this->_conn->fetchRow($sql);
                //--------------------------------------
            $sql2 = "SELECT a.Sciezka
                    FROM artykul a LEFT JOIN koszyk k
                    ON  a.idArtykul  = k.idArtykul
                    WHERE  a.idWlasciciel IS NOT NULL";
            $PathRemove = $this->_conn->fetchRow($sql2);
            
            $ret = $this->_conn->delete('koszyk', 'idKoszyk', $idKoszyka);
             
            if($idJoin[0]) $this->_conn->delete('artykul', 'idArtykul', $idJoin[0]);            
            if($PathRemove[0]) unlink($PathRemove[0]);
        return $ret;
        }
  }
?>
