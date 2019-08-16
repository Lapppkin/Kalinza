<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# Component: sale.oneclickbuy                                                                              #
# File: .parameters.php                                                                                    #
# Version: 1.0.1                                                                                           #
# (c) 2011-2017 Kreattika, Sedov S.Y. (ООО "КРЕАТТИКА", Седов С.Ю.)                                        #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?><?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

use Bitrix\Main,
		Bitrix\Main\Application,
		Bitrix\Main\Loader,
		Bitrix\Main\Config\Option,
		Bitrix\Sale,
		Bitrix\Sale\Order,
		Bitrix\Sale\Delivery,
		Bitrix\Sale\PaySystem;


$KOCBModuleInc = CModule::IncludeModuleEx("kreattika.oneclickbuy");

$IBlockModuleInc = Loader::includeModule("iblock");
$HLBlockModuleInc = Loader::includeModule("highloadblock");
$SaleModuleInc = Loader::includeModule("sale");
$CurrencyModuleInc = Loader::includeModule('currency');

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));

if($site !== false)
	$arFilter["LID"] = $site;

$arEventTypes = array();
$arEventTypesFilter = array( "LID" => LANGUAGE_ID );
$rsEventType = CEventType::GetList($arEventTypesFilter);
$arEventTypes['N'] = GetMessage("KOCB_EVENT_NOT_SEND");
while ($arEventType = $rsEventType->Fetch()):
	$arEventTypes[$arEventType["EVENT_NAME"]] = "[".$arEventType["EVENT_NAME"]."] ".$arEventType["NAME"];
endwhile;

if( isset($arCurrentValues["EVENT_MESSAGE_TYPE"]) && !empty($arCurrentValues["EVENT_MESSAGE_TYPE"]) ):
	if(  $arCurrentValues["EVENT_MESSAGE_TYPE"] != "N" ):
		$arEventFilter = Array("TYPE_ID" => $arCurrentValues["EVENT_MESSAGE_TYPE"], "ACTIVE" => "Y");
		$arEvents = Array();
		$obEventMessage = CEventMessage::GetList($by="ID", $order="DESC", $arEventFilter);
		while($arEventMessage = $obEventMessage->GetNext()):
			$arEvents[$arEventMessage["ID"]] = "[".$arEventMessage["ID"]."] ".$arEventMessage["SUBJECT"];
		endwhile;
	endif;
endif;

if($SaleModuleInc):
	$arOrderPropertyViewType = array(
		"VALUE"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_VALUE"),
		"SELECT"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_SELECT"),
		"FORM_SELECT"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_FORM_SELECT"),
	);
else:

	$arOrderPropertyViewType = array(
			"VALUE"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_VALUE"),
			"SELECT"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_SELECT"),
	);

	$arOrderCurrencyPropertyViewType = array(
			"VALUE"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_VALUE"),
			"SELECT"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_SELECT"),
			"IB_PROPERTY_VALUE"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_IB_PROPERTY_VALUE"),
	);

	$arOrderPricePropertyViewType = array(
			"VALUE"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_VALUE"),
			"IB_PROPERTY_VALUE"=> GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE_IB_PROPERTY_VALUE"),
	);

endif;

$arPropertyFields = array();
if( !isset($arCurrentValues["BUY_ALL_BASKET"]) || empty($arCurrentValues["BUY_ALL_BASKET"]) || $arCurrentValues["BUY_ALL_BASKET"] != "Y" ):
	$arPropertyFields[] = array(
		"CODE" => "PRODUCT_QUANTITY",
		"NAME" => GetMessage("KOCB_FIELD_PRODUCT_QUANTITY_TITLE"),
		"ORDER_PROPERTY_CODE" => "",
		"TYPE" => "INTEGER",
		"VALIDATOR" => "",
	);
endif;
$arPropertyFields[] = array(
	"CODE" => "NAME",
	"NAME" => GetMessage("KOCB_FIELD_NAME_TITLE"),
	"ORDER_PROPERTY" => "Y",
	"ORDER_PROPERTY_CODE" => "FIO",
	"TYPE" => "STRING",
	"VALIDATOR" => "",
);
$arPropertyFields[] = array(
	"CODE" => "PHONE",
	"NAME" => GetMessage("KOCB_FIELD_PHONE_TITLE"),
	"ORDER_PROPERTY" => "Y",
	"ORDER_PROPERTY_CODE" => "PHONE",
	"TYPE" => "STRING",
	"VALIDATOR" => "PHONE",
);
$arPropertyFields[] = array(
	"CODE" => "EMAIL",
	"NAME" => GetMessage("KOCB_FIELD_EMAIL_TITLE"),
	"ORDER_PROPERTY" => "Y",
	"ORDER_PROPERTY_CODE" => "EMAIL",
	"TYPE" => "STRING",
	"VALIDATOR" => "EMAIL",
);
$arPropertyFields[] = array(
	"CODE" => "ADDRESS",
	"NAME" => GetMessage("KOCB_FIELD_ADDRESS_TITLE"),
	"ORDER_PROPERTY" => "Y",
	"ORDER_PROPERTY_CODE" => "ADDRESS",
	"TYPE" => "STRING",
	"VALIDATOR" => "",
);
$arPropertyFields[] = array(
	"CODE" => "COMMENT",
	"NAME" => GetMessage("KOCB_FIELD_COMMENT_TITLE"),
	"ORDER_FIELD" => "Y",
	"ORDER_FIELD_CODE" => "USER_DESCRIPTION",
	"TYPE" => "STRING",
	"VALIDATOR" => "",
);


$arPropertyFieldList = array();
foreach($arPropertyFields as $arPropertyField):
	$arPropertyFieldList[$arPropertyField["CODE"]] = $arPropertyField["NAME"];
endforeach;

$arSaveIBList = Array();
if( $IBlockModuleInc && $arCurrentValues["SAVE_TO"] == "IBLOCK" ):

	$arSaveIBTypes = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

	$resSIB = CIBlock::GetList(
			Array(),
			Array(
					'TYPE'=>$arCurrentValues["SAVE_TO_IB_TYPE"]!="-"?$arCurrentValues["SAVE_TO_IB_TYPE"]:"",
				//'SITE_ID'=>$site,
					'ACTIVE'=>'Y',
			), true
	);
	while($arSIB = $resSIB->Fetch())
	{
		$arSaveIBList[$arSIB['ID']] = '['.$arSIB['ID'].'] '.$arSIB['NAME'];
	}

endif;


$arSaveHLBlockList = Array();
if( $HLBlockModuleInc && $arCurrentValues["SAVE_TO"] == "HLBLOCK" ):
	$HLBlockList = Bitrix\Highloadblock\HighloadBlockTable::getList()->fetchAll();
	foreach($HLBlockList as $arHLBlock):
		$arSaveHLBlockList[$arHLBlock["ID"]] = $arHLBlock["NAME"];
	endforeach;
endif;


if($SaleModuleInc):

	$arSystemPersonTypeList = COneClickBuy::getSystemPersonTypeList();

	$arSystemDeliveryList = COneClickBuy::getSystemDeliveryList();

	$arSystemPaySystemList = COneClickBuy::getSystemPaySystemList();

	$arOrderPropertyList = COneClickBuy::getOrderPropertyList($arCurrentValues["PERSON_TYPE_ID"]);

endif;

$arOrderStatusList = COneClickBuy::getOrderStatusList();

$arSystemCurrencyList = COneClickBuy::getSystemCurrencyList();

$arFieldTypes = Array();
$arFieldTypesList = Array();
$arFieldTypes['text'] = 'text';
$arFieldTypes['hidden'] = 'hidden';

$arComponentParameters = array(
		"GROUPS" => array(
				"MAIN_SETTINGS" => array(
						"NAME" => GetMessage("KOCB_MAIN_SETTINGS"),
				),
		)
);

if( $arCurrentValues["USE_CAPTCHA"] == "Y" ):
	$arComponentParameters["GROUPS"]["RECAPTCHA"] = array("NAME" => GetMessage("KOCB_RECAPTCHA_GROUP_TITLE") );
endif;

if( $arCurrentValues["USE_USER_CONSENT"] == "Y" ):
	$arComponentParameters["GROUPS"]["USER_CONSENT"] = array("NAME" => GetMessage("KOCB_USER_CONSENT_GROUP_TITLE") );
endif;

$arComponentParameters["GROUPS"]["ORDER_PROPERTY"] = array("NAME" => GetMessage("KOCB_ORDER_PROPERTY_GROUP_TITLE") );
$arComponentParameters["GROUPS"]["SAVE_TO_SETTINGS"] = array("NAME" => GetMessage("KOCB_SAVE_TO_SETTINGS_GROUP_TITLE") );

if( $arCurrentValues["SET_YANDEX_METRIKA_GOAL"] == "Y" ):
	$arComponentParameters["GROUPS"]["YANDEX_METRIKA_GOAL"] = array("NAME" => GetMessage("KOCB_YANDEX_METRIKA_GOAL_GROUP_TITLE") );
endif;

if( is_array($arCurrentValues["USE_FIELDS"]) && count($arCurrentValues["USE_FIELDS"]) > 0 ):
	foreach ( $arPropertyFieldList as $FieldKey=>$FieldName):
		if(in_array($FieldKey, $arCurrentValues["USE_FIELDS"])):
			$arComponentParameters["GROUPS"]["FIELDS_SETTINGS_".$FieldKey] = array("NAME" => GetMessage("KOCB_FIELDS_SETTINGS_N")."[ ".$FieldKey." ] ".$FieldName );
		endif;
	endforeach;
endif;

$arComponentParameters["PARAMETERS"] = array(
		"AJAX_MODE" => array(),
);


if( !isset($arCurrentValues["BUY_ALL_BASKET"]) || empty($arCurrentValues["BUY_ALL_BASKET"]) || $arCurrentValues["BUY_ALL_BASKET"] != "Y" ):
	$arComponentParameters["PARAMETERS"]["PRODUCT_ID"] = array(
			"NAME" => GetMessage("KOCB_PRODUCT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["PRODUCT_ID"]}',
			"PARENT" => "ORDER_PROPERTY",
	);
endif;

// PERSON_TYPE
if($SaleModuleInc):
	$arComponentParameters["PARAMETERS"]["PERSON_TYPE_VIEWTYPE"] = array(
			"NAME" => GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE")." - ".GetMessage("KOCB_PERSON_TYPE_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arOrderPropertyViewType,
			"DEFAULT" => "VALUE",
			"PARENT" => "ORDER_PROPERTY",
			"REFRESH" => "Y",
	);

	if($arCurrentValues["PERSON_TYPE_VIEWTYPE"] == "VALUE" ):
		$arComponentParameters["PARAMETERS"]["PERSON_TYPE_ID"] = array(
				"NAME" => GetMessage("KOCB_PERSON_TYPE_ID"),
				"TYPE" => "STRING",
				"DEFAULT" => '={$_REQUEST["PERSON_TYPE_ID"]}',
				"PARENT" => "ORDER_PROPERTY",
		);
	elseif($arCurrentValues["PERSON_TYPE_VIEWTYPE"] == "SELECT" ):
		$arComponentParameters["PARAMETERS"]["PERSON_TYPE_ID"] = array(
				"NAME" => GetMessage("KOCB_PERSON_TYPE_ID"),
				"TYPE"=>"LIST",
				"VALUES" => $arSystemPersonTypeList,
				"DEFAULT"=>"",
				"PARENT" => "ORDER_PROPERTY",
				"REFRESH" => "N",
		);
	endif;

endif;


// DELIVERY

if($SaleModuleInc):
	$arComponentParameters["PARAMETERS"]["DELIVERY_VIEWTYPE"] = array(
			"NAME" => GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE")." - ".GetMessage("KOCB_DELIVERY_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arOrderPropertyViewType,
			"DEFAULT" => "VALUE",
			"PARENT" => "ORDER_PROPERTY",
			"REFRESH" => "Y",
	);

	if($arCurrentValues["DELIVERY_VIEWTYPE"] == "VALUE" ):
		$arComponentParameters["PARAMETERS"]["DELIVERY_ID"] = array(
				"NAME" => GetMessage("KOCB_DELIVERY_ID"),
				"TYPE" => "STRING",
				"DEFAULT" => '={$_REQUEST["DELIVERY_ID"]}',
				"PARENT" => "ORDER_PROPERTY",
		);
	elseif($arCurrentValues["DELIVERY_VIEWTYPE"] == "SELECT" ):
		$arComponentParameters["PARAMETERS"]["DELIVERY_ID"] = array(
				"NAME" => GetMessage("KOCB_DELIVERY_ID"),
				"TYPE"=>"LIST",
				"VALUES" => $arSystemDeliveryList,
				"DEFAULT"=>"",
				"PARENT" => "ORDER_PROPERTY",
				"REFRESH" => "N",
		);
	endif;

endif;


// PAY_SYSTEM

if($SaleModuleInc):
	$arComponentParameters["PARAMETERS"]["PAY_SYSTEM_VIEWTYPE"] = array(
			"NAME" => GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE")." - ".GetMessage("KOCB_PAY_SYSTEM_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arOrderPropertyViewType,
			"DEFAULT" => "VALUE",
			"PARENT" => "ORDER_PROPERTY",
			"REFRESH" => "Y",
	);

	if($arCurrentValues["PAY_SYSTEM_VIEWTYPE"] == "VALUE" ):
		$arComponentParameters["PARAMETERS"]["PAY_SYSTEM_ID"] = array(
				"NAME" => GetMessage("KOCB_PAY_SYSTEM_ID"),
				"TYPE" => "STRING",
				"DEFAULT" => '={$_REQUEST["PAY_SYSTEM_ID"]}',
				"PARENT" => "ORDER_PROPERTY",
		);
	elseif($arCurrentValues["PAY_SYSTEM_VIEWTYPE"] == "SELECT" ):
		$arComponentParameters["PARAMETERS"]["PAY_SYSTEM_ID"] = array(
				"NAME" => GetMessage("KOCB_PAY_SYSTEM_ID"),
				"TYPE"=>"LIST",
				"VALUES" => $arSystemPaySystemList,
				"DEFAULT"=>"",
				"PARENT" => "ORDER_PROPERTY",
				"REFRESH" => "N",
		);
	endif;

endif;



// PRICE

if(!$SaleModuleInc):
	$arComponentParameters["PARAMETERS"]["PRODUCT_PRICE_VIEWTYPE"] = array(
			"NAME" => GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE")." - ".GetMessage("KOCB_PRODUCT_PRICE"),
			"TYPE" => "LIST",
			"VALUES" => $arOrderPricePropertyViewType,
			"DEFAULT" => "VALUE",
			"PARENT" => "ORDER_PROPERTY",
			"REFRESH" => "Y",
	);

	if($arCurrentValues["PRODUCT_PRICE_VIEWTYPE"] == "VALUE" ):
		$arComponentParameters["PARAMETERS"]["PRICE"] = array(
				"NAME" => GetMessage("KOCB_PRODUCT_PRICE"),
				"TYPE" => "STRING",
				"DEFAULT" => '={$_REQUEST["PRICE"]}',
				"PARENT" => "ORDER_PROPERTY",
		);
	elseif($arCurrentValues["PRODUCT_PRICE_VIEWTYPE"] == "IB_PROPERTY_VALUE" ):
		$arComponentParameters["PARAMETERS"]["PRICE_IB_PROPERTY_CODE"] = array(
				"NAME" => GetMessage("KOCB_PRODUCT_PRICE_IB_PROPERTY_CODE"),
				"TYPE" => "STRING",
				"DEFAULT" => "",
				"PARENT" => "ORDER_PROPERTY",
				"REFRESH" => "N",
		);
	endif;
endif;

// CURRENCY


	$arComponentParameters["PARAMETERS"]["CURRENCY_VIEWTYPE"] = array(
			"NAME" => GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE")." - ".GetMessage("KOCB_ORDER_CURRENCY"),
			"TYPE" => "LIST",
			"VALUES" => $arOrderCurrencyPropertyViewType,
			"DEFAULT" => "VALUE",
			"PARENT" => "ORDER_PROPERTY",
			"REFRESH" => "Y",
	);

	if($arCurrentValues["CURRENCY_VIEWTYPE"] == "VALUE" ):
		$arComponentParameters["PARAMETERS"]["CURRENCY"] = array(
				"NAME" => GetMessage("KOCB_ORDER_CURRENCY"),
				"TYPE" => "STRING",
				"DEFAULT" => '={$_REQUEST["CURRENCY"]}',
				"PARENT" => "ORDER_PROPERTY",
		);
	elseif($arCurrentValues["CURRENCY_VIEWTYPE"] == "SELECT" ):

		if($CurrencyModuleInc):
			$CurrencyID = Bitrix\Main\Config\Option::get('sale', 'default_currency', 'RUB');
		else:
			$CurrencyID = "RUB";
		endif;

		$arComponentParameters["PARAMETERS"]["CURRENCY"] = array(
				"NAME" => GetMessage("KOCB_ORDER_CURRENCY"),
				"TYPE"=>"LIST",
				"VALUES" => $arSystemCurrencyList,
				"DEFAULT"=> $CurrencyID,
				"PARENT" => "ORDER_PROPERTY",
				"REFRESH" => "N",
		);
	elseif($arCurrentValues["CURRENCY_VIEWTYPE"] == "IB_PROPERTY_VALUE" ):
		$arComponentParameters["PARAMETERS"]["CURRENCY_IB_PROPERTY_CODE"] = array(
				"NAME" => GetMessage("KOCB_CURRENCY_IB_PROPERTY_CODE"),
				"TYPE" => "STRING",
				"DEFAULT" => "",
				"PARENT" => "ORDER_PROPERTY",
				"REFRESH" => "N",
		);
	endif;

	$arComponentParameters["PARAMETERS"]["ORDER_STATUS_VIEWTYPE"] = array(
			"NAME" => GetMessage("KOCB_ORDER_PROPERTY_VIEW_TYPE")." - ".GetMessage("KOCB_ORDER_STATUS_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arOrderPropertyViewType,
			"DEFAULT" => "VALUE",
			"PARENT" => "ORDER_PROPERTY",
			"REFRESH" => "Y",
	);

	if($arCurrentValues["ORDER_STATUS_VIEWTYPE"] == "VALUE" ):
		$arComponentParameters["PARAMETERS"]["ORDER_STATUS_ID"] = array(
				"NAME" => GetMessage("KOCB_ORDER_STATUS_ID"),
				"TYPE" => "STRING",
				"DEFAULT" => '={$_REQUEST["ORDER_STATUS_ID"]}',
				"PARENT" => "ORDER_PROPERTY",
		);
	elseif($arCurrentValues["ORDER_STATUS_VIEWTYPE"] == "SELECT" ):
		$arComponentParameters["PARAMETERS"]["ORDER_STATUS_ID"] = array(
				"NAME" => GetMessage("KOCB_ORDER_STATUS_ID"),
				"TYPE"=>"LIST",
				"VALUES" => $arOrderStatusList,
				"DEFAULT"=> "N", //вз¤ть из настроек модул¤ sale с каким статусом заказа оформл¤ть заказ
				"PARENT" => "ORDER_PROPERTY",
				"REFRESH" => "N",
		);
	endif;


$arComponentParameters["PARAMETERS"]["ORDER_COMMENT"] = array(
		"NAME" => GetMessage("KOCB_ORDER_COMMENT"),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage("KOCB_ORDER_COMMENT_DEFAULT_VALUE"),
		"PARENT" => "ORDER_PROPERTY",
);

$arComponentParameters["PARAMETERS"]["FORM_ID"] = array(
		"NAME" => GetMessage("KOCB_FORM_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyz',3)),0,20),
		"PARENT" => "MAIN_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["FORM_TITLE"] = array(
		"NAME" => GetMessage("KOCB_FORM_TITLE"),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage("KOCB_FORM_TITLE_DEFAULT"),
		"PARENT" => "MAIN_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["USE_CAPTCHA"] = array(
		"NAME" => GetMessage("KOCB_CAPTCHA"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"PARENT" => "MAIN_SETTINGS",
		"REFRESH" => "Y",
);

if( $arCurrentValues["USE_CAPTCHA"] == "Y" ):
	$arComponentParameters["PARAMETERS"]["USE_RECAPTCHA"] = array(
			"NAME" => GetMessage("KOCB_USE_RECAPTCHA"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "MAIN_SETTINGS",
			"REFRESH" => "Y",
	);
	$arComponentParameters["PARAMETERS"]["DISABLE_AUTH_CAPTCHA"] = array(
			"NAME" => GetMessage("KOCB_DISABLE_AUTH_CAPTCHA"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "MAIN_SETTINGS",
			"REFRESH" => "N",
	);
endif;

$arComponentParameters["PARAMETERS"]["SUBMIT_TITLE"] = array(
		"NAME" => GetMessage("KOCB_SUBMIT"),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage("KOCB_SUBMIT_TITLE"),
		"PARENT" => "MAIN_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["SUCCESS_TEXT"] = array(
		"NAME" => GetMessage("KOCB_SUCCESS_MESSAGE"),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage("KOCB_SUCCESS_TEXT"),
		"PARENT" => "MAIN_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["EMAIL_TO"] = array(
		"NAME" => GetMessage("KOCB_EMAIL_TO"),
		"TYPE" => "STRING",
		"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")),
		"PARENT" => "MAIN_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["EVENT_MESSAGE_TYPE"] = array(
		"NAME" => GetMessage("KOCB_EMAIL_TYPES"),
		"TYPE"=>"LIST",
		"VALUES" => $arEventTypes,
		"DEFAULT"=>"KREATTIKA_SALE_ONE_CLICK_BUY",
		"PARENT" => "MAIN_SETTINGS",
		"REFRESH" => "Y",
);

$arComponentParameters["PARAMETERS"]["EVENT_MESSAGE_ID"] = array(
		"NAME" => GetMessage("KOCB_EMAIL_TEMPLATES"),
		"TYPE"=>"LIST",
		"VALUES" => $arEvents,
		"DEFAULT"=>"",
		"MULTIPLE"=>"Y",
		"COLS"=>25,
		"PARENT" => "MAIN_SETTINGS",
);

$arComponentParameters["PARAMETERS"]["USE_FIELDS"] = array(
		"NAME" => GetMessage("KOCB_USE_FIELDS"),
		"TYPE"=>"LIST",
		"VALUES" => $arPropertyFieldList,
		"DEFAULT"=> "", //array("NAME", "PHONE", "EMAIL"),
		"MULTIPLE"=>"Y",
		"COLS"=>25,
		"PARENT" => "MAIN_SETTINGS",
		"REFRESH" => "Y",
);


$arComponentParameters["PARAMETERS"]["SHOW_ERRORS"] = array(
		"NAME" => GetMessage("KOCB_SHOW_ERRORS"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"PARENT" => "MAIN_SETTINGS",
);

if($SaleModuleInc):
	$arComponentParameters["PARAMETERS"]["BUY_ALL_BASKET"] = array(
			"NAME" => GetMessage("KOCB_BUY_ALL_BASKET"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'N',
			"PARENT" => "ORDER_PROPERTY",
			"REFRESH" => "Y",
	);
endif;

if( !isset($arCurrentValues["BUY_ALL_BASKET"]) || empty($arCurrentValues["BUY_ALL_BASKET"]) || $arCurrentValues["BUY_ALL_BASKET"] != "Y" ):
	if(is_array($arCurrentValues["USE_FIELDS"])):
		if(!in_array("PRODUCT_QUANTITY", $arCurrentValues["USE_FIELDS"])):
			$arComponentParameters["PARAMETERS"]["PRODUCT_QUANTITY_DEFAULT_VALUE"] = array(
					"NAME" => GetMessage("KOCB_FIELD_PRODUCT_QUANTITY_TITLE"),
					"TYPE" => "STRING",
					"DEFAULT" => '={$_REQUEST["PRODUCT_QUANTITY"]}',
					"PARENT" => "ORDER_PROPERTY",
			);

			if($SaleModuleInc):


				$arComponentParameters["PARAMETERS"]["PRODUCT_QUANTITY_CHECK_STORE"] = array(
						"NAME" => GetMessage("KOCB_FIELD_PRODUCT_QUANTITY_CHECK_STORE_TITLE"),
						"TYPE" => "CHECKBOX",
						"DEFAULT" => 'N',
						"PARENT" => "ORDER_PROPERTY",
				);
			endif;
		endif;
	endif;
endif;

$arUserConsentDef = array(
		"Y" => GetMessage("KOCB_DEF_USER_CONSENT_IS_CHECKED_Y"),
		"N" => GetMessage("KOCB_DEF_USER_CONSENT_IS_CHECKED_N")
);
$arComponentParameters["PARAMETERS"]["USE_USER_CONSENT"] = array(
		"NAME" => GetMessage("KOCB_USE_USER_CONSENT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"PARENT" => "MAIN_SETTINGS",
		"REFRESH" => "Y",
);
if( $arCurrentValues["USE_USER_CONSENT"] == "Y" ):
	$arComponentParameters["PARAMETERS"]["DEF_USER_CONSENT_IS_CHECKED"] = array(
			"NAME" => GetMessage("KOCB_DEF_USER_CONSENT_IS_CHECKED"),
			"TYPE" => "LIST",
			"VALUES" => $arUserConsentDef,
			"PARENT" => "USER_CONSENT",
			"REFRESH" => "N",
	);
	$arComponentParameters["PARAMETERS"]["USER_CONSENT_TEXT"] = array(
			"PARENT" => "USER_CONSENT",
			"NAME" => GetMessage("KOCB_USER_CONSENT_TEXT"),
			"TYPE" => "STRING",
			"VALUES" => "",
			"DEFAULT" => GetMessage("KOCB_USER_CONSENT_TEXT_VALUE"),
	);
	$arComponentParameters["PARAMETERS"]["USER_CONSENT_LINK_TEXT"] = array(
			"PARENT" => "USER_CONSENT",
			"NAME" => GetMessage("KOCB_USER_CONSENT_LINK_TEXT"),
			"TYPE" => "STRING",
			"VALUES" => "",
			"DEFAULT" => GetMessage("KOCB_USER_CONSENT_LINK_TEXT_VALUE"),
	);
	$arComponentParameters["PARAMETERS"]["USER_CONSENT_LINK"] = array(
			"PARENT" => "USER_CONSENT",
			"NAME" => GetMessage("KOCB_USER_CONSENT_LINK"),
			"TYPE" => "STRING",
			"VALUES" => "",
			"DEFAULT" => "/user_consent.php",
	);
endif;

$arRecaptchaTheme = array(
		"light" => GetMessage("KOCB_RECAPTCHA_THEME_LIGHT"),
		"dark" => GetMessage("KOCB_RECAPTCHA_THEME_DARK")
);
$arRecaptchaLang = array(
		"AUTO" => GetMessage("KOCB_RECAPTCHA_LANG_AUTO"),
		"SITE" => GetMessage("KOCB_RECAPTCHA_LANG_FROM_SITE"),
		"ru" => GetMessage("KOCB_RECAPTCHA_LANG_RU"),
		"en" => GetMessage("KOCB_RECAPTCHA_LANG_EN"),
		"az" => GetMessage("KOCB_RECAPTCHA_LANG_AZ"),
		"uk" => GetMessage("KOCB_RECAPTCHA_LANG_UK"),
);

$arRecaptchaType = array(
		"image" => GetMessage("KOCB_RECAPTCHA_TYPE_IMAGE"),
		"audio" => GetMessage("KOCB_RECAPTCHA_TYPE_AUDIO")
);
$arRecaptchaSize = array(
		"normal" => GetMessage("KOCB_RECAPTCHA_SIZE_NORMAL"),
		"compact" => GetMessage("KOCB_RECAPTCHA_SIZE_COMPACT")
);

if( $arCurrentValues["USE_CAPTCHA"] == "Y" && $arCurrentValues["USE_RECAPTCHA"] == "Y" ):
	$arComponentParameters["PARAMETERS"]["RECAPTCHA_PUBLIC"] = array(
			"PARENT" => "RECAPTCHA",
			"NAME" => GetMessage("KOCB_RECAPTCHA_PUBLIC"),
			"TYPE" => "STRING",
			"VALUES" => "",
			"DEFAULT" => "",
	);
	$arComponentParameters["PARAMETERS"]["RECAPCHA_PRIVATE"] = array(
			"PARENT" => "RECAPTCHA",
			"NAME" => GetMessage("KOCB_RECAPTCHA_PRIVATE"),
			"TYPE" => "STRING",
			"VALUES" => "",
			"DEFAULT" => "",
	);
	$arComponentParameters["PARAMETERS"]["RECAPTCHA_THEME"] = array(
			"NAME" => GetMessage("KOCB_RECAPTCHA_THEME"),
			"TYPE" => "LIST",
			"VALUES" => $arRecaptchaTheme,
			"PARENT" => "RECAPTCHA",
			"REFRESH" => "N",
	);
	$arComponentParameters["PARAMETERS"]["RECAPTCHA_TYPE"] = array(
			"NAME" => GetMessage("KOCB_RECAPTCHA_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arRecaptchaType,
			"PARENT" => "RECAPTCHA",
			"REFRESH" => "N",
	);
	$arComponentParameters["PARAMETERS"]["RECAPTCHA_SIZE"] = array(
			"NAME" => GetMessage("KOCB_RECAPTCHA_SIZE"),
			"TYPE" => "LIST",
			"VALUES" => $arRecaptchaSize,
			"PARENT" => "RECAPTCHA",
			"REFRESH" => "N",
	);
	$arComponentParameters["PARAMETERS"]["RECAPTCHA_LANG"] = array(
			"NAME" => GetMessage("KOCB_RECAPTCHA_LANG"),
			"TYPE" => "LIST",
			"VALUES" => $arRecaptchaLang,
			"PARENT" => "RECAPTCHA",
			"REFRESH" => "N",
	);
endif;

if(!$SaleModuleInc):
	$arSaveTo = array(
			"N"=>GetMessage("KOCB_SAVE_TO_N"),
			"ENTITY"=>GetMessage("KOCB_SAVE_TO_ENTITY"),
			"IBLOCK"=>GetMessage("KOCB_SAVE_TO_IBLOCK"),
			"HLBLOCK"=>GetMessage("KOCB_SAVE_TO_HLBLOCK"),
	);

	$arComponentParameters["PARAMETERS"]["SAVE_TO"] = array(
			"NAME" => GetMessage("KOCB_SAVE_TO"),
			"TYPE" => "LIST",
			"VALUES" => $arSaveTo,
			"PARENT" => "SAVE_TO_SETTINGS",
			"REFRESH" => "Y",
			"DEFAULT" => "N",
	);
endif;


if( isset($arCurrentValues["SAVE_TO"]) && !empty($arCurrentValues["SAVE_TO"]) && $arCurrentValues["SAVE_TO"] != "N" ):
	$arComponentParameters["PARAMETERS"]["SAVE_TO_REQUEST_PATH"] = array(
			"PARENT" => "SAVE_TO_SETTINGS",
			"NAME" => GetMessage("KOCB_SAVE_TO_REQUEST_PATH"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
	);
	$arComponentParameters["PARAMETERS"]["SAVE_TO_REQUEST_REFERER"] = array(
			"PARENT" => "SAVE_TO_SETTINGS",
			"NAME" => GetMessage("KOCB_SAVE_TO_REQUEST_REFERER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
	);
	$arComponentParameters["PARAMETERS"]["SAVE_TO_REQUEST_IP"] = array(
			"PARENT" => "SAVE_TO_SETTINGS",
			"NAME" => GetMessage("KOCB_SAVE_TO_REQUEST_IP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
	);
endif;

if( $arCurrentValues["SAVE_TO"]=="IBLOCK" ):
	$arComponentParameters["PARAMETERS"]["SAVE_TO_IB_TYPE"] = array(
			"PARENT" => "SAVE_TO_SETTINGS",
			"NAME" => GetMessage("KOCB_SAVE_TO_IB_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arSaveIBTypes,
			"REFRESH" => "Y",
	);
	$arComponentParameters["PARAMETERS"]["SAVE_TO_IB_ID"] = array(
			"PARENT" => "SAVE_TO_SETTINGS",
			"NAME" => GetMessage("KOCB_SAVE_TO_IB_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arSaveIBList,
			"REFRESH" => "Y",
	);
	$arComponentParameters["PARAMETERS"]["SAVE_TO_IB_ELEMENT_NAME"] = array(
			"PARENT" => "SAVE_TO_SETTINGS",
			"NAME" => GetMessage("KOCB_SAVE_TO_IB_ELEMENT_NAME_TITLE"),
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("KOCB_SAVE_TO_IB_ELEMENT_NAME"),
	);
elseif( $arCurrentValues["SAVE_TO"]=="HLBLOCK" ):
	$arComponentParameters["PARAMETERS"]["SAVE_TO_HLBLOCK_ID"] = array(
			"PARENT" => "SAVE_TO_SETTINGS",
			"NAME" => GetMessage("KOCB_SAVE_TO_HLBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arSaveHLBlockList,
			"REFRESH" => "Y",
	);
endif;

if( is_array($arCurrentValues["USE_FIELDS"]) && count($arCurrentValues["USE_FIELDS"]) > 0 ):
	foreach ( $arPropertyFields as $arPropertyField):
		if(in_array($arPropertyField["CODE"], $arCurrentValues["USE_FIELDS"])):

			$arComponentParameters["PARAMETERS"]["FIELD_".$arPropertyField["CODE"]."_LABEL"] = array(
					"PARENT" => "FIELDS_SETTINGS_".$arPropertyField["CODE"],
					"NAME" => GetMessage("KOCB_FIELD_TITLE")."[ ".$arPropertyField["CODE"]." ] ".$arPropertyField["NAME"],
					"TYPE" => "STRING",
					"DEFAULT" => $arPropertyField["NAME"],
			);

			$arComponentParameters["PARAMETERS"]["FIELD_".$arPropertyField["CODE"]."_PLACEHOLDER"] = array(
					"PARENT" => "FIELDS_SETTINGS_".$arPropertyField["CODE"],
					"NAME" => GetMessage("KOCB_FIELD_PLACEHOLDER")."[ ".$arPropertyField["CODE"]." ] ".$arPropertyField["NAME"],
					"TYPE" => "STRING",
					"DEFAULT" => $arPropertyField["NAME"],
			);

			$arComponentParameters["PARAMETERS"]["FIELD_".$arPropertyField["CODE"]."_CHECK"] = array(
					"PARENT" => "FIELDS_SETTINGS_".$arPropertyField["CODE"],
					"NAME" => GetMessage("KOCB_CHECK_FIELD")."[ ".$arPropertyField["CODE"]." ] ".$arPropertyField["NAME"],
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",
			);


				if($arPropertyField["CODE"] == "PRODUCT_QUANTITY"):
					$arComponentParameters["PARAMETERS"]["FIELD_".$arPropertyField["CODE"]."_VALUE"] = array(
							"PARENT" => "FIELDS_SETTINGS_".$arPropertyField["CODE"],
							"NAME" => GetMessage("KOCB_FIELD_VALUE")."[ ".$arPropertyField["CODE"]." ] ".$arPropertyField["NAME"],
							"TYPE" => "STRING",
							"DEFAULT" => "1",
					);


					$arComponentParameters["PARAMETERS"]["PRODUCT_QUANTITY_CHECK_STORE"] = array(
							"NAME" => GetMessage("KOCB_FIELD_PRODUCT_QUANTITY_CHECK_STORE_TITLE"),
							"TYPE" => "CHECKBOX",
							"DEFAULT" => 'N',
							"PARENT" => "FIELDS_SETTINGS_".$arPropertyField["CODE"],
					);
				elseif($SaleModuleInc):
					if( $arPropertyField["ORDER_PROPERTY"] == "Y" ):
						$arComponentParameters["PARAMETERS"]["FIELD_".$arPropertyField["CODE"]."_LINK_ORDER_PROPERTY"] = array(
							"PARENT" => "FIELDS_SETTINGS_".$arPropertyField["CODE"],
							"NAME" => GetMessage("KOCB_FIELD_SAVE_VALUE_TO_LINK_ORDER_PROPERTY"),
							"TYPE" => "LIST",
							"VALUES" => $arOrderPropertyList,
							"DEFAULT" => $arPropertyField["ORDER_PROPERTY_CODE"],
						);
					endif;
				endif;

		endif;
	endforeach;
endif;

$arComponentParameters["PARAMETERS"]["SET_YANDEX_METRIKA_GOAL"] = array(
		"NAME" => GetMessage("KOCB_SET_YANDEX_METRIKA_GOAL"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"PARENT" => "MAIN_SETTINGS",
		"REFRESH" => "Y",
);

if( $arCurrentValues["SET_YANDEX_METRIKA_GOAL"] == "Y" ):

	$arYandexMetrikaViewType = array(
			"ONSUBMIT" => GetMessage("KOCB_YANDEX_METRIKA_VIEW_ONSUBMIT"),
			"ONCLICK"  => GetMessage("KOCB_YANDEX_METRIKA_VIEW_ONCLICK"),
			"SUCCESS"  => GetMessage("KOCB_YANDEX_METRIKA_VIEW_SUCCESS"),
	);

	$arComponentParameters["PARAMETERS"]["YANDEX_METRIKA_VIEW_TYPE"] = array(
			"NAME" => GetMessage("KOCB_YANDEX_METRIKA_VIEW_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arYandexMetrikaViewType,
			"PARENT" => "YANDEX_METRIKA_GOAL",
			"REFRESH" => "N",
			"DEFAULT" => "ONSUBMIT",
	);
	$arComponentParameters["PARAMETERS"]["YANDEX_METRIKA_COUNTER_ID"] = array(
			"PARENT" => "YANDEX_METRIKA_GOAL",
			"NAME" => GetMessage("KOCB_YANDEX_METRIKA_COUNTER_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
	);
	$arComponentParameters["PARAMETERS"]["YANDEX_METRIKA_GOAL_ID"] = array(
			"PARENT" => "YANDEX_METRIKA_GOAL",
			"NAME" => GetMessage("KOCB_YANDEX_METRIKA_GOAL_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
	);
endif;


$KBX24LeadModuleInc = CModule::IncludeModuleEx("kreattika.bx24lead");

if ( $KBX24LeadModuleInc == 1 || $KBX24LeadModuleInc == 2 ):

	$arBX24Fields = array(
			'NONE' => 				GetMessage("KOCB_BX24_FIELD_NONE"),
			'TITLE' => 				GetMessage("KOCB_BX24_FIELD_TITLE"),
			'COMPANY_TITLE' => 		GetMessage("KOCB_BX24_FIELD_COMPANY_TITLE"),
			'NAME' => 				GetMessage("KOCB_BX24_FIELD_NAME"),
			'LAST_NAME' => 			GetMessage("KOCB_BX24_FIELD_LAST_NAME"),
			'SECOND_NAME' => 		GetMessage("KOCB_BX24_FIELD_SECOND_NAME"),
			'POST' => 				GetMessage("KOCB_BX24_FIELD_POST"),
			'ADDRESS' => 			GetMessage("KOCB_BX24_FIELD_ADDRESS"),
			'COMMENTS' => 			GetMessage("KOCB_BX24_FIELD_COMMENTS"),
			'SOURCE_DESCRIPTION' => GetMessage("KOCB_BX24_FIELD_SOURCE_DESCRIPTION"),
			'STATUS_DESCRIPTION' => GetMessage("KOCB_BX24_FIELD_STATUS_DESCRIPTION"),
			'OPPORTINUTY' => 		GetMessage("KOCB_BX24_FIELD_OPPORTINUTY"),
			'CURRENCY_ID' => 		GetMessage("KOCB_BX24_FIELD_CURRENCY_ID"),
			'PRODUCT_ID' => 		GetMessage("KOCB_BX24_FIELD_PRODUCT_ID"),
			'SOURCE_ID' => 			GetMessage("KOCB_BX24_FIELD_SOURCE_ID"),
			'STATUS_ID' => 			GetMessage("KOCB_BX24_FIELD_STATUS_ID"),
			'ASSIGNED_BY_ID' => 	GetMessage("KOCB_BX24_FIELD_ASSIGNED_BY_ID"),
			'PHONE_WORK' => 		GetMessage("KOCB_BX24_FIELD_PHONE_WORK"),
			'PHONE_MOBILE' => 		GetMessage("KOCB_BX24_FIELD_PHONE_MOBILE"),
			'PHONE_FAX' => 			GetMessage("KOCB_BX24_FIELD_PHONE_FAX"),
			'PHONE_HOME' => 		GetMessage("KOCB_BX24_FIELD_PHONE_HOME"),
			'PHONE_OTHER' => 		GetMessage("KOCB_BX24_FIELD_PHONE_OTHER"),
			'WEB_WORK' => 			GetMessage("KOCB_BX24_FIELD_WEB_WORK"),
			'WEB_HOME' => 			GetMessage("KOCB_BX24_FIELD_WEB_HOME"),
			'WEB_FACEBOOK' => 		GetMessage("KOCB_BX24_FIELD_WEB_FACEBOOK"),
			'WEB_LIVEJOURNAL' => 	GetMessage("KOCB_BX24_FIELD_WEB_LIVEJOURNAL"),
			'WEB_TWITTER' => 		GetMessage("KOCB_BX24_FIELD_WEB_TWITTER"),
			'WEB_OTHER' => 			GetMessage("KOCB_BX24_FIELD_WEB_OTHER"),
			'EMAIL_WORK' => 		GetMessage("KOCB_BX24_FIELD_EMAIL_WORK"),
			'EMAIL_HOME' => 		GetMessage("KOCB_BX24_FIELD_EMAIL_HOME"),
			'EMAIL_OTHER' => 		GetMessage("KOCB_BX24_FIELD_EMAIL_OTHER"),
			'IM_SKYPE' => 			GetMessage("KOCB_BX24_FIELD_IM_SKYPE"),
			'IM_ICQ' => 			GetMessage("KOCB_BX24_FIELD_IM_ICQ"),
			'IM_MSN' => 			GetMessage("KOCB_BX24_FIELD_IM_MSN"),
			'IM_JABBER' => 			GetMessage("KOCB_BX24_FIELD_IM_JABBER"),
			'IM_OTHER' => 			GetMessage("KOCB_BX24_FIELD_IM_OTHER"),
	);


	if ( $arCurrentValues["BX24_ADD_LEAD"] == "Y" ):

		$arComponentParameters["PARAMETERS"]["BX24_HOST"] = array(
				"PARENT" => "BX24_SETTINGS",
				"NAME" => GetMessage("KOCB_BX24_HOST"),
				"TYPE" => "STRING",
				"DEFAULT" => "",
		);

		$arComponentParameters["PARAMETERS"]["BX24_LOGIN"] = array(
				"PARENT" => "BX24_SETTINGS",
				"NAME" => GetMessage("KOCB_BX24_LOGIN"),
				"TYPE" => "STRING",
				"DEFAULT" => "",
		);

		$arComponentParameters["PARAMETERS"]["BX24_PASSWORD"] = array(
				"PARENT" => "BX24_SETTINGS",
				"NAME" => GetMessage("KOCB_BX24_PASSWORD"),
				"TYPE" => "STRING",
				"DEFAULT" => "",
		);

		$arComponentParameters["PARAMETERS"]["BX24_LEAD_TITLE"] = array(
				"PARENT" => "BX24_SETTINGS",
				"NAME" => GetMessage("KOCB_BX24_LEAD_TITLE"),
				"TYPE" => "STRING",
				"DEFAULT" => $arCurrentValues["KOCB_SAVE_TO_IB_ELEMENT_NAME"],
		);

		if ( isset($arCurrentValues["BX24_LEAD_TITLE"]) && !empty($arCurrentValues["BX24_LEAD_TITLE"]) ):
			unset($arBX24Fields['TITLE']);
		endif;


		if( is_array($arPropertyIBFields) && count($arPropertyIBFields) > 0 ):
			foreach ( $arPropertyIBFields as $FieldKey=>$FieldName):
				if ( $arCurrentValues["USE_FIELD_".$FieldKey] == "Y" ):
					$arComponentParameters["PARAMETERS"]["BX24_FIELD_".$FieldKey."_LINK"] = array(
							"PARENT" => "BX24_SETTINGS",
							"NAME" => GetMessage("KOCB_BX24_FIELD_LINK")."[ ".$FieldKey." ] ".$FieldName,
							"TYPE" => "LIST",
							"VALUES" => $arBX24Fields,
					);
				endif;
			endforeach;
		endif;
	endif;

endif;

?>