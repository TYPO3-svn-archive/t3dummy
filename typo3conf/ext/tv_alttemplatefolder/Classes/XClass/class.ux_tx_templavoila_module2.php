<?php

class ux_tx_templavoila_module2 extends tx_templavoila_module2 {
	
	function init() {
		parent::init();
		$this->templatesDir = $GLOBALS['TYPO3_CONF_VARS']['BE']['fileadminDir'] . 'Private/Templates/Page/';
	}
	
}

?>