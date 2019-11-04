<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main;

$props = array(
    'COLOR',
    'Diam',
    'b_k',
    'o_s',
    'a_d',
    'sf',
    'ci',
    'os',
);
foreach ($arResult['ITEMS']['AnDelCanBuy'] as $key => $ITEM) {
    foreach ($props as $prop) {
        if ($ITEM['PROPERTY_' . $prop . '_VALUE'] == false) {
            unset($arResult['ITEMS']['AnDelCanBuy'][$key]['PROPERTY_' . $prop . '_VALUE']);
            unset($arResult['ITEMS']['AnDelCanBuy'][$key]['~PROPERTY_' . $prop . '_VALUE']);
            unset($arResult['ITEMS']['AnDelCanBuy'][$key]['PROPERTY_' . $prop . '_VALUE_ID']);
            unset($arResult['ITEMS']['AnDelCanBuy'][$key]['~PROPERTY_' . $prop . '_VALUE_ID']);
        }
    }
}

$defaultParams = array(
	'TEMPLATE_THEME' => 'blue'
);
$arParams = array_merge($defaultParams, $arParams);
unset($defaultParams);

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME'])
{
	$arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
	if ('site' == $arParams['TEMPLATE_THEME'])
	{
		$templateId = (string)Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', SITE_ID);
		$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? 'eshop_adapt' : $templateId;
		$arParams['TEMPLATE_THEME'] = (string)Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', SITE_ID);
	}
	if ('' != $arParams['TEMPLATE_THEME'])
	{
		if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
			$arParams['TEMPLATE_THEME'] = '';
	}
}
if ('' == $arParams['TEMPLATE_THEME'])
	$arParams['TEMPLATE_THEME'] = 'blue';
