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
        
         /**
     *Pobiera z bazy wszystkie wydania
     * laczenie tabel artykul i wydanie
     * 
     * @return array() : wydania z artykulami
     */
     public function pokazWszystko() {
       $sql = "SELECT a.Tytul, a.idArtykul, w.idWydanie, a.idWydanie
                    FROM artykul a JOIN wydanie w
                         ON w.idWydanie = a.idWydanie";
       //var_dump($this->_conn->fetchAll($sql));
       return $this->_conn->fetchAll($sql);
   }
   
   /**
     * Dodaje do bazy nowe wydanie
     */
   public function dodajWydanie($dane)
    {
        $bledy = array();

        if (empty($dane['Tytul']))
            $bledy['Tytul'] = 'puste';
        if (empty($dane['Cena']))
            $bledy['Cena'] = 'puste';  

        if (count($bledy) == 0) {
            unset($dane['Dodaj']);
            return $this->_conn->insert('Wydanie', $dane);
        } else {
            return $bledy;
        }
    }
    /**
     * Dodaje do bazy nowy artykul
     */
    public function dodajArtykul($dane)
    {
        $bledy = array();

        if (empty($dane['Tytul']))
            $bledy['Tytul'] = 'puste';
        if (empty($dane['Cena']))
            $bledy['Cena'] = 'puste';  
        if (empty($dane['idWydanie']))
            $bledy['idWydanie'] = 'puste'; 

        if (count($bledy) == 0) {
            unset($dane['Dodaj']);
            return $this->_conn->insert('Artykul', $dane);
        } else {
            return $bledy;
        }
    }
    
     /**
     *Pobiera z bazy idWydania i Tytul 
     * do wyboru tytułu przy dodawaniu
     * @return array() : Informacje o idWydan i Tytule
     */
    public function pokazWydania()
    {
        $sql = " SELECT idWydanie, Tytul FROM wydanie";
        return $this->_conn->fetchAll($sql);
    }
   
   }

?>
