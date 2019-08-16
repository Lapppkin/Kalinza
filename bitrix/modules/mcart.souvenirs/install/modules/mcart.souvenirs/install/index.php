<?

IncludeModuleLangFile( __FILE__);
//if(class_exists("mcart_souvenirs")) return;

Class mcart_souvenirs extends CModule
{
	var $MODULE_ID = "mcart.souvenirs";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_GROUP_RIGHTS = "Y";

	function InstallDB()
    {
    return true;
    }
	
	function mcart_souvenirs() 
	{
		$arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)){
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }else{
            $this->MODULE_VERSION=MODULE_VERSION;
            $this->MODULE_VERSION_DATE=MODULE_VERSION_DATE;
        }

        $this->MODULE_NAME = GetMessage("MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("MODULE_DESCRIPTION");
        
        $this->PARTNER_NAME = GetMessage("PARTNER_NAME");
        $this->PARTNER_URI  = "http://mcart.ru/";
	}

	function DoInstall() 
	{ $this->InstallDB();
	global $APPLICATION, $step;
	if (CModule::IncludeModule('iblock'))
		{	
			
			$isnewiblock = IntVal($_REQUEST["isnewiblock"]);
			if($step < 2)
					{
						$APPLICATION->IncludeAdminFile(GetMessage("SOUVENIR_INSTALL_QUESTION"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.souvenirs/install/step1.php");	
					}
			elseif($step==2)
					{
					if ($isnewiblock==1)
							{	
							$prod_iblock_id = IntVal($_REQUEST["prod_id_iblock"]);
							if(!($_REQUEST["prod_id_iblock"]))
								$APPLICATION->IncludeAdminFile(GetMessage("SOUVENIR_STEP1_2_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.souvenirs/install/step1_2.php");
								
							$iblock_id	= 	$this->AddIB(GetMessage('SOUVENIRS'), 'souvenirs', $prod_iblock_id); 	
							if ($iblock_id)
							
								$step = 4;
							}
					else {$APPLICATION->IncludeAdminFile(GetMessage("SOUVENIR_STEP2_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.souvenirs/install/step2.php");
					
					//	
						}
					}
				
			if ($step==4)
			{
			
				if(!isset($iblock_id))
				$iblock_id = IntVal($_REQUEST["id_iblock"]);
						
						
							
				$handle = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/mcart.souvenirs/prolog.php", "w");
				fwrite($handle, '<?define("SOUVENIRS_IBLOCK_ID", '.$iblock_id.');?>');
				fclose($handle);
			
				
				RegisterModule("mcart.souvenirs");			
				
					
			}
		//return true;
		}
	}
	
	function DoUninstall()
	{	UnRegisterModule("mcart.souvenirs");
		
	}
	

	
	function AddIB($name, $code, $prod_iblock_id){
	
		$str_type = GetMessage("IBLOCK_TYPE_EN");
		$str_type_ru =GetMessage("IBLOCK_TYPE_RU");
		$db_iblock_type =CIBlockType::GetByID(GetMessage("IBLOCK_TYPE_ID"));
		if (!$db_iblock_type->Fetch())
			{$arFields = Array(
				'ID'=>GetMessage("IBLOCK_TYPE_ID"),
				'SECTIONS'=>'Y',
				'IN_RSS'=>'N',
				'SORT'=>100,
				'LANG'=>Array(
				'en'=>Array(
					'NAME'=>$str_type),
				'ru'=>Array(
					'NAME'=>$str_type_ru)
				)
			);

			$obBlocktype = new CIBlockType;
			if (!$res = $obBlocktype->Add($arFields))
				{
					echo "error:".$obBlocktype->LAST_ERROR;
					return false;
				}	
		}
		
		$ib = new CIBlock;
		$arFields = Array(
		"ACTIVE" => "Y",
		"NAME" => $name,
		"CODE" => $code,
		"IBLOCK_TYPE_ID" => GetMessage("IBLOCK_TYPE_ID"),
		"SITE_ID" => Array("s1") ,
		'WORKFLOW' => 'N');
		
		if (!($ID = $ib->Add($arFields)))
			{	
				return false;
			}
		else
			{
				$this-> FillIBlocks($ID, $prod_iblock_id);
				return $ID;
			}
		}

		
		function FillIBlocks($iblock_id, $prod_iblock_id=20)
	{
	
	$arFields=array(
		"0" => Array(	
		'IBLOCK_ID' => $iblock_id,
		'NAME'=> GetMessage('WITH_SECTION_RU'),
		'ACTIVE' => 'Y',
		'CODE' => GetMessage('WITH_SECTION_EN'),
		'PROPERTY_TYPE' => 'G',
		'MULTIPLE' => 'Y',
    	'LINK_IBLOCK_ID' => $prod_iblock_id
		),
		"1" => array(
		'IBLOCK_ID' => $iblock_id,
		'NAME'=> GetMessage('WITH_PROD_RU'),
		'ACTIVE' => 'Y',
		'CODE' => GetMessage('WITH_PROD_EN'),
		'PROPERTY_TYPE' => 'E',
		'MULTIPLE' => 'Y',
    	'LINK_IBLOCK_ID' => $prod_iblock_id
		),
		
	
	);
	
	$ibp = new CIBlockProperty;
	for ($key = 0, $size = count($arFields); $key < $size; $key++){
		$PropID = $ibp->Add($arFields[$key]);}
	}
		
} //end class
	?>	