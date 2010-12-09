<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$tempColumns = array (
	'tx_oneclicklogin_enable' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:oneclicklogin/locallang_db.xml:be_users.tx_oneclicklogin_enable',		
		'config' => array (
			'type' => 'check',	
			'default' => 0,
		)
	),
);


t3lib_div::loadTCA('be_users');
t3lib_extMgm::addTCAcolumns('be_users',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('be_users','tx_oneclicklogin_enable;;;;1-1-1', '', 'before:password');
?>