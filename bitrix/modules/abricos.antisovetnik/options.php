<?

IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
 $module_id = "abricos.antisovetnik";
CModule::IncludeModule($module_id);

$arAllOptions = array(
	"main" => Array(

		Array("ABRICOS_ANTISOVETNIK_SHOW_LINE",  GetMessage('ABRICOS_ANTISOVETNIK_SHOW_LINE'),  "", Array("checkbox", "")),

                  )
);

$aTabs = array(
	array("DIV" => "antisovetnik", "TAB" => GetMessage("ABRICOS_ANTISOVETNIK_TAB_NAME_SETTINGS"), "TITLE" => GetMessage("ABRICOS_ANTISOVETNIK_TAB_NAME_SETTINGS")),

	);

if( (isset($_REQUEST['save']) || isset($_REQUEST['apply']) ) && check_bitrix_sessid()){
	__AdmSettingsSaveOptions($module_id, $arAllOptions['main']);
}
$tabControl = new CAdminTabControl("tabControl", $aTabs);
$tabControl->Begin();

?><form method="post" name="abricos_options" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>"><?
echo bitrix_sessid_post();
$tabControl->BeginNextTab();
__AdmSettingsDrawList('abricos.antisovetnik',$arAllOptions['main']);
$tabControl->Buttons(array());
$tabControl->End();
?></form>
