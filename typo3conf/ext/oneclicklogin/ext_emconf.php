<?php

########################################################################
# Extension Manager/Repository config file for ext "oneclicklogin".
#
# Auto generated 22-02-2010 08:46
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => '1-Click-Login',
	'description' => 'For enabled users a 1-Click-Login link is shown at the Backend login screen to log in via OpenID. WARNING: The usernames and OpenID-Identifiers of the enabled users are shown at the login page and are visible for anyone. This should not be a security problem, but If you don\'t want that, don\'t use this extension!',
	'category' => 'be',
	'shy' => 0,
	'version' => '0.1.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Sebastian Gebhard',
	'author_email' => 'sebastian.gebhard@gmail.com',
	'author_company' => 'sgtypo3.de',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'openid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:6:{s:32:"class.tx_oneclicklogin_hooks.php";s:4:"5346";s:12:"ext_icon.gif";s:4:"d477";s:17:"ext_localconf.php";s:4:"e6a3";s:14:"ext_tables.php";s:4:"1084";s:14:"ext_tables.sql";s:4:"25ae";s:16:"locallang_db.xml";s:4:"d165";}',
);

?>