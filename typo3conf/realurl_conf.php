<?php
$TYPO3_CONF_VARS['EXTCONF']['realurl'] = array(
	'_DEFAULT' => array(
		'init' => array(
			'enableCHashCache' => 1,
			'appendMissingSlash' => 'ifNotFile',
			'enableUrlDecodeCache' => 1,
			'enableUrlEncodeCache' => 1,
		),
		'redirects' => array(),
		'preVars' => array(
			/**
			 * Un-Comment following lines if you have a multilanguage website
			 */
			/*array(
		        'GETvar' => 'L',
		        'valueMap' => array(
		            'de' => 0,
		            'en' => 1,
		    		'dk' => 2,
		    		'pl' => 3,
		    		'fr' => 4,
		    		'nr' => 5
		    	),
		    ),*/
		),
		'pagePath' => array(
			'type' => 'user',
			'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
			'spaceCharacter' => '-',
			'languageGetVar' => 'L',
			'expireDays' => 7,
###### include your rootpage id here
			'rootpage_id' => 2,
		),
		'fixedPostVars' => array(
		),
		'postVarSets' => array(
		    '_DEFAULT' => array(
		    ),
		),
		// configure filenames for different pagetypes
		'fileName' => array(
			'index' => array(
				'rss.xml' => array(
					'keyValues' => array(
						'type' => 100,
					),
				),
				'rss091.xml' => array(
					'keyValues' => array(
						'type' => 101,
					),
				),
				'rdf.xml' => array(
					'keyValues' => array(
						'type' => 102,
					),
				),
				'atom.xml' => array(
					'keyValues' => array(
						'type' => 103,
					),
				),
			),
		),
	),
);

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tstemplate.php']['linkData-PostProc']['tx_realurl'] = 'EXT:realurl/class.tx_realurl.php:&tx_realurl->encodeSpURL';
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_content.php']['typoLink_PostProc']['tx_realurl'] = 'EXT:realurl/class.tx_realurl.php:&tx_realurl->encodeSpURL_urlPrepend';
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['checkAlternativeIdMethods-PostProc']['tx_realurl'] = 'EXT:realurl/class.tx_realurl.php:&tx_realurl->decodeSpURL';

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearPageCacheEval']['tx_realurl'] = 'EXT:realurl/class.tx_realurl.php:&tx_realurl->clearPageCacheMgm';
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['tx_realurl_urldecodecache'] = 'tx_realurl_urldecodecache';
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['tx_realurl_urlencodecache'] = 'tx_realurl_urlencodecache';

// Must use '&" with tcemain hook!!! Important for proper work of the hook.
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['tx_realurl'] = 'EXT:realurl/class.tx_realurl_tcemain.php:&tx_realurl_tcemain';

$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',tx_realurl_pathsegment,tx_realurl_exclude';
$TYPO3_CONF_VARS['FE']['pageOverlayFields'] .= ',tx_realurl_pathsegment';

define('TX_REALURL_SEGTITLEFIELDLIST_DEFAULT', 'tx_realurl_pathsegment,alias,nav_title,title');
define('TX_REALURL_SEGTITLEFIELDLIST_PLO', 'tx_realurl_pathsegment,nav_title,title');
?>