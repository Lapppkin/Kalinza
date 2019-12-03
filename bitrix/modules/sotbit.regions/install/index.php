<?
use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Loader;
use Bitrix\Main\SiteTable;

Loc::loadMessages(__FILE__);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client_partner.php");
class sotbit_regions extends CModule
{
    const MODULE_ID = 'sotbit.regions';
    var $MODULE_ID = 'sotbit.regions';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;

    var $MODULE_NAME;

    var $MODULE_DESCRIPTION;

    var $MODULE_CSS;

    var $strError = '';

    function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__ . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = Loc::getMessage(self::MODULE_ID . '_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage(self::MODULE_ID . '_MODULE_DESC');
        $this->PARTNER_NAME = GetMessage('sotbit.regions_PARTNER_NAME');
        $this->PARTNER_URI = GetMessage('sotbit.regions_PARTNER_URI');
    }

    function InstallEvents()
    {
        EventManager::getInstance()->registerEventHandler(
            "sale",
            "OnSaleComponentOrderProperties",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnSaleComponentOrderPropertiesHandler');
        EventManager::getInstance()->registerEventHandler(
            "main",
            "OnEndBufferContent",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnEndBufferContentHandler',
            999);
        EventManager::getInstance()->registerEventHandler(
            "main",
            "OnUserTypeBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnUserTypeBuildListHandlerHtml');
        EventManager::getInstance()->registerEventHandler(
            "main",
            "OnProlog",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnPrologHandler');
        EventManager::getInstance()->registerEventHandler(
            "iblock",
            "OnIBlockPropertyBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnIBlockPropertyBuildListHandler');
        EventManager::getInstance()->registerEventHandler(
            "catalog",
            "OnGetOptimalPrice",
            'main',//hack, if demo end cannot load module and add to basket
            '\Sotbit\Regions\EventHandlers',
            'OnGetOptimalPriceHandler',
            100,
            '/modules/sotbit.regions/lib/eventhandlers.php');
        EventManager::getInstance()->registerEventHandler(
            "sale",
            "onSaleDeliveryRestrictionsClassNamesBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'onSaleDeliveryRestrictionsClassNamesBuildListHandler');
        EventManager::getInstance()->registerEventHandler(
            "sale",
            "onSalePaySystemRestrictionsClassNamesBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'onSalePaySystemRestrictionsClassNamesBuildListHandler');
        EventManager::getInstance()->registerEventHandler(
            'sale',
            'OnSaleOrderBeforeSaved',
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnSaleOrderBeforeSavedHandler');
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnBeforeEventAdd',
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnBeforeEventAddHandler');
        EventManager::getInstance()->registerEventHandler(
            'main',
            'OnBeforeMailSend',
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnBeforeMailSendHandler');
        EventManager::getInstance()->registerEventHandler(
            "main",
            "OnBuildGlobalMenu",
            self::MODULE_ID,
            '\Sotbit\Regions\EventHandlers',
            'OnBuildGlobalMenuHandler');

        $rs = SiteTable::getList(
            array(
                'filter' => array(
                    'ACTIVE' => 'Y'
                )
            )
        );
        while($site = $rs->fetch())
        {
            $this->SotbitRegionsInstallData($site['LID']);
            $this->SotbitRegionsSetSettings($site['LID']);
        }

        return true;
    }

    function UnInstallEvents()
    {
        EventManager::getInstance()->unRegisterEventHandler(
            "sale",
            "OnSaleComponentOrderProperties",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnSaleComponentOrderPropertiesHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            "main",
            "OnEndBufferContent",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnEndBufferContentHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            "main",
            "OnUserTypeBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnUserTypeBuildListHandlerHtml');
        EventManager::getInstance()->unRegisterEventHandler(
            "main",
            "OnProlog",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnPrologHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            "iblock",
            "OnIBlockPropertyBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnIBlockPropertyBuildListHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            "catalog",
            "OnGetOptimalPrice",
            'main',
            '\Sotbit\Regions\EventHandlers',
            'OnGetOptimalPriceHandler',
            '/modules/sotbit.regions/lib/eventhandlers.php');
        EventManager::getInstance()->unRegisterEventHandler(
            "sale",
            "onSaleDeliveryRestrictionsClassNamesBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'onSaleDeliveryRestrictionsClassNamesBuildListHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            "sale",
            "onSalePaySystemRestrictionsClassNamesBuildList",
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'onSalePaySystemRestrictionsClassNamesBuildListHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            'sale',
            'OnSaleOrderBeforeSaved',
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnSaleOrderBeforeSavedHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnBeforeEventAdd',
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnBeforeEventAddHandler');
        EventManager::getInstance()->unRegisterEventHandler(
            'main',
            'OnBeforeMailSend',
            'sotbit.regions',
            '\Sotbit\Regions\EventHandlers',
            'OnBeforeMailSendHandler');
        EventManager::getInstance()->unregisterEventHandler(
            "main",
            "OnBuildGlobalMenu",
            self::MODULE_ID,
            '\Sotbit\Regions\EventHandlers',
            'OnBuildGlobalMenuHandler');
        return true;
    }

    function InstallFiles($arParams = array())
    {
        CopyDirFiles( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/themes/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/", true, true );
        CopyDirFiles( $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/admin', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin', true );
        if(is_dir( $p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default' ))
        {
            if($dir = opendir( $p ))
            {
                while( false!==$item = readdir( $dir ) )
                {
                    if($item=='..'||$item=='.')
                        continue;
                    CopyDirFiles( $p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/themes/.default/'.$item, $ReWrite = True, $Recursive = True );
                }
                closedir( $dir );
            }
        }
        if(is_dir( $p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components' ))
        {
            if($dir = opendir( $p ))
            {
                while( false!==$item = readdir( $dir ) )
                {
                    if($item=='..'||$item=='.')
                        continue;
                    CopyDirFiles( $p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/'.$item, $ReWrite = True, $Recursive = True );
                }
                closedir( $dir );
            }
        }
        if(is_dir( $p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/local' ))
        {
            if($dir = opendir( $p ))
            {
                while( false!==$item = readdir( $dir ) )
                {
                    if($item=='..'||$item=='.')
                        continue;
                    CopyDirFiles( $p.'/'.$item, $_SERVER['DOCUMENT_ROOT'].'/local/'.$item, $ReWrite = True, $Recursive = True );
                }
                closedir( $dir );
            }
        }
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFiles( $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/admin', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin' );
        DeleteDirFiles( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/themes/.default/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default" );
        if(is_dir( $p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/themes/.default/' ))
        {
            if($dir = opendir( $p ))
            {
                while( false!==$item = readdir( $dir ) )
                {
                    if($item=='..'||$item=='.'||!is_dir( $p0 = $p.'/'.$item ))
                        continue;
                    $dir0 = opendir( $p0 );
                    while( false!==$item0 = readdir( $dir0 ) )
                    {
                        if($item0=='..'||$item0=='.')
                            continue;
                        DeleteDirFilesEx( '/bitrix/themes/.default/'.$item.'/'.$item0 );
                    }
                    closedir( $dir0 );
                }
                closedir( $dir );
            }
        }
        if(is_dir( $p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components' ))
        {
            if($dir = opendir( $p ))
            {
                while( false!==$item = readdir( $dir ) )
                {
                    if($item=='..'||$item=='.'||!is_dir( $p0 = $p.'/'.$item ))
                        continue;
                    $dir0 = opendir( $p0 );
                    while( false!==$item0 = readdir( $dir0 ) )
                    {
                        if($item0=='..'||$item0=='.')
                            continue;
                        DeleteDirFilesEx( '/bitrix/components/'.$item.'/'.$item0 );
                    }
                    closedir( $dir0 );
                }
                closedir( $dir );
            }
        }
        if(is_dir( $p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/local/' ))
        {
            if($dir = opendir( $p ))
            {
                while( false!==$item = readdir( $dir ) )
                {
                    if($item=='..'||$item=='.'||!is_dir( $p0 = $p.'/'.$item ))
                        continue;
                    $dir0 = opendir( $p0 );
                    while( false!==$item0 = readdir( $dir0 ) )
                    {
                        if($item0=='..'||$item0=='.')
                            continue;
                        DeleteDirFilesEx( '/local/'.$item.'/'.$item0 );
                    }
                    closedir( $dir0 );
                }
                closedir( $dir );
            }
        }
        return true;
    }

    function installDB()
    {
        global $DB;
        $DB->runSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/db/' . strtolower($DB->type) . '/install.sql');
    }

    function UnInstallDB()
    {
        global $DB;
        $DB->runSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/db/' . strtolower($DB->type) . '/uninstall.sql');
    }

    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->InstallFiles();
        $this->InstallDB();
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
            ModuleManager::registerModule(self::MODULE_ID);
            $this->InstallEvents();
        }
        else
        {
            $APPLICATION->IncludeAdminFile(GetMessage("INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sotbit.regions/install/step.php");
        }

    }

    function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $rs = SiteTable::getList(
            array(
                'filter' => array(
                    'ACTIVE' => 'Y'
                )
            )
        );
        while($site = $rs->fetch())
        {
            $this->unInstallData($site['LID']);
        }
        ModuleManager::unRegisterModule(self::MODULE_ID);
    }



    function unInstallData($lid)
    {
        $obUserField = new \CUserTypeEntity;
        $rs = $obUserField->GetList(array(), array('ENTITY_ID' => 'SOTBIT_REGIONS'));
        while ($userField = $rs->Fetch())
        {
            $res = $obUserField->Delete($userField['ID']);
        }
        return true;
    }


    function SotbitRegionsInstallData($lid = '')
    {

        $this->SotbitRegionsInstallProperties($lid);
        $this->SotbitRegionsInstallDomains($lid);
        $this->SotbitRegionsInstallFavorites($lid);

        return true;
    }

    function SotbitRegionsInstallProperties($lid)
    {
        $langs = array();
        $rsLanguage = CLanguage::GetList($by, $order, array());
        while ($arLanguage = $rs = $rsLanguage->Fetch())
        {
            $langs[] = htmlspecialcharsbx($arLanguage["LID"]);
        }

        $obUserField = new \CUserTypeEntity;

        $arFields = array(
            "ENTITY_ID" => 'SOTBIT_REGIONS',
            "SORT" => 100,
            "MULTIPLE" => 'N',
            "MANDATORY" => 'N',
            "SHOW_FILTER" => 'N',
            "SHOW_IN_LIST" => 'Y',
            "EDIT_IN_LIST" => 'Y',
            "IS_SEARCHABLE" => 'N',
            "SETTINGS" => array(),
            "EDIT_FORM_LABEL" => array(),
            "LIST_COLUMN_LABEL" => array(),
            "LIST_FILTER_LABEL" => array(),
            "ERROR_MESSAGE" => array(),
            "HELP_MESSAGE" => array(),
        );

        $props = array(
            'PHONE' => array(
                "FIELD_NAME" => 'UF_PHONE',
                'USER_TYPE_ID' => 'string',
                'MULTIPLE' => 'Y'
            ),
            'ADDRESS' => array(
                "FIELD_NAME" => 'UF_ADDRESS',
                'USER_TYPE_ID' => 'html',
            ),
            'EMAIL' => array(
                "FIELD_NAME" => 'UF_EMAIL',
                'USER_TYPE_ID' => 'string',
                'MULTIPLE' => 'Y'
            ),
        );

        foreach ($props as $code => $prop)
        {
            $arFieldsMerged = array_merge($arFields, $prop);
            foreach ($langs as $lang)
            {
                $arFieldsMerged['EDIT_FORM_LABEL'][$lang] = Loc::getMessage('sotbit.regions_PROP_' . $code);
                $arFieldsMerged['LIST_COLUMN_LABEL'][$lang] = Loc::getMessage('sotbit.regions_PROP_' . $code);
                $arFieldsMerged['LIST_FILTER_LABEL'][$lang] = Loc::getMessage('sotbit.regions_PROP_' . $code);
                $arFieldsMerged['ERROR_MESSAGE'][$lang] = Loc::getMessage('sotbit.regions_PROP_' . $code);
                $arFieldsMerged['HELP_MESSAGE'][$lang] = Loc::getMessage('sotbit.regions_PROP_' . $code);
            }
            $ID = $obUserField->Add($arFieldsMerged);
        }
    }

    function SotbitRegionsInstallDomains($lid)
    {
        $priceCodes = array();
        $stores = array();
        if(Loader::includeModule('catalog'))
        {
            $rs = \CCatalogGroup::GetList(array(), array('ACTIVE' => 'Y'));
            while ($priceCode = $rs->Fetch())
            {
                $priceCodes[] = $priceCode['NAME'];
            }
            $rs = \CCatalogStore::GetList(
                array(),
                array(
                    'ISSUING_CENTER' => 'Y',
                    'ACTIVE' => 'Y'
                ),
                false,
                false,
                array('ID')
            );
            while ($store = $rs->Fetch())
            {
                $stores[] = $store['ID'];
            }
        }

        $domens = array(
            '',
            'spb',
            'sochi',
            'pyatigorsk',
            'voronezh',
            'krasnodar',
            'samara',
            'rostov',
            'ufa',
            'kaluga',
            'kazan',
            'stavropol',
            'nn'
        );

        $context = Bitrix\Main\Application::getInstance()->getContext();
        $server = $context->getServer();
        $currentDomain = $server->getServerName();
        $http = (!empty($_SERVER['HTTPS']) && 'off' !== strtolower($_SERVER['HTTPS']))?'https://':'http://';

        global $DB;

        foreach ($domens as $k => $domen)
        {
            if(!empty($domen))
            {
                $xdomen=$domen.'.';
            }
            else
            {
                $xdomen = $domen;
            }
            $url = $http.$xdomen.$currentDomain;
            $row = array(
                'CODE' => $url,
                'NAME' => Loc::getMessage('sotbit.regions_DOMEN_'.$domen),
                'SORT' => 100,
                'PRICE_CODE' => $priceCodes,
                'STORE' => $stores,
                'SITE_ID' => [$lid]
            );
            if($k == 0)
                $defDomain = "'Y'";
            else
                $defDomain = "NULL";

            $DB->Query("INSERT INTO `sotbit_regions` VALUES (NULL,'".$row['CODE']."', '".$row['NAME']."', 100, '".serialize($row['SITE_ID'])."', '".serialize($row['PRICE_CODE'])."', '".serialize($row['STORE'])."', NULL, NULL, NULL, NULL, NULL, NULL, ".$defDomain.");");
            $id = intval($DB->LastID());
            if($id > 0)
            {
                $kod = '+7(495)';
                switch ($domen)
                {
                    case 'spb':
                        $kod = '+7 (812) ';
                        break;
                    case 'sochi':
                        $kod = '+7 (8622) ';
                        break;
                    case 'pyatigorsk':
                        $kod = '+7 (8793) ';
                        break;
                    case 'voronezh':
                        $kod = '+7 (4732) ';
                        break;
                    case 'krasnodar':
                        $kod = '+7 (861) ';
                        break;
                    case 'samara':
                        $kod = '+7 (846) ';
                        break;
                    case 'rostov':
                        $kod = '+7 (863) ';
                        break;
                    case 'ufa':
                        $kod = '+7 (347) ';
                        break;
                    case 'kaluga':
                        $kod = '+7 (4842) ';
                        break;
                    case 'kazan':
                        $kod = '+7 (843) ';
                        break;
                    case 'stavropol':
                        $kod = '+7 (8652) ';
                        break;
                    case 'nn':
                        $kod = '+7 (831) ';
                        break;
                }

                if(strlen($kod) == 9 )
                {
                    $val = array($kod.'111-11-11',$kod.'222-22-22');
                }
                else
                {
                    $val = array($kod.'11-11-11',$kod.'22-22-22');
                }

                $DB->Query("INSERT INTO `sotbit_regions_fields` VALUES (NULL,".$id.", 'UF_PHONE', '".serialize($val)."');");
                $DB->Query("INSERT INTO `sotbit_regions_fields` VALUES (NULL,".$id.", 'UF_ADDRESS', '".Loc::getMessage('sotbit.regions_ADDRESS',array('#HOME#' => rand(1,50)))."');");
                $DB->Query("INSERT INTO `sotbit_regions_fields` VALUES (NULL,".$id.", 'UF_EMAIL', '".serialize(['sales@'.$xdomen.$currentDomain])."');");

                if(Loader::includeModule('sale')){
                    $location = \Bitrix\Sale\Location\LocationTable::getList([
                        'filter' => [
                            '=NAME.NAME'        => Loc::getMessage('sotbit.regions_LOCATION_'.$domen),
                            '=NAME.LANGUAGE_ID' => LANGUAGE_ID,
                        ],
                        'select' => [
                            '*',
                            'NAME.*',
                        ],
                        'cache'  => [
                            'ttl' => 36000000,
                        ],
                    ])->fetch();
                    if ($location['ID'] > 0) {
                        $DB->Query("INSERT INTO `sotbit_regions_locations` VALUES (NULL,".$id.",".$location['ID'].");");
                    }

                    if($domen == ''){
                        $location = \Bitrix\Sale\Location\LocationTable::getList([
                            'filter' => [
                                '=NAME.NAME'        => Loc::getMessage('sotbit.regions_LOCATION_MOSCOW'),
                                '=NAME.LANGUAGE_ID' => LANGUAGE_ID,
                            ],
                            'select' => [
                                '*',
                                'NAME.*',
                            ],
                            'cache'  => [
                                'ttl' => 36000000,
                            ],
                        ])->fetch();
                    }
                    if ($location['ID'] > 0) {
                        $DB->Query("INSERT INTO `sotbit_regions_locations` VALUES (NULL,".$id.",".$location['ID'].");");
                    }
                }
            }
        }
    }

    function SotbitRegionsSetSettings($lid)
    {
        global $DB;
        $DB->Query("INSERT INTO `sotbit_regions_options` VALUES ('SINGLE_DOMAIN','Y', '".$lid."');");
        if(Loader::includeModule('statistic'))
        {
            $DB->Query("INSERT INTO `sotbit_regions_options` VALUES ('FIND_USER_METHOD','statistic', '".$lid."');");
        }
        elseif(function_exists('curl_version'))
        {
            $DB->Query("INSERT INTO `sotbit_regions_options` VALUES ('FIND_USER_METHOD','ipgeobase', '".$lid."');");
        }
        else
        {
            $DB->Query("INSERT INTO `sotbit_regions_options` VALUES ('FIND_USER_METHOD','geoip','".$lid."');");
        }
        $DB->Query("INSERT INTO `sotbit_regions_options` VALUES ('INSERT_SALE_LOCATION','N', '".$lid."');");
        $DB->Query("INSERT INTO `sotbit_regions_options` VALUES ('MULTIPLE_DELIMITER',', ', '".$lid."');");
    }

    function SotbitRegionsInstallFavorites($lid){
        if(Loader::includeModule('sale')){
            $cities = [
                'MOSCOW',
                'KALUGA',
                'KAZAN',
                'KRASNODAR',
                'NN',
                'PYATIGORSK',
                'ROSTOV_NA_DONY',
                'SAMARA',
                'SOCHI',
                'SP',
                'STAVROPOL',
                'UFA',
                'VORONEG',
            ];
            foreach ($cities as $city){
                $location = \Bitrix\Sale\Location\LocationTable::getList([
                    'filter' => [
                        '=NAME.NAME'        => Loc::getMessage('sotbit.regions_FAVORITE_'.$city),
                        '=NAME.LANGUAGE_ID' => LANGUAGE_ID,
                    ],
                    'select' => [
                        '*',
                        'NAME.*',
                    ],
                    'cache'  => [
                        'ttl' => 36000000,
                    ],
                ])->fetch();
                if($location['CODE']){
                    $checkIt = \Bitrix\Sale\Location\DefaultSiteTable::getList([
                        'filter' => [
                            'LOCATION_CODE' => $location['CODE'],
                            'SITE_ID' => $lid
                        ]
                    ])->getSelectedRowsCount();
                    if( $checkIt == 0 )
                        \Bitrix\Sale\Location\DefaultSiteTable::add(['SORT' => 100,'LOCATION_CODE' => $location['CODE'],'SITE_ID' => $lid]);
                }
            }
        }
    }
}
?>