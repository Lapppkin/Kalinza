<?
###################################################
# askaron.geo module                              #
# Copyright (c) 2011-2015 Askaron Systems ltd.    #
# http://askaron.ru                               #
# mailto:mail@askaron.ru                          #
###################################################

IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
require_once( "prolog.php" );

$module_id = "askaron.geo";
$install_status = CModule::IncludeModuleEx($module_id);

\Bitrix\Main\Loader::includeModule("sale");


$arGroups = array(
//	"group1" => array(
//		"NAME" => GetMessage("ASKARON_GEO_GROUP1"),
//
//	),
);

$arSites = array();

$rsSites = CSite::GetList($by="sort", $order="asc");
while ( $arSite = $rsSites->Fetch() )
{
	$arSites[ $arSite["ID"] ] = $arSite;
}


foreach ( $arSites as $arSite )
{
	$arGroups[ "group2_".$arSite["ID"] ] = array(
		"NAME" =>  GetMessage("ASKARON_GEO_GROUP_SITE")." [".$arSite["ID"]."] ".$arSite["NAME"],
	);
}


$arOptions = array();

//$arOptions[] = array(
//	"CODE" => "no_photo",
//	"SITE_ID" => $arSite["ID"],
//	"NAME" => GetMessage("ASKARON_API_FOR_ALL_SITES"),
//	"TYPE" => "IMAGE",
//	"HELP" => "",
//	"GROUP" =>"group1",
//);

foreach ( $arSites as $arSite )
{
	$arOptions[] = array(
		"CODE" => "set_location",
		"SITE_ID" => $arSite["ID"],
		"SHOW_EXACT_SITE_VALUE" => false,
		"NAME" => GetMessage("ASKARON_GET_SET_LOCATION"),
		"TYPE" => "CHECKBOX",
		"HELP" => "",
		"GROUP" =>"group2_".$arSite["ID"],
	);

	$arOptions[] = array(
		"CODE" => "set_default_location_id",
		"SITE_ID" => $arSite["ID"],
		"SHOW_EXACT_SITE_VALUE" => false,
		"NAME" => GetMessage("ASKARON_GET_SET_DEFAULT_LOCATION_ID"),
		"TYPE" => "CHECKBOX",
		"HELP" => "", //GetMessage("ASKARON_GET_SET_DEFAULT_LOCATION_ID_HELP"),
		"GROUP" =>"group2_".$arSite["ID"],
	);

	$arOptions[] = array(
		"CODE" => "default_location_id",
		"SITE_ID" => $arSite["ID"],
		"SHOW_EXACT_SITE_VALUE" => false,
		"NAME" => GetMessage("ASKARON_GET_DEFAULT_LOCATION_ID"),
		"TYPE" => "LOCATION",
		"HELP" => GetMessage("ASKARON_GET_DEFAULT_LOCATION_ID_HELP"),
		"GROUP" =>"group2_".$arSite["ID"],
	);

}

if( $install_status==0 )
{
	// module not found (0)
}
elseif( $install_status==3 )
{
	//demo expired (3)
	CAdminMessage::ShowMessage(
		Array(
			"TYPE"=>"ERROR",
			"MESSAGE" => GetMessage("askaron_geo_prolog_status_demo_expired"),
			"DETAILS"=> GetMessage("askaron_geo_prolog_buy_html"),
			"HTML"=>true
		)
	);	
}
else
{

	$RIGHT = $APPLICATION->GetGroupRight($module_id);
	$RIGHT_W = ($RIGHT>="W");
	$RIGHT_R = ($RIGHT>="R");

	if ($RIGHT_R)
	{	
		$arErrors = array();
		$arSettings = array();

		if (
			$REQUEST_METHOD=="POST"
			&& strlen($Update)>0
			&& $RIGHT_W
			&& check_bitrix_sessid()
		)
		{
			// Update all options
			foreach ( $arOptions as $key => $arOption )
			{
				if ( $arOption["TYPE"] == "CHECKBOX" )
				{
					if ( isset( $_REQUEST[ "arrOptions__".$key ] ) && $_REQUEST[ "arrOptions__".$key ] == "Y" )
					{
						COption::SetOptionString($module_id, $arOption["CODE"], "Y", false, $arOption["SITE_ID"] );
					}
					else
					{
						COption::SetOptionString($module_id, $arOption["CODE"], "N", false, $arOption["SITE_ID"] );
					}
				}

				if ( $arOption["TYPE"] == "TEXT" )
				{
					if ( isset( $_REQUEST[ "arrOptions__".$key ] ) )
					{
						COption::SetOptionString( $module_id, $arOption["CODE"], $_REQUEST[ "arrOptions__".$key ], false, $arOption["SITE_ID"] );
					}
				}

				if ( $arOption["TYPE"] == "INTEGER" || $arOption["TYPE"] == "LOCATION" )
				{
					if ( isset( $_REQUEST[ "arrOptions__".$key ] ) )
					{
						if ( strlen( $_REQUEST[ "arrOptions__".$key ] ) > 0 )
						{
							$val = intval( $_REQUEST[ "arrOptions__".$key ] );
							$min = $arOption["MIN"];

							if ( strlen( $min ) > 0 && $val < $min )
							{
								$val = $min;
							}

							COption::SetOptionString( $module_id, $arOption["CODE"], $val, false, $arOption["SITE_ID"] );
						}
					}
				}

//				if ( $arOption["TYPE"] == "IMAGE" )
//				{
//					$arFile = $_FILES[ "arrOptions__".$key];
//					$arFile["del"] = $_REQUEST[ "arrOptions__".$key."_del" ];
//					$arFile["MODULE_ID"] = $module_id;
//
//					$check_image_error = CFile::CheckImageFile( $arFile );
//
//					if ( strlen( $check_image_error ) > 0 )
//					{
//						$arWarnings[] = $check_image_error;
//					}
//					else
//					{
//						if ( strlen($arFile["name"]) > 0 || strlen($arFile["del"] ) > 0 )
//						{
//							$arFile["old_file"] = COption::GetOptionString( $module_id, $arOption["CODE"], "", $arOption["SITE_ID"], true );
//							$val = CFile::SaveFile( $arFile, $module_id );
//							COption::SetOptionString( $module_id, $arOption["CODE"], $val, false, $arOption["SITE_ID"] );
//						}
//					}
//				}
			}
		}


		if (
			$REQUEST_METHOD=="POST"
			&& $RIGHT_W
			&& strlen($RestoreDefaults)>0
			&& check_bitrix_sessid()
		)
		{
			COption::RemoveOption( $module_id );
			$z = CGroup::GetList($v1="id",$v2="asc", array("ACTIVE" => "Y", "ADMIN" => "N"), $get_users_amount = "N");
			while($zr = $z->Fetch())
			{
				$APPLICATION->DelGroupRight($module_id, array($zr["ID"]));
			}
		}

		// init all options:
		$arDisplayOptions = array();

		foreach ( $arOptions as $key=> $arOption )
		{
			$arOptionAdd = $arOption;

			$option_value = COption::GetOptionString( $module_id, $arOption["CODE"], "", $arOption["SITE_ID"], $arOption["SHOW_EXACT_SITE_VALUE"] );

			$arOptionAdd["INPUT_ID"] = "option_".$key;
			$arOptionAdd["INPUT_NAME"] = "arrOptions__".$key;
			$arOptionAdd["~INPUT_VALUE"] = $option_value;
			$arOptionAdd["INPUT_VALUE"] = htmlspecialcharsbx( $option_value );

			$arDisplayOptions[ $key ] = $arOptionAdd;
		}

		foreach ( $arGroups as $group_key => $arGroup )
		{
			$arGroups[$group_key]["~NAME"] = $arGroup["NAME"];
			$arGroups[$group_key]["NAME"] = htmlspecialcharsbx( $arGroup["NAME"] );
		}
		
		
//		if ( count( $arErrors ) > 0 )
//		{
//			CAdminMessage::ShowMessage(
//				Array(
//					"TYPE"=>"ERROR",
//					"MESSAGE" => GetMessage("askaron_geo_error_save_header"),
//					"DETAILS"=> implode( "<br />", $arErrors ),
//					"HTML"=>true
//				)
//			);
//		}
		
		//demo (2)
		if ( $install_status == 2 )
		{
			CAdminMessage::ShowMessage(
				Array(
					"TYPE"=>"OK",
					"MESSAGE" => GetMessage("askaron_geo_prolog_status_demo"),
					"DETAILS"=> GetMessage("askaron_geo_prolog_buy_html"),
					"HTML"=>true
				)
			);
		}
		
		
		
		$aTabs = array(
			array("DIV" => "edit1", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
			array("DIV" => "edit2", "TAB" => GetMessage("ASKARON_GEO_CHECK"), "ICON" => "", "TITLE" => GetMessage("ASKARON_GEO_CHECK") ),
			array("DIV" => "edit3", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "", "TITLE" => GetMessage("MAIN_TAB_TITLE_RIGHTS")),
		);

		$tabControl = new CAdminTabControl("tabControl", $aTabs);
		$tabControl->Begin();

		?>

		<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&lang=<?=LANGUAGE_ID?>">
			<?=bitrix_sessid_post()?>
			<?$tabControl->BeginNextTab();?>


			<tr>
				<td valign="top" colspan="2">
					<?=BeginNote();?>
					<?=GetMessage("ASKARON_GEO_INFO");?>
					<?=EndNote();?>
				</td>
			</tr>



			<?foreach ( $arGroups as $group_key => $arGroup ):?>

				<tr class="heading">
					<td valign="top" colspan="2" align="center"><?=$arGroup["NAME"]?></td>
				</tr>

				<?if ( strlen( $arGroup["HELP"] ) > 0 ):?>

					<tr>
						<td valign="top" colspan="2">
							<?=BeginNote();?>
							<?=$arGroup["HELP"];?>
							<?=EndNote();?>
						</td>
					</tr>
				<?endif?>

				<?foreach ( $arDisplayOptions as $key => $arInput  ):?>

					<?if ( $group_key == $arInput["GROUP"] ):?>
						<tr>
							<td valign="top" width="40%" class="field-name"><label for="<?=$arInput["INPUT_ID"]?>"><?=$arInput["NAME"]?></label></td>
							<td valign="top" width="60%">
								<?if ( $arInput["TYPE"] == "CHECKBOX" ):?>
									<input
										type="checkbox"
										value="Y"
										id="<?=$arInput["INPUT_ID"]?>"
										<?if ( $arInput["INPUT_VALUE"] == "Y" ):?>
											checked="checked"
										<?endif?>
										name="<?=$arInput["INPUT_NAME"]?>"
										/>
								<?endif?>

								<?if ( ($arInput["TYPE"] == "TEXT" && $arInput["ROWS"] <= 1) || $arInput["TYPE"] == "INTEGER" ):?>
									<input
										type="text"
										value="<?=$arInput["INPUT_VALUE"]?>"
										id="<?=$arInput["INPUT_ID"]?>"
										name="<?=$arInput["INPUT_NAME"]?>"
										size="40"
										/>
								<?endif?>

								<?if ( $arInput["TYPE"] == "LOCATION" ):?>

									<?$APPLICATION->IncludeComponent(
										"bitrix:sale.location.selector.search",
										"",
										Array(
											"CACHE_TIME" => "36000000",
											"CACHE_TYPE" => "A",
											"CODE" => "",
											"COMPONENT_TEMPLATE" => ".default",
											"EXCLUDE_SUBTREE" => "",
											"FILTER_BY_SITE" => "N",
											"FILTER_SITE_ID" => $arInput["SITE_ID"],
											"ID" => $arInput["INPUT_VALUE"],
											"INPUT_NAME" => $arInput["INPUT_NAME"],
											"JSCONTROL_GLOBAL_ID" => "",
											"JS_CALLBACK" => "",
											"PROVIDE_LINK_BY" => "id",
											"SEARCH_BY_PRIMARY" => "N",
											"SHOW_DEFAULT_LOCATIONS" => "N"
										),
										null,
										Array(
											'HIDE_ICONS' => 'N'
										)
									);?>

									<?//vd($arInput["INPUT_VALUE"])?>

								<?endif?>

								<?if ( $arInput["TYPE"] == "TEXT" && $arInput["ROWS"] > 1  ):?>

									<textarea id="<?=$arInput["INPUT_ID"]?>" name="<?=$arInput["INPUT_NAME"]?>" rows="<?=$arInput["ROWS"]?>" cols="<?=$arInput["COLS"]?>"><?=$arInput["INPUT_VALUE"]?></textarea>

								<?endif?>

								<?if ( $arInput["TYPE"] == "IMAGE" ):?>

									<?=CFile::InputFile( $arInput["INPUT_NAME"], 20,  $arInput["~INPUT_VALUE"], "/upload/");?>

									<?if (strlen($arInput["~INPUT_VALUE"])>0):?>
										<br><?=CFile::ShowImage( $arInput["~INPUT_VALUE"], 150, 150, "border=0", "", true );?>
									<?endif;?>
								<?endif?>


								<?if ( strlen( $arInput["HELP"] ) > 0 ):?>
									<?=BeginNote();?>
									<?=$arInput["HELP"];?>
									<?=EndNote();?>
								<?endif?>
							</td>
						</tr>
					<?endif?>

				<?endforeach?>

			<?endforeach?>

			<?$tabControl->BeginNextTab();?>

			<?
				$askaron_geo_ip_site_id = "";

				$arFirstSite = reset($arSites);
				$askaron_geo_ip_site_id = $arFirstSite["ID"];

				if ( isset( $_REQUEST["askaron_geo_ip_site_id"] ) && isset($arSites[ $_REQUEST["askaron_geo_ip_site_id"] ] ) )
				{
					$askaron_geo_ip_site_id = $_REQUEST["askaron_geo_ip_site_id"];
				}

			?>

			<tr>
				<td valign="top" width="40%"><?=GetMessage("ASKARON_GEO_YOUR_IP");?></td>
				<td valign="top" width="60%">
					<?$ip = \Askaron\Geo\Info::getIp();?>

					<?=htmlspecialcharsbx( $ip );?>
				</td>
			</tr>
			<tr>
				<td valign="top" width="40%"><?=GetMessage("ASKARON_GEO_USE_SITE_SETTINGS")?></td>
				<td valign="top" width="60%">
					<select id="askaron_geo_ip_site_id" name="askaron_geo_ip_site_id"  >
						<?foreach ($arSites as $arSite):?>
							<option
								<?if ( $arSite["ID"] == $askaron_geo_ip_site_id ):?>
									selected
								<?endif?>
								value="<?=$arSite["ID"]?>">[<?=$arSite["ID"]?>] <?=htmlspecialcharsbx($arSite["NAME"])?></option>
						<?endforeach?>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top" width="40%"><?=GetMessage("ASKARON_GEO_IP");?></td>
				<td valign="top" width="60%">

					<?if ( strlen( $_REQUEST["askaron_geo_ip_change"] ) > 0 ):?>
						<?\Askaron\Geo\Info::setIp($_REQUEST["askaron_geo_ip"] );?>
					<?endif?>

					<?$ip = \Askaron\Geo\Info::getIp();?>
					<input name="askaron_geo_ip" value="<?=htmlspecialcharsbx( $ip )?>" type="text">
					<input name="askaron_geo_ip_change" value="<?=GetMessage("ASKARON_GEO_IP_CHECK");?>" type="submit">
					<br><br>
					<input id="askaron_geo_ip_clear" name="askaron_geo_ip_clear" value="Y" type="checkbox"
						<?
						$bChecked=true;
						if ( strlen( $_REQUEST["askaron_geo_ip_change"] ) > 0 && $_REQUEST["askaron_geo_ip_clear"] !== "Y" )
						{
							$bChecked=false;
						}
						?>
						<?if ($bChecked):?>
							checked="checked"
						<?endif?>
					>
					<label for="askaron_geo_ip_clear"><?=GetMessage("ASKARON_GEO_IP_CLEAR");?></label>

				</td>
			</tr>




			<?if ( strlen( $_REQUEST["askaron_geo_ip_change"] ) > 0 ):?>

				<?$arCity = \Askaron\Geo\Info::getSxGeoCityFull();?>

				<?if ( $_REQUEST["askaron_geo_ip_clear"] == "Y" ):?>
					<?\Askaron\Geo\Location::clearCache();?>
				<?endif?>

				<?$arLocation = \Askaron\Geo\Location::getLocation( $askaron_geo_ip_site_id );?>

				<tr class="heading">
					<td valign="top" colspan="2" align="center"><?=GetMessage("ASKARON_GEO_RESULT");?></td>
				</tr>

				<tr>
					<td valign="top" width="40%"><?=GetMessage("ASKARON_GEO_LOCATION");?><br></td>
					<td valign="top" width="60%">
						<?if ( $arLocation ):?>
							<?=htmlspecialcharsbx( \Bitrix\Sale\Location\Admin\LocationHelper::getLocationPathDisplay( $arLocation["ID"] ) );?>
						<?else:?>
							<?=GetMessage("ASKARON_GEO_LOCATION_NOT_FOUND");?>
						<?endif?>

					</td>
				</tr>

				<tr class="heading">
					<td valign="top" colspan="2" align="center"><?=GetMessage("ASKARON_GEO_SPECIAL_INFO");?></td>
				</tr>

				<tr>
					<td valign="top" width="40%"><?=GetMessage("ASKARON_GEO_CITY");?><br></td>
					<td valign="top" width="60%">
						<em>$arCity = \Askaron\Geo\Info::getSxGeoCityFull();</em>
						<br><br>

						<?if ( $arCity ):?>
							<pre><?=htmlspecialcharsbx( print_r($arCity, true) );?></pre>
						<?else:?>
							<?=GetMessage("ASKARON_GEO_CITY_NOT_FOUND");?>
						<?endif?>
					</td>
				</tr>

				<tr>
					<td valign="top" width="40%"><?=GetMessage("ASKARON_GEO_LOCATION");?></td>
					<td valign="top" width="60%"><em>$arLocation = \Askaron\Geo\Location::getLocation("<?=$askaron_geo_ip_site_id?>");</em><br><br>


						<?if ( $arLocation ):?>

							<pre><?=htmlspecialcharsbx( print_r($arLocation, true) );?></pre>
							<?=htmlspecialcharsbx( \Bitrix\Sale\Location\Admin\LocationHelper::getLocationPathDisplay( $arLocation["ID"] ) );?>

						<?else:?>
							<?=GetMessage("ASKARON_GEO_LOCATION_NOT_FOUND");?>
						<?endif?>


						<?//d( \Askaron\Geo\Info::aboutSxGeo() );?>
					</td>
				</tr>
			<?endif?>


			<?$tabControl->BeginNextTab();?>
			<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/admin/group_rights.php");?>
			<?$tabControl->Buttons();?>		
			<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>">
			<input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
			<?$tabControl->End();?>
		</form>

	<?
	}
}
?>