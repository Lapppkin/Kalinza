<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Sotbit\Regions\Config;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin.php');
Loc::loadMessages(__FILE__);
if($APPLICATION->GetGroupRight("main") < "R")
{
	$APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}
if(!Loader::includeModule('sotbit.regions'))
{
	return false;
}
$Options = new Config\Admin($_REQUEST['site']);

//if(Loader::includeModule('sale'))
    $oneDomain = new Config\Widgets\CheckBox('SINGLE_DOMAIN');

$modeLocation = new Config\Widgets\CheckBox('MODE_LOCATION');
$insertSaleLocation = new Config\Widgets\CheckBox('INSERT_SALE_LOCATION');
$addOrderProperty = new Config\Widgets\CheckBox(
	'ADD_ORDER_PROPERTY',
	[
		'NOTE' => Loc::getMessage(SotbitRegions::moduleId . '_ADD_ORDER_PROPERTY_NOTE')
	]
);
$findUserMethod = new Config\Widgets\Select('FIND_USER_METHOD',
	[
		'NOTE' => Loc::getMessage(SotbitRegions::moduleId . '_WIDGET_FIND_USER_METHOD_NOTE')
	]);
if(Loader::includeModule('statistic'))
{
	$findUserMethodValues = [
		'ipgeobase' => 'IpGeoBase',
		'statistic' => Loc::getMessage(SotbitRegions::moduleId . '_STATISTIC')
	];
}
else
{
	$findUserMethodValues = [
		'ipgeobase' => 'IpGeoBase',
	];
}

if(function_exists('geoip_record_by_name'))
{
	$findUserMethodValues['geoip'] = 'GeoIp';
}

$findUserMethod->setValues($findUserMethodValues);
$multipleDelimiter = new Config\Widgets\Str('MULTIPLE_DELIMITER', ['COLSPAN' => [0 => 2]]);
$Variables = new Config\Widgets\Variables(
	'AVAILABLE_VARIABLES',
	[
		'CUSTOM_ROW' => true,
		'SITE_ID' => $_REQUEST['site']
	]
);

$Tab = new Config\Tab('1');
$Group = new Config\Group('MAIN_SETTINGS');
$Group->getWidgets()->addItem($oneDomain);

if(Loader::includeModule('sale'))
    $Group->getWidgets()->addItem($modeLocation);

$Group->getWidgets()->addItem($findUserMethod);
$Group->getWidgets()->addItem($insertSaleLocation);
$Group->getWidgets()->addItem($addOrderProperty);
$Tab->getGroups()->addItem($Group);
$Options->getTabs()->addItem($Tab);

$Tab = new Config\Tab('2');
$Group = new Config\Group('VARIABLES_SETTINGS', ['COLSPAN' => 3]);
$Group->getWidgets()->addItem($multipleDelimiter);
$Tab->getGroups()->addItem($Group);
$Group = new Config\Group('VARIABLES', ['COLSPAN' => 3]);
$Group->getWidgets()->addItem($Variables);
$Tab->getGroups()->addItem($Group);
$Options->getTabs()->addItem($Tab);

$Options->show();
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>