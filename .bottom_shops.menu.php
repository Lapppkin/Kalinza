<?php

$aMenuLinks = array();

$arOrder = array('SORT' => 'ASC');
$arFilter =array(
    'IBLOCK_ID' => SHOPS_IBLOCK_ID,
    'PROPERTY_SHOP_REGION' => REGION_ID,
    'ACTIVE' => 'Y',
);

$arShops = \CIBlockElement::GetList($arOrder, $arFilter);
while($shop = $arShops->GetNextElement()) {

    $fields = $shop->GetFields();

    $aMenuLinks[] = array(
        $fields['NAME'],
        $fields['DETAIL_PAGE_URL'],
        array(),
        array(),
        ''
    );
}
