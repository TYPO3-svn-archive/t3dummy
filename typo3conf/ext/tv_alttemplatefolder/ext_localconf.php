<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/templavoila/mod2/index.php'] = t3lib_extMgm::extPath('tv_alttemplatefolder') . '/Classes/XClass/class.ux_tx_templavoila_module2.php';


?>
