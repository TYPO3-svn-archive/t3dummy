<?php
/***************************************************************
*	Copyright notice
*
*	(c) 2006 Thomas Off, LumoNet oHG <t.off@lumonet.de>
*	All rights reserved
*
*	This script is part of the TYPO3 project. The TYPO3 project is
*	free software; you can redistribute it and/or modify
*	it under the terms of the GNU General Public License as published by
*	the Free Software Foundation; either version 2 of the License, or
*	(at your option) any later version.
*
*	The GNU General Public License can be found at
*	http://www.gnu.org/copyleft/gpl.html.
*
*	This script is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
*	GNU General Public License for more details.
*
*	This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Plugin 'Google map' for the 'lumogooglemaps' extension.
 *
 * @author	Thomas Off, LumoNet oHG <t.off@lumonet.de>
 */

require_once(PATH_tslib . 'class.tslib_pibase.php');

require_once(t3lib_extMgm::extPath('lumogooglemaps') . 'GoogleMapAPI.class.php');

class tx_lumogooglemaps_pi1 extends tslib_pibase {

	var $prefixId = 'tx_lumogooglemaps_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_lumogooglemaps_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey = 'lumogooglemaps';	// The extension key.
	var $pi_checkCHash = TRUE;

	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf)	{
		// Initialize
		$this->init($conf);

		// Get template
		$sTemplateCode = $this->cObj->fileResource($this->lConf['template_file']);
		
		// Get sub-templates
		$this->lTemplateParts = array();
		$this->lTemplateParts['total'] = $this->cObj->getSubpart($sTemplateCode, '###TEMPLATE_MAP###');
		$this->lTemplateParts['sidebar'] = $this->cObj->getSubpart($sTemplateCode, '###TEMPLATE_SIDEBAR###');
		$this->lTemplateParts['infobox'] = $this->cObj->getSubpart($sTemplateCode, '###TEMPLATE_INFOBOX###');

		// Create map object and set basic properties
		$this->createMap();

		// Add marker from database to map
		$iCount = $this->addMarkersToMap();
		
		// Set zoom level
		if ($this->lConf['zoom'] != 'auto') {
			// datamints: eine Zeile eingefügt, weil sonst "auto" sonst nie deaktiviert wird.
			$this->oMap->disableZoomEncompass();
			$this->oMap->setZoomLevel($this->lConf['zoom']);
		}

		// Set center point (if necessary)
		if (($this->lConf['center_show'] == 0 && $iCount == 0) || $this->lConf['center_show'] == 1) {
			$this->oMap->setCenterCoords($this->lConf['center_longitude'], $this->lConf['center_latitude']);
		}
		
		// Fill marker array
		$lMarkerArray = array();
		$lMarkerArray['###MAP_HEADERJS###'] = $this->oMap->getHeaderJS();
		$lMarkerArray['###MAP_MAPJS###'] = $this->oMap->getMapJS();
		$lMarkerArray['###MAP_MAP###'] = $this->oMap->getMap();

		// Create sidebar
		$lMarkerArray['###MAP_SIDEBAR###'] = $this->createSidebar();

		// Process template
		$content = $this->cObj->substituteMarkerArrayCached($this->lTemplateParts['total'], $lMarkerArray, array(), array());

		// Return rendered content
		return $this->pi_wrapInBaseClass($content);
	}

	/**
	 * Initialize plugin and get configuration values.
	 *
	 * @param	array		$conf : configuration array from TS
	 */
	function init($conf) {
		// Store configuration
				
		$this->conf = $conf;

		// Loading language-labels
		$this->pi_loadLL();

		// Set default piVars from TS
		$this->pi_setPiVarDefaults();

		// Init and get the flexform data of the plugin
		$this->pi_initPIflexForm();

		// Assign the flexform data to a local variable for easier access
		$piFlexForm = $this->cObj->data['pi_flexform'];

		// Array for local configuration
		$this->lConf = array();
		
		// FlexForm: Sheet: General

		// Width
		$vWidth = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'width', 'sGeneral'); // Get from FlexForm
		$vWidth = (intval($vWidth) != 0) ? $vWidth : trim($this->conf['map.']['width']); // Get from TS
		$vWidth = (intval($vWidth) != 0) ? $vWidth : '500';
		$vWidth = intval($vWidth);
		$this->lConf['width'] = $vWidth;

		// Height
		$vHeight = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'height', 'sGeneral'); // Get from FlexForm
		$vHeight = (intval($vHeight) != 0) ? $vHeight : trim($this->conf['map.']['height']); // Get from TS
		$vHeight = (intval($vHeight) != 0) ? $vHeight : '500';
		$vHeight = intval($vHeight);
		$this->lConf['height'] = $vHeight;

		// Type of map
		$vType = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'type', 'sGeneral'); // Get from FlexForm
		if ($vType == 'ts') {
			$vType = trim($this->conf['map.']['type']); // Get from TS			
		}
		$vType = $vType ? $vType : 'map'; // Set default
		$this->lConf['type'] = $vType;

		// Show type controls?
		$vTypeControls = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'type_controls', 'sGeneral'); // Get from FlexForm
		if ($vTypeControls == 'ts') {
			$vTypeControls = trim($this->conf['map.']['type_controls']); // Get from TS
		}
		$vTypeControls = $vTypeControls ? $vTypeControls : 'show'; // Set default
		$this->lConf['type_controls'] = $vTypeControls;

		// Show navigation controls?
		$vNavControls = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'nav_controls', 'sGeneral'); // Get from FlexForm
		if ($vNavControls == 'ts') {
			$vNavControls = trim($this->conf['map.']['nav_controls']); // Get from TS
		}
		$vNavControls = $vNavControls ? $vNavControls : 'large'; // Set default
		$this->lConf['nav_controls'] = $vNavControls;
		
		// Default zoom level
		$vZoom = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'zoom', 'sGeneral'); // Get from FlexForm
		if ($vZoom == 'ts') {
			$vZoom = trim($this->conf['map.']['zoom']); // Get from TS
		}
		//$vZoom = $vZoom ? $vZoom : 'auto'; // Set default
		if ($vZoom != 'auto') {
			$vZoom = intval($vZoom) - 1;
		}
		$this->lConf['zoom'] = $vZoom;
		
		//echo $this->lConf['zoom'];

		// FlexForm: Sheet: Data

		// Marker for handling center point settings
		$bCenterDefault = false;

		// Longitude of center point
		$vCenterLongitude = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'center_longitude', 'sData'); // Get from FlexForm
		$vCenterLongitude = (strlen($vCenterLongitude) != 0) ? $vCenterLongitude : trim($this->conf['center.']['longitude']); // Get from TS
		if (strlen($vCenterLongitude) == 0) {
			$vCenterLongitude = '11.2005'; // Set default: LumoNet bureau in 82418 Murnau, Germany
			$bCenterDefault = true;
		}
		$vCenterLongitude = doubleval($vCenterLongitude);
		$this->lConf['center_longitude'] = $vCenterLongitude;

		// Latitude of center point
		$vCenterLatitude = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'center_latitude', 'sData'); // Get from FlexForm
		$vCenterLatitude = (strlen($vCenterLatitude) != 0) ? $vCenterLatitude : trim($this->conf['center.']['latitude']); // Get from TS
		if (strlen($vCenterLatitude) == 0) {
			$vCenterLatitude = '47.6765'; // Set default: LumoNet bureau in 82418 Murnau, Germany
			$bCenterDefault = true;						
		}		
		$vCenterLatitude = doubleval($vCenterLatitude);
		$this->lConf['center_latitude'] = $vCenterLatitude;

		// Control when center point will be shown
		$vCenterShow = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'center_show', 'sData'); // Get from FlexForm
		if ($vCenterShow == 'ts') {
			$vCenterShow = trim($this->conf['center.']['show']); // Get from TS
		}
		$vCenterShow = (strlen($vCenterShow) != 0) ? $vCenterShow : '0'; // Set default
		$vCenterShow = $bCenterDefault ? '0' : $vCenterShow; // Only set to '1' if also coordinates are given
		$vCenterShow = intval($vCenterShow);
		$this->lConf['center_show'] = $vCenterShow;

		// Starting point for items
		$vStartingPoint = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'startingpoint', 'sData'); // Get from FlexForm
		$vStartingPoint = $vStartingPoint ? $vStartingPoint : trim($this->conf['pid_list']); // Get from TS
		$vStartingPoint = $vStartingPoint ? $vStartingPoint : $GLOBALS['TSFE']->id; // Set default
		$this->lConf['startingpoint'] = $vStartingPoint;

		// Recursion mode for searching items
		$vRecursive = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'recursive', 'sData'); // Get from FlexForm
		$vRecursive = $vRecursive ? $vRecursive : trim($this->conf['recursive']); // Get from TS
		$vRecursive = $vRecursive ? $vRecursive : '0'; // Set default
		$vRecursive = intval($vRecursive);
		$this->lConf['recursive'] = $vRecursive;
		
		// FlexForm: Sheet: Template
		
		// Template file
		$vTemplateFile = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'template_file', 'sTemplate'); // Get from FlexForm
		$vTemplateFile = $vTemplateFile ? ('uploads/tx_lumogooglemaps/' . $vTemplateFile) : trim($this->conf['template_file']); // Get from TS
		$vTemplateFile = $vTemplateFile ? t3lib_div::getFileAbsFileName($vTemplateFile) : t3lib_extMgm::siteRelPath('lumogooglemaps') . 'templates/template_css.html'; // Set default
		$vTemplateFile = preg_replace('~^' . PATH_site . '~', '', $vTemplateFile); // Strip PATH_site from path
		$this->lConf['template_file'] = $vTemplateFile;

		// Marker icon
		$vMarkerIcon = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'marker_icon', 'sTemplate'); // Get from FlexForm
		$vMarkerIcon = $vMarkerIcon ? ('uploads/tx_lumogooglemaps/' . $vMarkerIcon) : trim($this->conf['marker.']['icon']); // Get from TS
		$vMarkerIcon = $vMarkerIcon ? t3lib_div::getFileAbsFileName($vMarkerIcon) : ''; // Set default
		$vMarkerIcon = preg_replace('~^' . PATH_site . '~', '', $vMarkerIcon); // Strip PATH_site from path
		$this->lConf['marker_icon'] = $vMarkerIcon;

		// Marker shadow
		$vMarkerShadow = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'marker_shadow', 'sTemplate'); // Get from FlexForm
		$vMarkerShadow = $vMarkerShadow ? ('uploads/tx_lumogooglemaps/' . $vMarkerShadow) : trim($this->conf['marker.']['shadow']); // Get from TS
		$vMarkerShadow = $vMarkerShadow ? t3lib_div::getFileAbsFileName($vMarkerShadow) : ''; // Set default
		$vMarkerShadow = preg_replace('~^' . PATH_site . '~', '', $vMarkerShadow); // Strip PATH_site from path
		$this->lConf['marker_shadow'] = $vMarkerShadow;

		// x coord in image for spot
		$vMarkerSpotX = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'marker_spot_x', 'sTemplate'); // Get from FlexForm
		$vMarkerSpotX = (strlen($vMarkerSpotX) != 0) ? $vMarkerSpotX : trim($this->conf['marker.']['spot.']['x']); // Get from TS
		$vMarkerSpotX = (strlen($vMarkerSpotX) != 0) ? $vMarkerSpotX : '0'; // Set default
		$vMarkerSpotX = intval($vMarkerSpotX);
		$this->lConf['marker_spot_x'] = $vMarkerSpotX;

		// y coord in image for spot
		$vMarkerSpotY = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'marker_spot_y', 'sTemplate'); // Get from FlexForm
		$vMarkerSpotY = (strlen($vMarkerSpotY) != 0) ? $vMarkerSpotY : trim($this->conf['marker.']['spot.']['y']); // Get from TS
		$vMarkerSpotY = (strlen($vMarkerSpotY) != 0) ? $vMarkerSpotY : '0'; // Set default
		$vMarkerSpotY = intval($vMarkerSpotY);
		$this->lConf['marker_spot_y'] = $vMarkerSpotY;

		// x coord in image for info box
		$vMarkerInfoX = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'marker_info_x', 'sTemplate'); // Get from FlexForm
		$vMarkerInfoX = (strlen($vMarkerInfoX) != 0) ? $vMarkerInfoX : trim($this->conf['marker.']['info.']['x']); // Get from TS
		$vMarkerInfoX = (strlen($vMarkerInfoX) != 0) ? $vMarkerInfoX : '10'; // Set default
		$vMarkerInfoX = intval($vMarkerInfoX);
		$this->lConf['marker_info_x'] = $vMarkerInfoX;

		// y coord in image for info box
		$vMarkerInfoY = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'marker_info_y', 'sTemplate'); // Get from FlexForm
		$vMarkerInfoY = (strlen($vMarkerInfoY) != 0) ? $vMarkerInfoY : trim($this->conf['marker.']['info.']['y']); // Get from TS
		$vMarkerInfoY = (strlen($vMarkerInfoY) != 0) ? $vMarkerInfoY : '10'; // Set default
		$vMarkerInfoY = intval($vMarkerInfoY);
		$this->lConf['marker_info_y'] = $vMarkerInfoY;

		// Purely set from TypoScript

		// Google API key
		$vGoogleApiKey = trim($this->conf['google_api_key']);
		$vGoogleApiKey = (strlen($vGoogleApiKey) != 0) ? $vGoogleApiKey : '';
		$this->lConf['google_api_key'] = $vGoogleApiKey;

		// Default country (used for geocoding)
		$vDefaultCountry = trim($this->conf['default_country']);
		$vDefaultCountry = (strlen($vDefaultCountry) != 0) ? $vDefaultCountry : 'Germany';
		$this->lConf['default_country'] = $vDefaultCountry;
	}
	
	function createMap() {
		// Generate unique ids for containing div and Yahoo
		$sMapId = t3lib_div::shortMD5('map' . time());
		$sYahooId = 'yahoo_' . t3lib_div::shortMD5('yahoo' . time());

		// Generate map object
		$this->oMap = new GoogleMapAPI($sMapId, $sYahooId);

		// Set Google API key
		$this->oMap->setAPIKey($this->lConf['google_api_key']);

		// Set properties of map:
		// Width
		$this->oMap->setWidth($this->lConf['width']);
		// Height
		$this->oMap->setHeight($this->lConf['height']);
		// Type of map
		$this->oMap->setMapType($this->lConf['type']);
		// Show type controls?
		if ($this->lConf['type_controls'] == 'show') {
			$this->oMap->enableTypeControls();
		}
		else {
			$this->oMap->disableTypeControls();
		}
		// Show navigation controls?
		switch ($this->lConf['nav_controls']) {
			case 'none':
				$this->oMap->disableMapControls();
				break;
			case 'small':
				$this->oMap->enableMapControls();
				$this->oMap->setControlSize('small');
				break;
			case 'large':
			default:
				$this->oMap->enableMapControls();
				$this->oMap->setControlSize('large');
				break;
		}
		// Marker icon
		if ($this->lConf['marker_icon'] != '' && $this->lConf['marker_shadow'] != '') {
			$this->oMap->setMarkerIcon(
				$this->lConf['marker_icon'],
				$this->lConf['marker_shadow'],
				$this->lConf['marker_spot_x'],
				$this->lConf['marker_spot_y'],
				$this->lConf['marker_info_x'],
				$this->lConf['marker_info_y']
			);
		}

		// Set language labels for map
		$lDirLabels = $this->oMap->getDirectionsText();
		$lDirLabels['dir_text'] = $this->pi_getLL('map.directions.dir_text');
		$lDirLabels['dir_tohere'] = $this->pi_getLL('map.directions.dir_tohere');
		$lDirLabels['dir_fromhere'] = $this->pi_getLL('map.directions.dir_fromhere');
		$lDirLabels['dir_to'] = $this->pi_getLL('map.directions.dir_to');
		$lDirLabels['button_to'] = $this->pi_getLL('map.directions.button_to');
		$lDirLabels['dir_from'] = $this->pi_getLL('map.directions.dir_from');
		$lDirLabels['button_from'] = $this->pi_getLL('map.directions.button_from');
		$this->oMap->setDirectionsText($lDirLabels);
		$this->oMap->setBrowserAlert($this->pi_getLL('map.browseralert'));
		$this->oMap->setJsAlert($this->pi_getLL('map.jsalert'));
	}

	/**
	 * Add marker from table tt_address to map
	 *
	 * @return	integer	Number of added markers
	 */
	function addMarkersToMap() {
		// Get pid list for select query
		$sPidList = $this->pi_getPidList($this->lConf['startingpoint'], $this->lConf['recursive']);

		// Perform select query
		$iResult = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'*',
			'tt_address',
			'pid IN (' . $sPidList . ')' . $this->cObj->enableFields('tt_address'),
			'',
			'name'
		);

		// Process the fetched tt_address items
		$iCount = 0;
		while ($lRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($iResult)) {
			// Get longitude and latitude
			$fLongitude = floatval($lRow['tx_lumogooglemaps_longitude']);
			$fLatitude = floatval($lRow['tx_lumogooglemaps_latitude']);
			if ($fLongitude == 0.0 || $fLatitude == 0.0) {
				if ($lRow['address'] == '' &&
					$lRow['zip'] == '' &&
					$lRow['city'] == '') {
					// No address and no coords stored => no marker to set
					continue;
				}

				// Try to get coords from geocoding service
				$sAddress = $lRow['address'] . ',' . $lRow['zip'] . ' ' . $lRow['city'];
				$sCountry = (strlen($lRow['country']) != 0) ? $lRow['country'] : $this->lConf['default_country'];
				$sAddress .= (strlen($sCountry) != 0) ? ',' . $sCountry : ''; 
				$sAddress = trim(preg_replace('/\s+/', ' ', $sAddress));
				$lCoords = $this->oMap->geoGetCoords($sAddress, 'GOOGLE');
				if (!$lCoords) {
					$lCoords = $this->oMap->geoGetCoords($sAddress, 'YAHOO');
				}
				if (count($lCoords) == 2) {
					$lRow['tx_lumogooglemaps_longitude'] = $lCoords['lon'];
					$lRow['tx_lumogooglemaps_latitude'] = $lCoords['lat'];

					// Save coords to database
					$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
						'tt_address',
						'uid=' . $lRow['uid'],
						array(
							'tx_lumogooglemaps_longitude' => $lRow['tx_lumogooglemaps_longitude'],
							'tx_lumogooglemaps_latitude' => $lRow['tx_lumogooglemaps_latitude'],
						)
					);
				}
				else {
					// Coords couldn't be retrieved from geocoding service
					continue;
				}
			}
			
			// Build up content of info box
			$sInfoBox = $this->createInfoBox($lRow);

			// Set marker in map
			$this->oMap->addMarkerByCoords($lRow['tx_lumogooglemaps_longitude'], $lRow['tx_lumogooglemaps_latitude'], $lRow['name'], $sInfoBox);
			$iCount++;
		}

		return $iCount;
	}

	/**
	 * Create sidebar HTML from template and list of sidebar items
	 *
	 * @return	string	Processed template for sidebar
	 */
	function createSidebar() {
		$sContent = '';

		// Get sub-templates
		$lTemplateParts['list'] = $this->cObj->getSubpart($this->lTemplateParts['sidebar'], '###SIDEBAR_LIST###');
		$lTemplateParts['item'] = $this->cObj->getSubpart($lTemplateParts['list'], '###SIDEBAR_ITEM###');

		// Fetch sidebar elements
		$lSidebarItems = $this->oMap->getSidebarItems();

		// Compose list items
		$sListContent = '';
		$lMarkerArray = array();
		foreach ($lSidebarItems as $key => $val) {
			$lMarkerArray['###SIDEBAR_ITEM_LINK###'] = $val[0];
			$lMarkerArray['###SIDEBAR_ITEM_TITLE###'] = $val[1];
			$sListContent .= $this->cObj->substituteMarkerArrayCached($lTemplateParts['item'], $lMarkerArray, array(), array());
		}

		// Insert list items in template
		if (sListContent != '') {
			// Replace item subpart with list items
			$sListContent = $this->cObj->substituteSubpart($lTemplateParts['list'], '###SIDEBAR_ITEM###', $sListContent);
		}
		else {
			// unset list items to remove them
			$sListContent = '';
		}

		// Insert list subpart in template
		$sContent = $this->cObj->substituteSubpart($this->lTemplateParts['sidebar'], '###SIDEBAR_LIST###', $sListContent);

		return $sContent;
	}
	
	/**
	 * Create HTML for info box from template and tt_address item
	 *
	 * @param	array	Array containing a tt_address item
	 * @return	string	Processed template for sidebar
	 */
	function createInfoBox($lRow) {
		$sContent = '';
		
		// Fill marker array
		$lMarkerArray = array();
		// Field: name
		$lMarkerArray['###INFOBOX_NAME###'] = $lRow['name'];
		// Field: title
		$lMarkerArray['###INFOBOX_TITLE###'] = $lRow['title'];
		// Field: company
		$lMarkerArray['###INFOBOX_COMPANY###'] = $lRow['company'];
		// Field: address
		$sAddress = $lRow['address'];
		$sAddress = str_replace("\r", '', $sAddress);
		$sAddress = str_replace("\n", '<br />', $sAddress);
		$lMarkerArray['###INFOBOX_ADDRESS###'] = $sAddress;
		// Field: zip
		$lMarkerArray['###INFOBOX_ZIP###'] = $lRow['zip'];
		// Field: city
		$lMarkerArray['###INFOBOX_CITY###'] = $lRow['city'];
		// Field: country
		$lMarkerArray['###INFOBOX_COUNTRY###'] = $lRow['country'];
		// Field: email
		$sEmail = $lRow['email'];
		if (t3lib_div::validEmail($sEmail)) {
			$sEmail = $this->cObj->getTypoLink($sEmail, $sEmail);
		}
		$lMarkerArray['###INFOBOX_EMAIL###'] = $sEmail;
		// Field: www
		$sWWW = $this->cObj->getTypoLink($lRow['www'], $lRow['www'], array(), '_blank');
		$lMarkerArray['###INFOBOX_WWW###'] = $sWWW;
		// Field: phone
		$lMarkerArray['###INFOBOX_PHONE###'] = $lRow['phone'];
		// Field: mobile
		$lMarkerArray['###INFOBOX_MOBILE###'] = $lRow['mobile'];
		// Field: fax
		$lMarkerArray['###INFOBOX_FAX###'] = $lRow['fax'];
		// Field: image
		$lMarkerArray['###INFOBOX_IMAGE###'] = $this->createImage('uploads/pics/' . $lRow['image']);
		// Field: description
		$lMarkerArray['###INFOBOX_DESCRIPTION###'] = $this->cObj->parseFunc ($lRow['description'], $GLOBALS['TSFE']->tmpl->setup['lib.']['parseFunc_RTE.']);
		// Field: tx_lumogooglemaps_longitude
		$lMarkerArray['###INFOBOX_LONGITUDE###'] = $lRow['tx_lumogooglemaps_longitude'];
		// Field: tx_lumogooglemaps_latitude
		$lMarkerArray['###INFOBOX_LATITUDE###'] = $lRow['tx_lumogooglemaps_latitude'];

		// Replace marker in template
		$sContent = $this->cObj->substituteMarkerArrayCached($this->lTemplateParts['infobox'], $lMarkerArray, array(), array());

		// Remove newlines (as infobox HTML is used in JavaScript)
		$sContent = str_replace("\r", '', $sContent);
		$sContent = str_replace("\n", '', $sContent);

		return $sContent;
	}
	
	/**
	 * Create image tag from file name
	 *
	 * @param	string	Path to image file
	 * @return	string	Generated image tag
	 */
	function createImage($sImageFile) {
		// Build up configuration array
		$lConf = array();
		$lConf['file'] = $sImageFile;
		$lConf['file.']['maxW'] = '100';
		$lConf['file.']['maxH'] = '100';
		$lConf['imageLinkWrap'] = '1';
		$lConf['imageLinkWrap.']['enable'] = '1';
		$lConf['imageLinkWrap.']['bodyTag'] = '<body bgColor="#ffffff">';
		$lConf['imageLinkWrap.']['wrap'] = '<a href="javascript:close();"> | </a>';
		$lConf['imageLinkWrap.']['width'] = '500m';
		$lConf['imageLinkWrap.']['height'] = '500';
		$lConf['imageLinkWrap.']['JSwindow'] = '1';
		$lConf['imageLinkWrap.']['JSwindow.']['newWindow'] = '1';
		$lConf['imageLinkWrap.']['JSwindow.']['expand'] = '17,20';
		
		// Generate image tag
		$sImage = $this->cObj->IMAGE($lConf);
		
		return $sImage;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/lumogooglemaps/pi1/class.tx_lumogooglemaps_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/lumogooglemaps/pi1/class.tx_lumogooglemaps_pi1.php']);
}

?>