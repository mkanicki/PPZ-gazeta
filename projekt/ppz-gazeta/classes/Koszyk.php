<?php
require_once "classes/Conn.php";

class Koszyk {
        public $_conn;
        
         /**
        * liczba elementow w koszyku
        * @var int
        */
        public $liczba_elementow;
        
            public function _construct()
            {
                
            }

            /**
            * Zwraca liczbe artykulow  dodanych do koszyka aktualnie zalogowanego uzytkownika.
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
            * Zwraca wszystkie artykuly  dodanych do koszyka aktualnie zalogowanego uzytkownika.
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
     * @param $idUser identyfikator zalogowanego uzytkownika
     * @return odpowiedz czy wstawianie rekordu do tabeli powiodlo sie.
     */
        public  function dodaj($idArt, $idUser){
             $this->_conn = new Conn();
             $d = array(
               'idArtykul'         => $idArt,
               'idUzytkownik'      => $idUser
            );

        return $this->_conn->insert('koszyk', $d);
             
        }
  }
?>
