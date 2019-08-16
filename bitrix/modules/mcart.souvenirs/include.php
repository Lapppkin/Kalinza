<?
IncludeModuleLangFile(__FILE__);

include_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.souvenirs/prolog.php");


//AddEventHandler( 'sale', 'OnBeforeBasketAdd', Array("mcart_souvenirs_BasketOperations", 'mcart_souvenirs_OnBeforeBasketAdd' ));

	class mcart_souvenirs_BasketOperations{
		
		function mcart_souvenirs_OnBeforeBasketAdd($aFields ) {
			$handle = fopen($_SERVER["DOCUMENT_ROOT"]."/logsouvenir.txt", "a");
			fwrite($handle, print_r($aFields,1)."\n");
			$id = $aFields["PRODUCT_ID"];
			$res = CIBlockElement::GetByID($id);
			if($ar_res = $res->GetNext())
				
		{	$iblock_id = $ar_res['IBLOCK_ID'];
			fwrite($handle, "souvenir iblock id = ".SOUVENIRS_IBLOCK_ID."\n");
				if (!($iblock_id==SOUVENIRS_IBLOCK_ID))//если добавляемый элемент - ПОДАРОК, то ничего добавлять не нужно
					{
						$arTestFilter = Array("IBLOCK_ID"=>SOUVENIRS_IBLOCK_ID, "ACTIVE"=>"Y","CHECK_PERMISSIONS"=>"N"); //proverka - v Ib Podarki est xot odin aktivny element
						$testlist = CIBlockElement::GetList(Array(), $arTestFilter);
						if (intval($testlist->SelectedRowsCount())==0)
							return;
						
					fwrite($handle, "souvenir iblock id = ".SOUVENIRS_IBLOCK_ID."\n");
						$souvenir_id = false;
						$souvenir_section_id = $ar_res["IBLOCK_SECTION_ID"];
						
						$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","DETAIL_PAGE_URL","PROPERTY_with_section", "PROPERTY_with_prod");
						$arFilter = Array("IBLOCK_ID"=>SOUVENIRS_IBLOCK_ID, "ACTIVE"=>"Y","CHECK_PERMISSIONS"=>"N", "PROPERTY_WITH_PROD"=>$id);
						fwrite($handle, print_r($arFilter,1)."\n");
						$souvenir_list = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
						if ($ar_souvenir = $souvenir_list->GetNext())
							{$souvenir_id = $ar_souvenir["ID"];
							
							$souvenir_name = $ar_souvenir["NAME"];
							$souvenir_url = $ar_souvenir["DETAIL_PAGE_URL"];
							fwrite($handle, "souvenir founded: ".$ar_souvenir["NAME"]."[".$ar_souvenir["ID"]."]\n");
							}
						else
						
							{
							
									while ((!$souvenir_id)||($souvenir_section_id))
											{
												$arFilter = Array("IBLOCK_ID"=>SOUVENIRS_IBLOCK_ID, "ACTIVE"=>"Y", "=PROPERTY_WITH_SECTION"=>$souvenir_section_id);
												$souvenir_list = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
												if ($ar_souvenir = $souvenir_list->GetNext())
													{$souvenir_id = $ar_souvenir["ID"];
													$souvenir_name = $ar_souvenir["NAME"];
													$souvenir_url = $ar_souvenir["DETAIL_PAGE_URL"];
													fwrite($handle, "souvenir founded in section: ".$ar_souvenir["NAME"]."[".$ar_souvenir["ID"]."]\n");
													break;
													}
												
												else
												{
													$res = CIBlockSection::GetByID($souvenir_section_id);
													if($ar_res = $res->GetNext())
														{
														 $souvenir_section_id = $ar_res['IBLOCK_SECTION_ID'];
														if (!$souvenir_section_id)
															return;
														}
												}
											}		
							


							}
						if ($souvenir_id)
						{
							if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
								{
								fwrite($handle, "try souvenir add into basket \n");
								  $arProdFields = array(
									'PRODUCT_ID'  =>  $souvenir_id ,
										
										'PRICE'  =>  0,
										'CURRENCY'  =>  'RUB',
										
										'QUANTITY ' =>  1,
									  'LID'  =>  SITE_ID, //'s1',
										'DELAY'  =>  'N',
										'CAN_BUY'  =>  'Y',
										'NAME'  =>  $souvenir_name."  ".GetMessage("IS_SOUVENIR"),
										'DETAIL_PAGE_URL'  =>  $souvenir_url,
										
								  );

								  $basket_rec_id = CSaleBasket::Add($arProdFields);
								  if (intval($basket_rec_id)==0)
									fwrite($handle, "souvenir don't check fields \n");
else
fwrite($handle, "souvenir id =".$basket_rec_id." and prod id ".$arFields["ID"]."=  \n");
								}
						}
					}
				
		}
	
		
}
}	




?>