<?php

if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$tempColumns = Array (
	"tx_lumogooglemaps_longitude" => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:lumogooglemaps/locallang_db.xml:tt_address.tx_lumogooglemaps_longitude",
		"config" => Array (
			"type" => "input",
			"size" => "20",
			"max" => "20",
			"eval" => "nospace",
		)
	),
	"tx_lumogooglemaps_latitude" => Array (
		"exclude" => 1,
		"label" => "LLL:EXT:lumogooglemaps/locallang_db.xml:tt_address.tx_lumogooglemaps_latitude",
		"config" => Array (
			"type" => "input",
			"size" => "20",
			"max" => "20",
			"eval" => "nospace",
		)
	),
);

t3lib_div::loadTCA("tt_address");
t3lib_extMgm::addTCAcolumns("tt_address", $tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("tt_address", "tx_lumogooglemaps_longitude;;;;1-1-1, tx_lumogooglemaps_latitude");

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key,pages';

t3lib_extMgm::addPlugin(Array('LLL:EXT:' . $_EXTKEY . '/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY . '_pi1'), 'list_type');

t3lib_extMgm::addStaticFile($_EXTKEY, "pi1/static/", "Google map");

// Use FlexForms.
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/pi1/flexform_ds_pi1.xml');

if (TYPO3_MODE=="BE") {
	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_lumogooglemaps_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY) . 'pi1/class.tx_lumogooglemaps_pi1_wizicon.php';
}

?>