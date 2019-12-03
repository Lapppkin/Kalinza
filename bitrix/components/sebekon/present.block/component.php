<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arResult = array();

if(!CModule::IncludeModule('iblock') || !CModule::IncludeModule('sale') || !CModule::IncludeModule('sebekon.presents')) {
    return;
}

$arResult['BASKET']['ITEMS'] = sb\CPresents::getBasket();
$arResult['BASKET']['SUM'] = sb\CPresents::getBasketSum($arResult['BASKET']['ITEMS']);	
$arResult['BASKET']['PRESENTS']['NEXT'] = sb\CPresents::getPresent($arResult['BASKET']['SUM'], true);
$arResult['BASKET']['PRESENTS']['CURRENT'] = sb\CPresents::getPresent($arResult['BASKET']['SUM']);

$nextSumKeys = array_keys($arResult['BASKET']['PRESENTS']['NEXT']);

if($arResult['BASKET']['SUM'] < $nextSumKeys[0]) {
	$arResult['BASKET']['PRESENTS']['NEED_MORE'] = $nextSumKeys[0] - $arResult['BASKET']['SUM'];
}

if(empty($arResult['BASKET']['PRESENTS']['NEXT']) && empty($arResult['BASKET']['PRESENTS']['CURRENT'])) {
	return;
}

$arResult['BASKET']['PRODUCT_IDS'] = array();
foreach($arResult['BASKET']['PRESENTS']['NEXT'] as $sum => $arPresents) {
	foreach($arPresents as $productId => $arPresent) {
		$arResult['BASKET']['PRODUCT_IDS']['ALL'][] = $productId;
		$arResult['BASKET']['PRODUCT_IDS']['NEXT'][] = $productId;
	}
}
foreach($arResult['BASKET']['PRESENTS']['CURRENT'] as $sum => $arPresents) {
	foreach($arPresents as $productId => $arPresent) {
		$arResult['BASKET']['PRODUCT_IDS']['ALL'][] = $productId;
		$arResult['BASKET']['PRODUCT_IDS']['CURRENT'][] = $productId;
	}
}

$arResult['BASKET']['PRODUCT_IDS']['ALL'] = array_unique($arResult['BASKET']['PRODUCT_IDS']['ALL']);
$arResult['BASKET']['PRODUCT_IDS']['NEXT'] = array_unique($arResult['BASKET']['PRODUCT_IDS']['NEXT']);
$arResult['BASKET']['PRODUCT_IDS']['CURRENT'] = array_unique($arResult['BASKET']['PRODUCT_IDS']['CURRENT']);

if(empty($arResult['BASKET']['PRODUCT_IDS']['ALL'])) {
	return;
}

$arSort = array(
	'ID' => 'ASC'
);

$arFilter = array(
	'ID' => $arResult['BASKET']['PRODUCT_IDS']['ALL'],
);

$arSelect = array(
	'ID', 
	'NAME', 
	'DETAIL_PAGE_URL', 
	'PREVIEW_PICTURE', 
	'DETAIL_PICTURE'
);

$rsData = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
while($arData = $rsData->GetNext()) {
	if(!empty($arData['PREVIEW_PICTURE']) || !empty($arData['DETAIL_PICTURE'])) {
		$arData['PICTURE'] = CFile::ResizeImageGet(
            !empty($arData['DETAIL_PICTURE']) ? $arData['DETAIL_PICTURE'] : $arData['PREVIEW_PICTURE'],
            array('width' => 40, 'height' => 40),
            BX_RESIZE_IMAGE_PROPORTIONAL,
            false
        );
	}
	$arResult['BASKET']['PRESENTS']['DATA'][$arData['ID']] = $arData;
}

$this->IncludeComponentTemplate(); 
?>
