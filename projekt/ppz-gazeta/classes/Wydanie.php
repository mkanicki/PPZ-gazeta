<?php
require_once "classes/Conn.php";

 class Wydanie {
        
     /**
     * Id wydania
     * @var int
     */
        public $id_wydania=1;
        public $_conn;
        
        public function _construct()
        {
        }

            
      /**
     *Pobiera  wszystkie wydania dostepne w bazie danych - tabela \wydania\ 
     * 
     *
     * @return Informacje o wszystkich wydaniach
     */
            function   Pokaz_Wydania(){
                    $this->_conn = new Conn();
                    $sql = "SELECT * FROM wydanie";
               return $this->_conn->fetchAll($sql);//$ret;
            }
        
     /**
     * Pobiera wszystkie informacje  wydania o $id podanym w argumencie.
     *
     * @param $id int
     * @return Artykuly wydania o $id podanym w argumencie.
     */
          public  function   Pokaz_Wydanie($id){
                    $this->_conn = new Conn();
                    $sql = "SELECT * FROM artykul a
                            WHERE a.idWydanie = '" . $this->_conn->escape($id) . "'";

               return $this->_conn->fetchAll($sql);
            }
            
      /**
     *Pobiera  najnowsze trzy wydania dostepne w bazie danych - tabela \wydania\ 
     * 
     *
     * @return Informacje o najnowszych trzech wydaniach
     */
            public function   Pokaz_Najnowsze(){
                    $this->_conn = new Conn();
                    $sql = " SELECT  *  FROM wydanie order by data asc limit 3";
               return $this->_conn->fetchAll($sql);
            }
        
         
   }

?>
