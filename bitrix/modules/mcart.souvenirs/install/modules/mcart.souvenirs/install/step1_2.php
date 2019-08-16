<?
IncludeModuleLangFile(__FILE__);
?>
<form action="<?echo $APPLICATION->GetCurPage()?>" name="form1">
	<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="hidden" name="id" value="mcart.souvenirs">
	<input type="hidden" name="install" value="Y">
	<input type="hidden" value="1" name="isnewiblock"> 
	<input type="hidden" name="step" value="2">

	<?	
	$ck = "";
	
	$prod_id = "<select id='prod_id_iblock' name='prod_id_iblock' size='1'>";
				if (CModule::IncludeModule('iblock'))
			{
				$el = new CIBlock;
				$spr = CIBlock::GetList();
				while ($el=$spr->GetNext()) $ck .= "<option value='".$el["ID"]."'>".$el["NAME"]."</option>";
				
			}	
			$ck .= "</select>";	
			
			
			echo GetMessage("PROD_IBLOCK_ID");
			echo "<br>".$prod_id.$ck."<br><br>";
			?>
	<input type="submit" name="inst" value="<?echo GetMessage("MOD_INSTALL")?>">
<form>