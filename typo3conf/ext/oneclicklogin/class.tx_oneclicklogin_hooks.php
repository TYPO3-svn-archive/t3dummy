<?php

class tx_oneclicklogin_hooks{

	function addLoginNews(&$params, &$reference) {
		global $TYPO3_CONF_VARS;
		$tx_onclicklogin_users = array();
	
		$time = time();
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'*',
			'be_users',
			'	tx_openid_openid <> "" AND
				tx_oneclicklogin_enable = 1 AND
				disable = 0 AND
				starttime < ' . $time . ' AND
				(endtime = 0 OR endtime > ' . $time . ')',
			'', 'username ASC');
		while($beUser = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$tx_oneclicklogin_users[] = '<a href="#" onclick="TYPO3BackendLogin.switchToOpenId();$(\'t3-username\').value=\'' . $beUser['tx_openid_openid'] . '\';$(\'t3-login-form-outer\').parentNode.submit();TYPO3BackendLogin.showLoginProcess();return false;">' . $beUser['username'] . '</a>';
		}
		
		if(count($tx_oneclicklogin_users)){
			$TYPO3_CONF_VARS['BE']['loginNews'][] = array(
				'date' => 'Extension',
				'header' => '1 Click Login',
				'content' => join(', ', $tx_oneclicklogin_users),
			);
		}
		
	}

}

?>