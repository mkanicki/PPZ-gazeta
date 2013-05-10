<?php

require_once "Conn.php";

class Uzytkownicy
{
    /**
     * Id Uzytkownika
     * @var int
     */
    protected $_idUzytkownik = null;

    /**
     * Id grupy Uzytkownika.
     * @var int
     */
    protected $_idRoli = null;

	protected $_Imie = null;

	protected $_Nazwisko = null;
    /**
     * Dane Uzytkownika
     * @var array
     */
    protected $_dane;
    
    private $_conn;

    public function __construct()
    {
        // pobierz z sesji id zalogowanego Uzytkownika i wstaw do pola klasy
        if (!empty($_SESSION['id_uzytkownika']) && !empty($_SESSION['id_roli'])) {
            $this->_idUzytkownik = (int) $_SESSION['id_uzytkownika'];
            $this->_idRoli = (int) $_SESSION['id_roli'];
			$this->_Imie= $_SESSION['imie'];
			$this->_Nazwisko= $_SESSION['nazwisko'];
        }

        $this->_conn = new Conn();
    }

    /**
     * Loguje do serwisu Uzytkownika o podanym loginie i hasle.
     * Wstawia id zalogowanego Uzytkownika do sesji.
     *
     * @param $login string
     * @param $haslo string
     * @return bool True, jesli logowanie powiodlo sie
     */
    public function zaloguj($login, $haslo)
    {
        $sql = "SELECT * FROM uzytkownik WHERE Login = '" . $this->_conn->escape($login) . "' AND Haslo = MD5('" . $this->_conn->escape($haslo) . "')";

        if ($row = $this->_conn->fetchRow($sql)) {
            
            $_SESSION['id_uzytkownika'] = $row['idUzytkownik'];
            $_SESSION['email_uzytkownika'] = $row['Email'];
            $_SESSION['id_roli'] = $row['idRola'];
			$_SESSION['nazwisko']= $row['Nazwisko'];
			$_SESSION['imie']= $row['Imie'];
            $this->_idUzytkownik = $row['idUzytkownik'];
            $this->_idRoli = $row['idRola'];
			$this->_Imie = $row['Imie'];
			$this->_Nazwisko=$row['Nazwisko'];

            return true;
        } else {
            return false;
        }
    }

    /**
     * Wylogowuje Uzytkownika.
     *
     */
    public function wyloguj()
    {
        $_SESSION['id_uzytkownika'] = null;
        $_SESSION['id_roli'] = null;
		$_SESSION['nazwisko']= null;
		$_SESSION['imie']= null;
        session_destroy();
    }

    /**
     * Sprawdza, czy Uzytkownik jest zalogowany.
     *
     * @return bool True, jesli jest
     */
    public function czyZalogowany()
    {
        if (is_null($this->_idUzytkownik))
            return false;
        else
            return true;
    }

    /**
     * Pobiera liste Uzytkownikow.
     * 
     * @return array
     */
    public function pobierzListe()
    {
        $sql = "
            SELECT u.*, g.nazwa AS grupa
            FROM uzytkownicy u JOIN grupy g ON u.id_grupy = g.id
            ";

        return $this->_conn->fetchAll($sql);
    }

    /**
     * Pobiera dane pojedynczego Uzytkownika.
     * 
     * @param int $id
     * @return array
     */
    public function pobierz($id)
    {
        $sql = "SELECT * FROM uzytkownicy WHERE id = '" . $this->_conn->escape($id) . "'";

        return $this->_conn->fetchRow($sql);
    }

    /**
     * Dodaje/edytuje dane użytkownika
     *
     * @param array $dane
     * @param int $id (optional) id Uzytkownika do edycji (jesli nie ma, rekord jest dodawany)
     * @return array|bool Tablica z bledami lub true, jesli wszystko jest ok
     */
    public function zapisz($dane, $id = null)
    {
        $bledy = array();

        if (empty($dane['Imie']))
            $bledy['Imie'] = 'puste';
        if (empty($dane['Nazwisko']))
            $bledy['Nazwisko'] = 'puste';
        if (empty($dane['Email']))
            $bledy['Email'] = 'puste';
        elseif(filter_var($dane['Email'], FILTER_VALIDATE_EMAIL) === false) //walidacja maila
            $bledy['Email'] = 'puste';
        if (empty($dane['Login']))
            $bledy['Login'] = 'puste';
        if (!empty($dane['Haslo']) && strlen($dane['Haslo']) < 3)
            $bledy['Haslo'] = 'format';
        elseif (empty($dane['Haslo']))
            $bledy['Haslo'] = 'puste'; // haslo tylko wymagane przy dodawaniu
        if (!empty($dane['Haslo2']) && strlen($dane['Haslo2']) < 3)
            $bledy['Haslo2'] = 'format';
        elseif (empty($dane['Haslo']))
            $bledy['Haslo2'] = 'puste'; // haslo tylko wymagane przy dodawaniu
        if ($dane['Haslo'] != $dane['Haslo2'])
            $bledy['Haslo2'] = 'puste';
        
        
            if (count($bledy) == 0) {
            // ok, można zapisywać
            unset($dane['register']);
            unset($dane['Haslo2']);
            if (!empty($dane['Haslo']))
                $dane['Haslo'] = md5($dane['Haslo']);
            else
                unset($dane['Haslo']);
            
            $dane['IdRola'] = 1;
           
            $this->_conn->insert('Uzytkownik', $dane);
            

            return true;
        } else {
            return $bledy;
        }
    }
}