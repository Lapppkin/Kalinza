<form action="<?echo $APPLICATION->GetCurPage()?>" name="form1">
	<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
	<input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
	<input type="hidden" name="install" value="Y">
	<input type="hidden" name="step" value="2">

	<input type="submit" name="inst" value="<?= GetMessage("MOD_INSTALL")?>">
</form>