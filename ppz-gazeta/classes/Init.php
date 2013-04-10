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
		$this->_smarty->force_compile = false;
		$this->_smarty->debugging = false;
        }
}
?>