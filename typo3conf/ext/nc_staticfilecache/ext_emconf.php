<?php

########################################################################
# Extension Manager/Repository config file for ext "nc_staticfilecache".
#
# Auto generated 02-02-2010 11:17
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Static File Cache',
	'description' => 'Transparent static file cache solution using mod_rewrite and mod_expires. Increase response times for static pages by a factor of 230!',
	'category' => 'fe',
	'shy' => 0,
	'version' => '2.3.1',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => 'cli/pre_4.1',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => 'pages',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Michiel Roos, Tim LochmÃ¼ller, Marc HÃ¶rsken',
	'author_email' => 'extensions@netcreators.com',
	'author_company' => 'Netcreators',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:16:{s:9:"Changelog";s:4:"808f";s:36:"class.tx_ncstaticfilecache.debug.php";s:4:"dfec";s:30:"class.tx_ncstaticfilecache.php";s:4:"e490";s:21:"ext_conf_template.txt";s:4:"0cf8";s:12:"ext_icon.gif";s:4:"03df";s:17:"ext_localconf.php";s:4:"372b";s:14:"ext_tables.php";s:4:"378e";s:14:"ext_tables.sql";s:4:"1a0f";s:16:"locallang_db.xml";s:4:"c7f0";s:15:"cli/cleaner.php";s:4:"7ed9";s:23:"cli/pre_4.1/cleaner.php";s:4:"ed3e";s:20:"cli/pre_4.1/conf.php";s:4:"f91f";s:14:"doc/_.htaccess";s:4:"63d1";s:14:"doc/manual.sxw";s:4:"6a25";s:52:"infomodule/class.tx_ncstaticfilecache_infomodule.php";s:4:"c6ae";s:24:"infomodule/locallang.php";s:4:"022c";}',
);

?>