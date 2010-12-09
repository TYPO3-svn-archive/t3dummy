<?php

class Tx_Formhandler_Generator_WebkitPdf extends Tx_Formhandler_AbstractGenerator {
	
	/**
	 * Renders the PDF.
	 *
	 * @return void
	 */
	public function process() {
		if(t3lib_extMgm::isLoaded('webkitpdf')) {
			$linkGP = array();
			
			if(strlen(Tx_Formhandler_Globals::$formValuesPrefix) > 0) {
				$linkGP[Tx_Formhandler_Globals::$formValuesPrefix] = $this->gp;
			} else {
				$linkGP = $this->gp;
			}
			$linkGP['submitted_ok'] = 1;
			$url = Tx_Formhandler_StaticFuncs::getHostname() . $this->cObj->getTypolink_URL($GLOBALS['TSFE']->id, $linkGP);
			
			$config = $this->readWebkitPdfConf();
			$config['fileOnly'] = 1;
			$config['urls.']['1'] = $url;
			
			if(!class_exists('tx_webkitpdf_pi1')) {
				require_once(t3lib_extMgm::extPath('webkitpdf') . 'pi1/class.tx_webkitpdf_pi1.php');
			}
			$generator = t3lib_div::makeInstance('tx_webkitpdf_pi1');
			
			return $generator->main('', $config);
			
		}
	}
	
	protected function readWebkitPdfConf() {
		$sysPageObj = t3lib_div::makeInstance('t3lib_pageSelect');
	
		if(!$GLOBALS['TSFE']->sys_page) {
			$GLOBALS['TSFE']->sys_page = $sysPageObj;
		}
		
		$rootLine = $sysPageObj->getRootLine($GLOBALS['TSFE']->id);
		$TSObj = t3lib_div::makeInstance('t3lib_tsparser_ext');
		$TSObj->tt_track = 0;
		$TSObj->init();
		$TSObj->runThroughTemplates($rootLine);
		$TSObj->generateConfig();
		
		$conf = array();
		if(isset($TSObj->setup['plugin.']['tx_webkitpdf_pi1.'])) {
			$conf = $TSObj->setup['plugin.']['tx_webkitpdf_pi1.'];
		} 
		return $conf;
	}
	
	public function getLink($linkGP) {
		$params = array();
		
		$url = Tx_Formhandler_StaticFuncs::getHostname() . $this->cObj->getTypolink_URL($GLOBALS['TSFE']->id, $linkGP);
		
		
		$params = array(
			'tx_webkitpdf_pi1' => array(
				'urls' => array(
					$url
				)
			),
			'no_cache' => 1,
			'submitted_ok' => 1
		);
		
		return $this->cObj->getTypolink('PDF', $this->settings['pid'], $params);
	}
}

?>