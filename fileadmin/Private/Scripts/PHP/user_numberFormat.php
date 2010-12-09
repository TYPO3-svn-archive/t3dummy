<?php
class user_numberFormat {
	public function number_format($content, $conf) {
		$decimals = $GLOBALS['TSFE']->cObj->stdWrap($conf['decimals'], $conf['decimals.']);
		$dec_point = $GLOBALS['TSFE']->cObj->stdWrap($conf['dec_point'], $conf['dec_point.']);
		$thousands_sep = $GLOBALS['TSFE']->cObj->stdWrap($conf['thousands_sep'], $conf['thousands_sep.']);
		return number_format(str_replace(',', '.', $content), $decimals, $dec_point, $thousands_sep);
	}
}
?>