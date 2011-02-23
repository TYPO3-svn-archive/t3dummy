<?php

/**
 * Description of user_tsLangMenu
 *
 * @author Michaelsen
 */

class user_tsLangMenu {
	
	public function getLanguageIds($content, $conf) {
		$includeDefault = $GLOBALS['TSFE']->cObj->stdWrap($conf['includeDefault'], $conf['includeDefault.']);
		$excludeCurrent = $GLOBALS['TSFE']->cObj->stdWrap($conf['excludeCurrent'], $conf['excludeCurrent.']);
		
		$languageIds = array();
		
		if($includeDefault) {
			if(!$excludeCurrent || 0 != $GLOBALS['TSFE']->sys_language_uid) {
				$languageIds[] = 0;
			}
		}
		
		
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid', 'sys_language', 'hidden = 0');
		while($language = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			if(!$excludeCurrent || $language['uid'] != $GLOBALS['TSFE']->sys_language_uid) {
				$languageIds[] = $language['uid'];
			}
		}
		return join(',', $languageIds);
	}
	
}

?>
