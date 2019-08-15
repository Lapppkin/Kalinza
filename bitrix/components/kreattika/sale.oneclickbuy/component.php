<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# Component: sale.oneclickbuy                                                                              #
# File: component.php                                                                                      #
# Version: 1.0.1                                                                                           #
# (c) 2011-2017 Kreattika, Sedov S.Y.  (ООО "КРЕАТТИКА", Седов С.Ю.)                                       #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?><?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

$KOCBModuleInc = CModule::IncludeModuleEx("kreattika.oneclickbuy");

if ( $KOCBModuleInc == 0  ):
	return false;
elseif ( $KOCBModuleInc == 2  ):
	echo GetMessage("KOCB_MODULE_DEMO");
elseif ( $KOCBModuleInc == 3  ):
	echo GetMessage("KOCB_MODULE_DEMO_EXPIRED");
	return false;
endif;

if( isset($arParams["FORM_ID"]) && !empty($arParams["FORM_ID"]) ):
	$arResult["PARAMS_HASH"] = $arParams["FORM_ID"];
else:
	$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());
endif;

if( $arParams["DISABLE_AUTH_CAPTCHA"] == "Y" ):
	$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
endif;

if( $arParams["USE_CAPTCHA"] == "N" ):
	$arParams["USE_RECAPTCHA"] = "N";
endif;

if( empty($arParams["RECAPTCHA_PUBLIC"]) || empty($arParams["RECAPCHA_PRIVATE"]) ):
	$arParams["USE_RECAPTCHA"] = "N";
endif;

if( $arParams["USE_RECAPTCHA"] == "Y" ):
	require_once($_SERVER['DOCUMENT_ROOT'].$componentPath."/classes/recaptchalib.php");
	if( $arParams["RECAPTCHA_LANG"] != "AUTO" ):
		if( $arParams["RECAPTCHA_LANG"] == "SITE" ):
			$rsSites = CSite::GetByID(SITE_ID);
			$arSite = $rsSites->Fetch();
			$strSiteLang = $arSite["LANGUAGE_ID"];
			$strRecaptchaLang = '?hl='.$strSiteLang;
		elseif( $arParams["RECAPTCHA_LANG"] == "ru" ):
			$strRecaptchaLang = '?hl=ru';
		elseif( $arParams["RECAPTCHA_LANG"] == "en" ):
			$strRecaptchaLang = '?hl=en';
		elseif( $arParams["RECAPTCHA_LANG"] == "az" ):
			$strRecaptchaLang = '?hl=az';
		elseif( $arParams["RECAPTCHA_LANG"] == "uk" ):
			$strRecaptchaLang = '?hl=uk';
		endif;
	else:
		$strRecaptchaLang = '';
	endif;
	$APPLICATION->AddHeadString('<script src=\'https://www.google.com/recaptcha/api.js'.$strRecaptchaLang.'\'></script>',true);
endif;

$IBlockModuleInc = Bitrix\Main\Loader::IncludeModule('iblock');
$CatalogModuleInc = Bitrix\Main\Loader::IncludeModule('catalog');
$SaleModuleInc = Bitrix\Main\Loader::IncludeModule('sale');
$CurrencyModuleInc = Bitrix\Main\Loader::IncludeModule('currency');

if(!$IBlockModuleInc):
	$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_MODULE_IBLOCK_NOT_INSTALLED");
endif;

$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if( empty($arParams["EMAIL_TO"]) ):
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
endif;

$arParams["SUCCESS_TEXT"] = trim($arParams["SUCCESS_TEXT"]);
if( empty($arParams["SUCCESS_TEXT"]) ):
	$arParams["SUCCESS_TEXT"] = GetMessage("KOCB_SUCCESS_MESSAGE");
endif;


$arResult["FIELDS"] = array();
$arResult["FORM_ID"] = $arParams["FORM_ID"];

$arResult["NOTIFY_MESSAGE"] = array();
$arResult["VIEW_FORM"] = "N";

if( $arParams["BUY_ALL_BASKET"] == "Y" ):
	if( $arResult["BASKET"] = COneClickBuy::getBasketItems() ):
		$arResult["VIEW_FORM"] = "Y";
	else:
		$arResult["NOTIFY_MESSAGE"][] = GetMessage("KOCB_NOTIFY_BASKET_IS_EMPTY");
		$arResult["VIEW_FORM"] = "N";
	endif;
else:
	if( isset($arParams["PRODUCT_ID"]) && !empty($arParams["PRODUCT_ID"]) && intval($arParams["PRODUCT_ID"]) > 0 ):
		$intProductID = intval($arParams["PRODUCT_ID"]);
	elseif( isset($_POST["PRODUCT_ID"]) && !empty($_POST["PRODUCT_ID"]) && intval($_POST["PRODUCT_ID"]) > 0 ):
		$intProductID = intval($_POST["PRODUCT_ID"]);
	endif;

	if( $intProductID > 0):
		$arResult["VIEW_FORM"] = "Y";
		$arResult["ORDER_FIELDS"]["PRODUCT_ID"] = array(
				"NAME" => "PRODUCT_ID",
				"VALUE" => $intProductID,
		);

		if(!in_array("PRODUCT_QUANTITY", $arParams["USE_FIELDS"])):
			$arResult["ORDER_FIELDS"]["PRODUCT_QUANTITY"] = array(
					"NAME" => "PRODUCT_QUANTITY",
					"VALUE" => ( !isset($arParams["PRODUCT_QUANTITY_DEFAULT_VALUE"]) || empty($arParams["PRODUCT_QUANTITY_DEFAULT_VALUE"]) ) ? 1 : $arParams["PRODUCT_QUANTITY_DEFAULT_VALUE"],
			);
		endif;

		if($SaleModuleInc):
			$arResult["ORDER_FIELDS"]["PRODUCT_QUANTITY_CHECK_STORE"] = array(
					"NAME" => "PRODUCT_QUANTITY_CHECK_STORE",
					"VALUE" => ( !isset($arParams["PRODUCT_QUANTITY_CHECK_STORE"]) || empty($arParams["PRODUCT_QUANTITY_CHECK_STORE"]) ) ? "N" : $arParams["PRODUCT_QUANTITY_CHECK_STORE"],
			);
		endif;
	else:
		$arResult["NOTIFY_MESSAGE"][] = GetMessage("KOCB_NOTIFY_PRODUCT_ID_IS_EMPTY");
	endif;
endif;

if( $arResult["VIEW_FORM"] == "Y" ):
	if( $SaleModuleInc ):
		$arResult["ORDER_FIELDS"]["PERSON_TYPE_ID"] = array(
				"NAME" => "PERSON_TYPE_ID",
				"VALUE" => ( !isset($arParams["PERSON_TYPE_ID"]) || empty($arParams["PERSON_TYPE_ID"]) ) ? 1 : $arParams["PERSON_TYPE_ID"],
		);

		$arResult["ORDER_FIELDS"]["DELIVERY_ID"] = array(
				"NAME" => "DELIVERY_ID",
				"VALUE" => intval($arParams["DELIVERY_ID"]),
		);

		$arResult["ORDER_FIELDS"]["PAY_SYSTEM_ID"] = array(
				"NAME" => "PAY_SYSTEM_ID",
				"VALUE" => intval($arParams["PAY_SYSTEM_ID"]),
		);

	else:

		$arResult["ORDER_FIELDS"]["PRICE"] = array(
				"NAME" => "PRICE",
				"VALUE" => $arParams["PRICE"],
		);


	endif;

	$arResult["ORDER_FIELDS"]["ORDER_STATUS_ID"] = array(
			"NAME" => "ORDER_STATUS_ID",
			"VALUE" => $arParams["ORDER_STATUS_ID"],
	);

	if( empty($arParams["CURRENCY"]) ):
		if($CurrencyModuleInc):
			$CurrencyID = ( !isset($arParams["CURRENCY"]) || empty($arParams["CURRENCY"]) ) ? Bitrix\Main\Config\Option::get('sale', 'default_currency', 'RUB') : $arParams["CURRENCY"];
		else:
			$CurrencyID = "RUB";
		endif;
	else:
		$CurrencyID = $arParams["CURRENCY"];
	endif;

	$arResult["ORDER_FIELDS"]["CURRENCY"] = array(
			"NAME" => "CURRENCY",
			"VALUE" => $CurrencyID,
	);

	foreach ($arParams["USE_FIELDS"] as $arUseField):
		$arResult["FIELDS"][$arUseField] = array(
				"NAME" => $arUseField,
				"TYPE" => "text",
				"LABEL" => $arParams["FIELD_".$arUseField."_LABEL"],
				"PLACEHOLDER" => $arParams["FIELD_".$arUseField."_PLACEHOLDER"],
				"CHECK" => $arParams["FIELD_".$arUseField."_CHECK"],
		);

		if( $arUseField == "PRODUCT_QUANTITY" ):
			if( isset($arParams["FIELD_PRODUCT_QUANTITY_VALUE"]) && !empty($arParams["FIELD_PRODUCT_QUANTITY_VALUE"]) && intval($arParams["FIELD_PRODUCT_QUANTITY_VALUE"]) > 0 ):
				$arResult["FIELDS"][$arUseField]["VALUE"] = intval($arParams["FIELD_PRODUCT_QUANTITY_VALUE"]);
			else:
				$arResult["FIELDS"][$arUseField]["VALUE"] = 1;
			endif;
		endif;
	endforeach;
endif;

$arResult["USER_CONSENT_LABEL"] = $arParams["~USER_CONSENT_TEXT"];
if( !empty($arParams["USER_CONSENT_LINK_TEXT"]) && !empty($arParams["USER_CONSENT_LINK"]) ):
	$arResult["USER_CONSENT_LABEL"] .= ' <a href="'.$arParams["USER_CONSENT_LINK"].'">'.$arParams["~USER_CONSENT_LINK_TEXT"].'</a>';
elseif( !empty($arParams["USER_CONSENT_LINK_TEXT"]) ):
	$arResult["USER_CONSENT_LABEL"] .= ' '.$arParams["~USER_CONSENT_LINK_TEXT"];
endif;

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"])):

	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid()):

		foreach ($arResult["ORDER_FIELDS"] as $FieldCode=>$FieldItem):
			if( isset($_POST[$FieldCode]) && !empty($_POST[$FieldCode]) ):
				if( is_array($_POST[$FieldCode]) ):
					$arResult["POST"][$FieldCode] = $_POST[$FieldCode];
				else:
					$arResult["POST"][$FieldCode] = htmlspecialcharsbx($_POST[$FieldCode]);
				endif;
				$arResult["ORDER_FIELDS"][$FieldCode]["VALUE"] = $arResult["POST"][$FieldCode];
			endif;
			if($FieldCode == "PRODUCT_ID"):
				if( !isset($FieldItem["VALUE"]) || empty($FieldItem["VALUE"]) ):
					$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_REQ").' PRODUCT ID';
				else:
					if( $SaleModuleInc && $IBlockModuleInc && intval($FieldItem["VALUE"]) > 0 ):
						if( $arProduct = CCatalogProduct::GetByID($FieldItem["VALUE"]) ):
							if( $arProduct["TYPE"] == 3 && $CatalogModuleInc ):

								if( $arCatalogSKUList = CCatalogSKU::getOffersList(
										array($FieldItem["VALUE"]), // массив ID товаров
										$iblockID = 0, // указываете ID инфоблока только в том случае, когда ђ?Чє массив товаров из одного инфоблока и он известен
										$skuFilter = array(), // дополнительный фильтр предложений. по умолчанию пуст.
										$fields = array(),  // массив полей предложений. даже если пуст - вернет ID и IBLOCK_ID
										$propertyFilter = array()
								)
								):

									$arFirstProductSKU = array_shift($arCatalogSKUList[$FieldItem["VALUE"]]);
									$SCUProduktID = $arFirstProductSKU["ID"];

									$arResult["ORDER_FIELDS"]["PRODUCT_ID"]["VALUE"] = $SCUProduktID;
									$arResult["POST"]["PRODUCT_ID"] = $SCUProduktID;
									$FieldItem["VALUE"] = $SCUProduktID;

								endif;
							endif;

							if( $arParams["PRODUCT_QUANTITY_CHECK_STORE"] == "Y" ):

								if( $arProduct["QUANTITY_TRACE_ORIG"] == "Y"  ):

								else:

								endif;
							endif;
						else:
							$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_GOOD_IS_NOT_FIND", array("#PRODUCT ID#"=>$FieldItem["VALUE"]));
						endif;
					elseif( !$SaleModuleInc && $IBlockModuleInc && intval($FieldItem["VALUE"]) > 0 ):
						if( $arProduct = CIBlockElement::GetByID($FieldItem["VALUE"])->Fetch() ):

						else:
							$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_IBELEMENT_IS_NOT_FIND", array("#PRODUCT ID#"=>$FieldItem["VALUE"]));
						endif;
					endif;
				endif;
			endif;
		endforeach;

		foreach ($arResult["FIELDS"] as $FieldCode=>$FieldItem):
			if( isset($_POST[$FieldCode]) && !empty($_POST[$FieldCode]) ):
				if( is_array($_POST[$FieldCode]) ):
					$arResult["POST"][$FieldCode] = $_POST[$FieldCode];
				else:
					$arResult["POST"][$FieldCode] = htmlspecialcharsbx($_POST[$FieldCode]);
				endif;
				$arResult["FIELDS"][$FieldCode]["VALUE"] = $arResult["POST"][$FieldCode];
			endif;
			if( $arParams["USE_FIELD_".$FieldCode] == 'Y' && $arParams["FIELD_".$FieldCode."_CHECK"] == 'Y' && empty($_POST[$FieldCode])):
				$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_REQ").' '.$arParams["FIELD_".$FieldCode."_LABEL"];
			endif;
		endforeach;

		if($arParams["USE_CAPTCHA"] == "Y"):
			if($arParams["USE_RECAPTCHA"] == "Y"):
				$reCaptcha = new ReCaptcha($arParams["RECAPCHA_PRIVATE"]);
				if ($_POST["g-recaptcha-response"]) :
					$resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
					if ($resp != null && $resp->success):
					else:
						$arResult["ERROR_MESSAGE"][] = $resp->errorCodes;
					endif;
				else:
					$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_RECAPTCHA_ERROR_RESPONSE");
				endif;
			else:
				include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
				$captcha_code = $_POST["captcha_sid"];
				$captcha_word = $_POST["captcha_word"];
				$cpt = new CCaptcha();
				$captchaPass = COption::GetOptionString("main", "captcha_password", "");
				if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0):
					if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass)):
						$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_CAPTCHA_WRONG");
					endif;
				else:
					$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_CAPTHCA_EMPTY");
				endif;
			endif;
		endif;

		if($arParams["USE_USER_CONSENT"] == "Y"):
			if ( isset($_POST["user_consent"]) && !empty($_POST["user_consent"]) && $_POST["user_consent"] == "on" ):

			else:
				$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_USER_CONSENT_IS_NOT_CHECKED");
			endif;
		endif;

		if(empty($arResult["ERROR_MESSAGE"])):

			$arSendPrm = $arResult;
			$arSendPrm["COMPONENT_PARAMETERS"] = $arParams;
			COneClickBuy::addOrder($arSendPrm);
			if( COneClickBuy::getOrderID() ):
				LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"]."&ORDER_ID=".COneClickBuy::getOrderID(), Array("success", "ORDER_ID")));
			else:
				LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
			endif;

		endif;

	else:
		$arResult["ERROR_MESSAGE"][] = GetMessage("KOCB_SESS_EXP");
	endif;

elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"]):
	if( $arResult["ORDER_ID"] = COneClickBuy::getOrderID() ):
		$arResult["SUCCESS_MESSAGE"] = str_replace("#ORDER_ID#", $arResult["ORDER_ID"], $arParams["SUCCESS_TEXT"]);
	else:
		$arResult["SUCCESS_MESSAGE"] = str_replace("#ORDER_ID#", "", $arParams["SUCCESS_TEXT"]);
	endif;
endif;

if(empty($arResult["ERROR_MESSAGE"])):
	if($USER->IsAuthorized()):
		$arResult["USER"]["NAME"] = $USER->GetFormattedName(false);
		$arResult["USER"]["EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
	else:
		foreach ($arResult["FIELDS"] as $FieldCode=>$FieldItem):
			if(strlen($_SESSION["KOCB_FIELD_".$FieldCode]) > 0):
				$arResult["FIELDS"][$FieldCode]["VALUE"] = htmlspecialcharsbx($_SESSION["KOCB_FIELD_".$FieldCode]);
			endif;
		endforeach;
	endif;
endif;

if($arParams["USE_CAPTCHA"] == "Y" && $arParams["USE_RECAPTCHA"] != "Y"):
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());
endif;

$this->IncludeComponentTemplate();
?>