<?php

require_once "Conn.php";
require_once "Mailer.php";

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
     * Sprawdza, czy uøytkownik jest adminem.
     *
     * @return bool True, jeúli jest
     */
    public function czyAdmin()
    {
        if ($this->_idRoli > 1)
            return true;
        else
            return false;
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
    public function pobierzListe($usuniety = 0)
    {
       $sql = "
            SELECT u.*, r.Nazwa AS rola
            FROM uzytkownik u JOIN rola r ON u.idRola = r.idRola
            WHERE usuniety=$usuniety";

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
        $sql = "SELECT * FROM Uzytkownik WHERE idUzytkownik = $id";

        return $this->_conn->fetchRow($sql);
    }

    /**
     * Dodaje/edytuje dane u≈ºytkownika
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
        
        if (!$id) {
            if (empty($dane['Haslo']))
                $bledy['Haslo'] = 'puste';
            else if (!empty($dane['Haslo']) && strlen($dane['Haslo']) < 3)
                $bledy['Haslo'] = 'format';
            else if ($dane['Haslo'] != $dane['Haslo2'])
                $bledy['Haslo2'] = 'hasla nie pasuja do siebie';
        }
        
        if (count($bledy) == 0) {
            // ok, mo≈ºna zapisywaƒá
            
            
            if (isset($dane['Haslo']))
                $dane['Haslo'] = md5($dane['Haslo']);
            else
                unset($dane['Haslo']);
                   
            if (!$id) {
                unset($dane['register']);
                unset($dane['Haslo2']);
                $dane['IdRola'] = 1;
                return $this->_conn->insert('Uzytkownik', $dane);
            } else {
                unset($dane['edit']);
                return $this->_conn->update('Uzytkownik', $dane, "idUzytkownik=$id");
            }
        } else {
            return $bledy;
        }
    }
    
    /**
     * Usuwa dane pojedynczego Uzytkownika.
     * 
     * @param int $id
     * @return array
     */
    public function usun($id)
    {
        /*$sql = "SELECT * FROM Zamowienie WHERE idUzytkownik=$id";	
		$zamowienia = $this->_conn->fetchAll($sql);
		if ($zamowienia) {
			foreach ($zamowienia as $zamowienie) {
				$this->_conn->delete('szczegoly_zam', 'idZamowienie', $zamowienie['idZamowienie']);
			}
        	$this->_conn->delete('Zamowienie', 'idUzytkownik', $id);
		}
		$this->_conn->delete('Koszyk', 'idUzytkownik', $id);
        $ret = $this->_conn->delete('Uzytkownik', 'idUzytkownik', $id);*/
        $ret = $this->_conn->update('Uzytkownik', array('usuniety' => 1), "idUzytkownik=$id");
        return $ret;
    }
	
	public function zmianaHasla($id, $pass) {
        $user = $this->pobierz($id);
        $ret = false;
        if ($user) {
            $ret = $this->_conn->update('Uzytkownik', array('Haslo' => MD5($pass)), "idUzytkownik=$id");
            if($ret) {
                $mailer = new Mailer();
                $mailer->sendPasswordMail($user['Login'], $user['Email'], $pass);//na jego email wysylamy wiadomosc z wygenerowanym haslem
            }
        }
		return $ret;			
	}
}