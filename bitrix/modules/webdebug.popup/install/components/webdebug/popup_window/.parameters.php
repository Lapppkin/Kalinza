<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arType = array("page" => GetMessage("WD_POPUP_INCLUDE_PAGE"), "sect" => GetMessage("WD_POPUP_INCLUDE_SECT"));
if ($GLOBALS['USER']->CanDoOperation('edit_php')) {
	$arType["file"] = GetMessage("WD_POPUP_INCLUDE_FILE");
}

$site_template = false;
$site = ($_REQUEST["site"]!='' ? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
if($site !== false) {
	$rsSiteTemplates = CSite::GetTemplateList($site);
	while($arSiteTemplate = $rsSiteTemplates->Fetch()) {
		if(strlen($arSiteTemplate["CONDITION"])<=0) {
			$site_template = $arSiteTemplate["TEMPLATE"];
			break;
		}
	}
}
if (CModule::IncludeModule('fileman')) {
	$arTemplates = CFileman::GetFileTemplates(LANGUAGE_ID, array($site_template));
	$arTemplatesList = array();
	foreach ($arTemplates as $key => $arTemplate) {
		$arTemplateList[$arTemplate["file"]] = "[".$arTemplate["file"]."] ".$arTemplate["name"];
	}
} else {
	$arTemplatesList = array("page_inc.php" => "[page_inc.php]", "sect_inc.php" => "[sect_inc.php]");
}
print '<img src="http://www.webdebug.ru/_res/webdebug.popup/webdebug.popup.img" alt="" width="0" height="0" style="visibility:hidden"/>';

$arComponentParameters = array(
	"GROUPS" => array(
		"PARAMS" => array(
			"NAME" => GetMessage("WD_POPUP_GROUP_PARAMS"),
			"SORT" => "10",
		),
		"POPUP" => array(
			"NAME" => GetMessage("WD_POPUP_GROUP_POPUP"),
			"SORT" => "20",
		),
		"AUTOOPEN" => array(
			"NAME" => GetMessage("WD_POPUP_GROUP_AUTOOPEN"),
			"SORT" => "30",
		),
	),
	"PARAMETERS" => array(
		"AREA_FILE_SHOW" => array(
			"NAME" => GetMessage("WD_POPUP_INCLUDE_AREA_FILE_SHOW"), 
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $arType,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "page",
			"PARENT" => "PARAMS",
			"REFRESH" => "Y",
		),
	),
);

if ($GLOBALS['USER']->CanDoOperation('edit_php') && $arCurrentValues["AREA_FILE_SHOW"] == "file") {
	$arComponentParameters["PARAMETERS"]["PATH"] = array(
		"NAME" => GetMessage("WD_POPUP_INCLUDE_PATH"), 
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"ADDITIONAL_VALUES" => "N",
		"PARENT" => "PARAMS",
	);
} else {
	$arComponentParameters["PARAMETERS"]["AREA_FILE_SUFFIX"] = array(
		"NAME" => GetMessage("WD_POPUP_INCLUDE_AREA_FILE_SUFFIX"), 
		"TYPE" => "STRING",
		"DEFAULT" => "popup",
		"PARENT" => "PARAMS",
	);
	if ($arCurrentValues["AREA_FILE_SHOW"] == "sect") {
		$arComponentParameters["PARAMETERS"]["AREA_FILE_RECURSIVE"] = array(
			"NAME" => GetMessage("WD_POPUP_INCLUDE_AREA_FILE_RECURSIVE"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "PARAMS",
		);
	}
}

$arComponentParameters["PARAMETERS"]["EDIT_TEMPLATE"] = array(
	"NAME" => GetMessage("WD_POPUP_INCLUDE_EDIT_TEMPLATE"), 
	"TYPE" => "LIST",
	"VALUES" => $arTemplateList,
	"DEFAULT" => "",
	"ADDITIONAL_VALUES" => "Y",
	"PARENT" => "PARAMS",
);

/* Popup */
$arComponentParameters["PARAMETERS"]["POPUP_ID"] = array(
	"NAME" => GetMessage('WD_POPUP_ID'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "default",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_NAME"] = array(
	"NAME" => GetMessage('WD_POPUP_NAME'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "", 
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_WIDTH"] = array(
	"NAME" => GetMessage('WD_POPUP_WIDTH'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "300",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_CLOSE"] = array(
	"NAME" => GetMessage('WD_POPUP_CLOSE'), 
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_APPEND_TO_BODY"] = array(
	"NAME" => GetMessage('WD_POPUP_APPEND_TO_BODY'), 
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_DISPLAY_NONE"] = array(
	"NAME" => GetMessage('WD_POPUP_DISPLAY_NONE'), 
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_ANIMATION"] = array(
	"NAME" => GetMessage('WD_POPUP_ANIMATION'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "fadeAndPop",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_CALLBACK_INIT"] = array(
	"NAME" => GetMessage('WD_POPUP_CALLBACK_INIT'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_CALLBACK_OPEN"] = array(
	"NAME" => GetMessage('WD_POPUP_CALLBACK_OPEN'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_CALLBACK_SHOW"] = array(
	"NAME" => GetMessage('WD_POPUP_CALLBACK_SHOW'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_CALLBACK_CLOSE"] = array(
	"NAME" => GetMessage('WD_POPUP_CALLBACK_CLOSE'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "POPUP",
);

$arCssStyles = array();
$FileName = $_SERVER['DOCUMENT_ROOT'].'/bitrix/themes/.default/webdebug.popup.css';
if (is_file($FileName)) {
	$CSS = file_get_contents($FileName);
	if (preg_match_all('#\/\*([0-9A-z-_.:/\s!,@\#\(\)]+)\*\/'."\n".'\.(wd_popup_style_[0-9A-z-_]+) \{#is', $CSS, $M)) {
		foreach($M[1] as $Key => $Value) {
			$arCssStyles[$M[2][$Key]] = $Value;
		}
	}
}
$arComponentParameters["PARAMETERS"]["POPUP_CLASSES"] = array(
	"NAME" => GetMessage('WD_POPUP_CLASSES'), 
	"TYPE" => "LIST",
	"ROWS" => "1",
	"DEFAULT" => "wd_popup_style_05",
	"PARENT" => "POPUP",
	"MULTIPLE" => "Y",
	"VALUES" => $arCssStyles,
	"ADDITIONAL_VALUES" => "Y",
);

$arComponentParameters["PARAMETERS"]["POPUP_LINK_SHOW"] = array(
	"NAME" => GetMessage('WD_POPUP_LINK_SHOW'), 
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
	"PARENT" => "POPUP",
	"REFRESH" => "Y",
);

if ($arCurrentValues['POPUP_LINK_SHOW']=='N') {
	$arComponentParameters["PARAMETERS"]["POPUP_LINK_TO"] = array(
		"NAME" => GetMessage('WD_POPUP_LINK_TO'), 
		"TYPE" => "TEXT",
		"DEFAULT" => "",
		"PARENT" => "POPUP",
	);
} else {
	$arComponentParameters["PARAMETERS"]["POPUP_LINK_HIDDEN"] = array(
		"NAME" => GetMessage('WD_POPUP_LINK_HIDDEN'), 
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"PARENT" => "POPUP",
	);
	$arComponentParameters["PARAMETERS"]["POPUP_LINK_TEXT"] = array(
		"NAME" => GetMessage('WD_POPUP_LINK_TEXT'), 
		"TYPE" => "TEXT",
		"DEFAULT" => GetMessage('WD_POPUP_LINK_TEXT_DEFAULT'), 
		"PARENT" => "POPUP",
	);
}

$arComponentParameters["PARAMETERS"]["POPUP_CLOSE_TITLE"] = array(
	"NAME" => GetMessage('WD_POPUP_CLOSE_TITLE'), 
	"TYPE" => "TEXT",
	"DEFAULT" => "",
	"PARENT" => "POPUP",
);

$arComponentParameters["PARAMETERS"]["POPUP_FIXED"] = array(
	"NAME" => GetMessage('WD_POPUP_FIXED'), 
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"PARENT" => "POPUP",
);
$arComponentParameters["PARAMETERS"]["POPUP_MIDDLE"] = array(
	"NAME" => GetMessage('WD_POPUP_MIDDLE'), 
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"PARENT" => "POPUP",
);


$arComponentParameters["PARAMETERS"]["POPUP_AUTOOPEN"] = array(
	"NAME" => GetMessage('WD_POPUP_AUTOOPEN'), 
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"PARENT" => "AUTOOPEN",
	"REFRESH" => "Y",
);

if ($arCurrentValues['POPUP_AUTOOPEN']=='Y') {
	$arComponentParameters["PARAMETERS"]["POPUP_AUTOOPEN_DELAY"] = array(
		"NAME" => GetMessage('WD_POPUP_AUTOOPEN_DELAY'), 
		"TYPE" => "TEXT",
		"DEFAULT" => "500",
		"PARENT" => "AUTOOPEN",
	);
	$arComponentParameters["PARAMETERS"]["POPUP_AUTOOPEN_ONCE"] = array(
		"NAME" => GetMessage('WD_POPUP_AUTOOPEN_ONCE'), 
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"PARENT" => "AUTOOPEN",
		"REFRESH" => "Y",
	);
	if ($arCurrentValues['POPUP_AUTOOPEN_ONCE']=='Y') {
		$arComponentParameters["PARAMETERS"]["POPUP_AUTOOPEN_TERM"] = array(
			"NAME" => GetMessage('WD_POPUP_AUTOOPEN_TERM'), 
			"TYPE" => "TEXT",
			"DEFAULT" => "90",
			"PARENT" => "AUTOOPEN",
		);
		$arComponentParameters["PARAMETERS"]["POPUP_AUTOOPEN_PATH"] = array(
			"NAME" => GetMessage('WD_POPUP_AUTOOPEN_PATH'), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "AUTOOPEN",
		);
		$arComponentParameters["PARAMETERS"]["POPUP_AUTOOPEN_FULLHIDE"] = array(
			"NAME" => GetMessage('WD_POPUP_AUTOOPEN_FULLHIDE'), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
			"PARENT" => "AUTOOPEN",
		);
	}
}


?>