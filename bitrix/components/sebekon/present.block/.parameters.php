<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('iblock') || !CModule::IncludeModule('sale') || !CModule::IncludeModule('sebekon.presents')) {
    return;
}

$arComponentParameters = array(
    'GROUPS' => array(
    ),
    'PARAMETERS' => array(
        //'CACHE_TIME'  =>  Array('DEFAULT'=>3600),
    ),
);
?>
