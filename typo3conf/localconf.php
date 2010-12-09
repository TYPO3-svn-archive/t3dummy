<?php
$TYPO3_CONF_VARS['SYS']['sitename']           = 'TYPO3 Dummy';
$TYPO3_CONF_VARS['BE']['installToolPassword'] = '0101b997bb51076e0a670a42515353df';
$TYPO3_CONF_VARS['SYS']['encryptionKey'] = '0fbfc3f52f8a97ee7eef57efd97051700f8d4bf7fc4ddedd57944375429f48cf100227c443b493a843e06780cab9bb1c';
$TYPO3_CONF_VARS['SYS']['compat_version'] = '4.5';

/**
 * LOCAL
 */
$typo_db_host               = 'localhost';
$typo_db                    = 't3dummy';
$typo_db_username           = 'root';
$typo_db_password           = '';
$TYPO3_CONF_VARS['GFX']['im_path']      = '/opt/local/bin/';
$TYPO3_CONF_VARS['GFX']['im_path_lzw']  = '/opt/local/bin/';

$typo_db_extTableDef_script = 'extTables.php';

$TYPO3_CONF_VARS['GFX']['gdlib_2']      = '1';
$TYPO3_CONF_VARS['GFX']['im_version_5'] = 'gm';
$TYPO3_CONF_VARS['GFX']['TTFdpi']       = '96';

$TYPO3_CONF_VARS['SYS']['t3lib_cs_convMethod'] = 'mbstring';
$TYPO3_CONF_VARS['SYS']['t3lib_cs_utils']      = 'mbstring';
$TYPO3_CONF_VARS['SYS']['doNotCheckReferer']   = '1';
$TYPO3_CONF_VARS['SYS']['forceReturnPath']     = '1';
$TYPO3_CONF_VARS['SYS']['UTF8filesystem']      = '1';
$TYPO3_CONF_VARS['SYS']['setDBinit'] = 'UTF-8';

$TYPO3_CONF_VARS['BE']['fileCreateMask']   = '0644';
$TYPO3_CONF_VARS['BE']['folderCreateMask'] = '0755';
$TYPO3_CONF_VARS['BE']['maxFileSize']      = '20480';

$TYPO3_CONF_VARS['FE']['pageNotFound_handling']   = 'READFILE:errorpages/404_error.shtml';

// Enable this if the website uses a login form
$TYPO3_CONF_VARS['FE']['dontSetCookie'] = 1;

$TYPO3_CONF_VARS['BE']['forceCharset'] = 'utf-8';

$GLOBALS['TYPO3_CONF_VARS']['FE']['addAllowedPaths'] = 'typo3/gfx/';

## INSTALL SCRIPT EDIT POINT TOKEN - all lines after this points may be changed by the install script!

$TYPO3_CONF_VARS['EXT']['extList'] = 'pagetree,extbase,css_styled_content,extra_page_cm_options,impexp,sys_note,tstemplate,tstemplate_ceditor,tstemplate_info,tstemplate_objbrowser,tstemplate_analyzer,func_wizards,wizard_crpages,wizard_sortpages,lowlevel,install,belog,beuser,setup,taskcenter,info_pagetsconfig,viewpage,rtehtmlarea,t3skin,opendocs,openid,nc_staticfilecache,realurl,aeurltool,nwt_imagecrop,oneclicklogin,info,perm,func,filelist,t3editor,reports,fluid,static_info_tables,linkvalidator';	// Modified or inserted by TYPO3 Extension Manager. Modified or inserted by TYPO3 Core Update Manager.
$TYPO3_CONF_VARS['EXT']['extList_FE'] = 'extbase,css_styled_content,install,rtehtmlarea,t3skin,openid,nc_staticfilecache,realurl,aeurltool,nwt_imagecrop,oneclicklogin,fluid,static_info_tables,linkvalidator';	// Modified or inserted by TYPO3 Extension Manager.

$TYPO3_CONF_VARS['GFX']['gdlib_png'] = '1';	// Modified or inserted by TYPO3 Install Tool. 
$TYPO3_CONF_VARS['GFX']['png_truecolor'] = '1';	//  Modified or inserted by TYPO3 Install Tool.

$TYPO3_CONF_VARS['FE']['disableNoCacheParameter'] = '0';	//  Modified or inserted by TYPO3 Install Tool.  
$TYPO3_CONF_VARS['BE']['disable_exec_function'] = '0';	//  Modified or inserted by TYPO3 Install Tool.
$TYPO3_CONF_VARS['EXT']['extConf']['realurl'] = 'a:5:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"1";s:14:"autoConfFormat";s:1:"0";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}';	//  Modified or inserted by TYPO3 Extension Manager. 

// Updated by TYPO3 Extension Manager 08-12-10 23:50:49
?>