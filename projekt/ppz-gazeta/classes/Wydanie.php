<?php
require_once "classes/Conn.php";

 class Wydanie {
        
     /**
     * Id wydania
     * @var int
     */
        public $id_wydania=1;
        public $_conn;
        
        public function __construct()
        {
            $this->_conn = new Conn();
        }

            
      /**
     *Pobiera z bazy  wszystkie wydania dostepne w bazie danych - tabela \wydania\ 
     * 
     * @return array() : Informacje o wszystkich wydaniach
     */
            function   Pokaz_Wydania(){
                    $sql = "SELECT * FROM wydanie";
               return $this->_conn->fetchAll($sql);//$ret;
            }
        
     /**
     * Pobiera z bazy wszystkie informacje  wydania o $id podanym w argumencie.
     *
     * @param $id int
     * @return array() : Artykuly wydania o $id podanym w argumencie.
     */
          public  function   Pokaz_Wydanie($id){
                    $sql = "SELECT * FROM artykul a
                            WHERE a.idWydanie = '" .$this->_conn->escape($id). "' and idWlasciciel IS NULL"; 
               return $this->_conn->fetchAll($sql);
            }
            
      /**
     *Pobiera z bazy najnowsze trzy wydania dostepne w bazie danych - tabela \wydania\ 
     * 
     * @return array() : Informacje o najnowszych trzech wydaniach
     */
            public function   Pokaz_Najnowsze(){
                    $sql = " SELECT  *  FROM wydanie order by data asc limit 3";
               return $this->_conn->fetchAll($sql);
            }
        
         
   }

?>
