<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Dmitry Dulepov (dmitry.dulepov@gmail.com)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * $Id: class.tx_realurl_pagebrowser.php 37826 2010-09-08 14:05:32Z dmitry $
 *
 */

 /**
  * This class is a page browser for the RealURL backend module.
  *
  * @author Dmitry Dulepov <dmitry.dulepov@gmail.com>
  * @package TYPO3
  * @subpackage tx_realurl
  */
class tx_realurl_pagebrowser {

	const PAGES_BEFORE = 1;
	const PAGES_BEFORE_END = 1;
	const PAGES_AFTER = 1;
	const PAGES_AFTER_START = 1;
	const RESULTS_PER_PAGE = 20;

	protected $currentPage;
	protected $totalPages;
	protected $baseURL;

	/**
	 * Creates an isntance of this class.
	 *
	 * @return void
	 */
	public function __construct() {
		$urlParameters = t3lib_div::array_merge_recursive_overrule($_GET, $_POST);
		$this->currentPage = max(1, intval($urlParameters['page']));
		unset($urlParameters['page']);
		unset($urlParameters['cmd']);
		$this->baseURL = t3lib_div::getIndpEnv('TYPO3_REQUEST_SCRIPT') .
			'?' . t3lib_div::implodeArrayForUrl('', $urlParameters);
	}

	public function getPageBrowser($totalResults) {
		$this->calcTotalPages($totalResults);

		$markup = '';

		if ($this->totalPages > 1) {
			$markup = $this->generatePageBrowser();
			$markup = '<table class="pagebrowser"><tr>' . $markup . '</tr></table>';
		}

		return $markup;
	}

	static public function getInlineStyles() {
		return '
			TABLE.pagebrowser {
				margin-left: auto;
			}
			TABLE.pagebrowser TR TD {
				padding: 2px 4px;
			}
			TABLE.pagebrowser TR TD.page {
				border: 1px solid #595d66;
			}
		';
	}

	protected function generatePageBrowser() {
		for ($page = 1; $page <= min($this->totalPages, $this->currentPage, self::PAGES_AFTER_START + 1); $page++) {
			$markup .= $this->createCell($page);
		}

		if ($page < $this->currentPage - self::PAGES_BEFORE) {
			$markup .= $this->createEllipses();
			$page = $this->currentPage - self::PAGES_BEFORE;
		}

		for ( ; $page <= min($this->totalPages, $this->currentPage + self::PAGES_AFTER); $page++) {
			$markup .= $this->createCell($page);
		}

		if ($page < $this->totalPages - self::PAGES_BEFORE_END) {
			$markup .= $this->createEllipses();
			$page = $this->totalPages - self::PAGES_BEFORE_END;
		}

		for ( ; $page <= $this->totalPages; $page++) {
			$markup .= $this->createCell($page);
		}

		return $markup;
	}

	protected function createCell($pageNumber) {
		if ($pageNumber != $this->currentPage) {
			$link = array(
				'<a href="' . $this->baseURL . '&amp;page=' . $pageNumber . '">',
				'</a>'
			);
		}
		else {
			$link = array('', '');
			$extraClass = ' bgColor-20';
		}

		return '<td class="page' . $extraClass . '">' . $link[0] . $pageNumber . $link[1] . '</td>';
	}

	protected function createEllipses() {
		return '<td>...</td>';
	}

	protected function calcTotalPages($totalResults) {
		$this->totalPages = intval($totalResults/self::RESULTS_PER_PAGE) +
			(($totalResults % self::RESULTS_PER_PAGE) != 0 ? 1 : 0);
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/realurl/modfunc1/class.tx_realurl_pagebrowser.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/realurl/modfunc1/class.tx_realurl_pagebrowser.php']);
}

?>