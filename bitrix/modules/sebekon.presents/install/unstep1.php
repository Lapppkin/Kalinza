<form action="<?echo $APPLICATION->GetCurPage()?>">
<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
	<input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">
	<?echo CAdminMessage::ShowMessage(GetMessage("MOD_UNINST_WARN"))?>
	<p><input type="checkbox" name="deleteIBlock" id="deleteIBlock" value="Y" checked><label for="deleteIBlock"><?echo GetMessage($_REQUEST['id'] . "_DELETE_IBLOCK")?></label></p>
	<input type="submit" name="inst" value="<?echo GetMessage("MOD_UNINST_DEL")?>">
</form>