<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_nwtimagecrop_cropscaling' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:nwt_imagecrop/locallang_db.xml:tt_content.tx_nwtimagecrop_cropscaling',		
		'config' => array (
			'type' => 'check',
			'default' => 1,
		)
	),
);

t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tt_content','tx_nwtimagecrop_cropscaling','textpic,image','after:imageorient');
t3lib_extMgm::addLLrefForTCAdescr('tt_content','EXT:nwt_imagecrop/locallang_csh_tt_content.php');

?>