<?
use \Bitrix\Main\ModuleManager;

IncludeModuleLangFile(__FILE__);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client_partner.php");

Class sotbit_mailing extends CModule
{
    const MODULE_ID = 'sotbit.mailing';
    var $MODULE_ID = 'sotbit.mailing'; 
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $strError = '';

    function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__)."/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = GetMessage("sotbit.mailing_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("sotbit.mailing_MODULE_DESC");

        $this->PARTNER_NAME = GetMessage("sotbit.mailing_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("sotbit.mailing_PARTNER_URI");
    }

    function InstallDB($arParams = array())
    {
        global $DB, $DBType, $APPLICATION;
        //RegisterModule(self::MODULE_ID);
              
        $this->errors = false;

        if(!$DB->Query("SELECT 'x' FROM b_sotbit_mailing_event", true))
        {
            $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/".$DBType."/install.sql");
        }
        
        if($this->errors !== false)
        {
            $APPLICATION->ThrowException(implode("", $this->errors));
            return false;
        }  
        
        // �������� ��������� ������ �������
        $EXPIRATION_PROCESSING_EVENTS = COption::GetOptionString('sale','expiration_processing_events');
        if(!empty($EXPIRATION_PROCESSING_EVENTS) && $EXPIRATION_PROCESSING_EVENTS != 'Y'){
            COption::SetOptionString('sale','expiration_processing_events','Y');
        }          
        
        
        RegisterModuleDependences("main", "OnPageStart", self::MODULE_ID, 'CSotbitMailingHelp', 'OnPageStart');
        RegisterModuleDependences("main", "OnAfterEpilog", self::MODULE_ID, 'CSotbitMailingHelp', 'OnAfterEpilog');
        RegisterModuleDependences("sale", "OnOrderAdd", self::MODULE_ID, 'CSotbitMailingHelp', 'OnOrderAdd');
             
        // connectors subscrubers of module mailing
        RegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListMainUser");
        RegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListSaleBuyer");  
        RegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListFormResult");          
        RegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListSubscriber");    

         
                
        CAgent::AddAgent("CSotbitMailingTools::AgentMailingNeedAction();", self::MODULE_ID, "N", 14400, "", "Y");
        
        return true;
    }

    function UnInstallDB($arParams = array())
    {
        
        global $DB, $DBType, $APPLICATION;
        
        
        
        $this->errors = false;
        if(array_key_exists("savedata", $arParams) && $arParams["savedata"] != "Y")
        {
            $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/".$DBType."/uninstall.sql");

            if($this->errors !== false)
            {
                $APPLICATION->ThrowException(implode("", $this->errors));
                return false;
            }
        }  
        
        
        UnRegisterModuleDependences("main", "OnPageStart", self::MODULE_ID, 'CSotbitMailingHelp', 'OnPageStart');
        UnRegisterModuleDependences("main", "OnAfterEpilog", self::MODULE_ID, 'CSotbitMailingHelp', 'OnAfterEpilog');
        UnRegisterModuleDependences("sale", "OnOrderAdd", self::MODULE_ID, 'CSotbitMailingHelp', 'OnOrderAdd');        
        
        // connectors subscrubers of module mailing 
        UnRegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListMainUser");
        UnRegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListSaleBuyer");  
        UnRegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListFormResult");          
        UnRegisterModuleDependences(self::MODULE_ID, "OnSubConnectorList", self::MODULE_ID, "sotbit\\mailing\\subconnectormanager", "onSubConnectorListSubscriber");           
        
        
                
        CAgent::RemoveModuleAgents(self::MODULE_ID);
        UnRegisterModule(self::MODULE_ID);   
        
        return true;
    }

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles($arParams = array())
    {
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/admin', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin', true);  
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/themes/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/local/", $_SERVER["DOCUMENT_ROOT"]."/local/", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/other/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/.default/components/bitrix/", true, true);
        
        COption::SetOptionString("sotbit.mailing", "TEMPLATE_MAILING_THEME_DEF", "sotbit_mailing_default_mail");
        
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
        {
            if ($dir = opendir($p))
            {
                while (false !== $item = readdir($dir))
                {
                    if ($item == '..' || $item == '.')
                        continue;
                    CopyDirFiles($p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True);
                }
                closedir($dir);
            }
        }
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/admin', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin');
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/themes/.default/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default");
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/local", $_SERVER["DOCUMENT_ROOT"]."/local");
        DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/other/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/.default/components/bitrix/");
           
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components'))
        {
            if ($dir = opendir($p))
            {
                while (false !== $item = readdir($dir))
                {
                    if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item))
                        continue;

                    $dir0 = opendir($p0);
                    while (false !== $item0 = readdir($dir0))
                    {
                        if ($item0 == '..' || $item0 == '.')
                            continue;
                        DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
                    }
                    closedir($dir0);
                }
                closedir($dir);
            }
        }
        return true;
    }

    function DoInstall()
    {
        global $APPLICATION;
        $this->InstallDB();
        $this->InstallFiles();
        
        //$APPLICATION->IncludeAdminFile(GetMessage("sotbit.mailing_MODULE_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/step.php");

        if($_REQUEST['step'] == 1)
		{
			if($_SERVER['SERVER_NAME']){
				$site = $_SERVER['SERVER_NAME'];
			}
			elseif($_SERVER['HTTP_HOST']){
				$site = $_SERVER['HTTP_HOST'];
			}
			$str = '';
			$arUpdateList = \CUpdateClient::GetUpdatesList($str);
			$request = array(
				'ACTION' => 'ADD',
				'SITE' => $site,
				'KEY' => md5("BITRIX".\CUpdateClientPartner::GetLicenseKey()."LICENCE"),
				'LICENSE' => $arUpdateList["CLIENT"][0]["@"]["LICENSE"],
				'MODULE' => self::MODULE_ID,
				'NAME' => $_REQUEST['Name'],
				'EMAIL' => $_REQUEST['Email'],
				'PHONE' => $_REQUEST['Phone'],
				'BITRIX_DATE_FROM' => $arUpdateList["CLIENT"][0]["@"]["DATE_FROM"],
				'BITRIX_DATE_TO' => $arUpdateList["CLIENT"][0]["@"]["DATE_TO"],
			);
			$options = array (
				'http' => array (
					'method' => 'POST',
					'header' => "Content-Type: application/json; charset=utf-8\r\n",
					'content' => json_encode($request)
				)
			);

			$context = stream_context_create($options);
			$answer =  file_get_contents('https://www.sotbit.ru:443/api/datacollection/index.php', 0, $context);
			ModuleManager::registerModule( self::MODULE_ID );
		}
		else
		{
			$APPLICATION->IncludeAdminFile(GetMessage("INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sotbit.mailing/install/step.php");
		}
    }

    function DoUninstall()
    {
        global $APPLICATION, $step;

        $step = IntVal($step);
        if($step<2)
        {
            $APPLICATION->IncludeAdminFile(GetMessage("sotbit.mailing_MODULE_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/unstep1.php");
        }
        elseif($step==2)
        {       
            $this->UnInstallDB(array(
                "savedata" => $_REQUEST["savedata"],
            ));
            $this->UnInstallFiles();

            $GLOBALS["errors"] = $this->errors;

            $APPLICATION->IncludeAdminFile(GetMessage("sotbit.mailing_MODULE_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/unstep2.php");
        }
    }
}

?>