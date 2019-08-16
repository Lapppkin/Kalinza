<?if(!check_bitrix_sessid()) return;?>
<?
global $askaron_geo_global_errors;
$askaron_geo_global_errors = is_array($askaron_geo_global_errors) ? $askaron_geo_global_errors : array();

if(is_array($askaron_geo_global_errors) && count($askaron_geo_global_errors)>0)
{
	foreach($askaron_geo_global_errors as $val)
	{
		$alErrors .= $val."<br>";
	}
	echo CAdminMessage::ShowMessage(Array("TYPE"=>"ERROR", "MESSAGE" => GetMessage("MOD_INST_ERR"), "DETAILS"=>$alErrors, "HTML"=>true));
}
else
{
	echo CAdminMessage::ShowNote(GetMessage("MOD_INST_OK"));
	
	?>
	<p><a href="settings.php?lang=<?=LANG?>&amp;mid=askaron.geo&amp;mid_menu=1"><?=GetMessage("ASKARON_GEO_SETTINGS_PAGE" )?></a></p>
	<?	
}
?>

<form action="<?echo $APPLICATION->GetCurPage()?>">
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">
</form>
