<?php

session_start();

require_once 'smarty/Smarty.class.php';

/**
 * Klasa obsługująca najczęściej wykonywane akcje w serwisie.
 * Zawiera metody obsługujące szkielet serwisu.
 *
 */
class Init
{
	/**
	 * Instancja obiektu szablonów Smarty.
	 * @var Smarty
	 */
	private $_smarty;
	
	/**
	 * Getter do obiektu smarty.
	 * 
	 * @return Smarty
	 */
	public function getSmarty()
	{
		return $this->_smarty;
	}
	
	public function __construct()
	{
		// ustaw smarty
		$this->_smarty = new Smarty;
		$this->_smarty->force_compile = true;
		$this->_smarty->debugging = false;
        }
        
     /**
     * Sprawdza, czy u�ytkownik jest adminem.
     * Je�li nie jest, przekierowuje go gdzies.
     *
     */
    public function sprawdzAdmin()
    {
        $uzytkownicy = new Uzytkownicy();
        if (!$uzytkownicy->czyAdmin())
            header("Location: index.php");
        
    }

    public function randomString($length = 8) {
        $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($alpha_numeric), 0, $length);
    }
}
?>