<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# File: menu.php                                                                                           #
# Version: 1.0.1                                                                                           #
# (c) 2011-2017 Kreattika, Sedov S.Y.                                                                      #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?>
<?
use \Bitrix\Main\Localization\Loc;

$MODULE_ID = $module_id = GetModuleID(__FILE__);

if($APPLICATION->GetGroupRight($MODULE_ID) > "D")
{
    if(\Bitrix\Main\ModuleManager::isModuleInstalled($MODULE_ID) && !\Bitrix\Main\ModuleManager::isModuleInstalled('sale'))
    {
        IncludeModuleLangFile(__FILE__);

        $aMenu = array(
            array(
                "parent_menu" => "global_menu_services",
                "section" => "oneclickbuy_order",
                "sort" => 100,
                "text" => Loc::getMessage("KOCB_MENU_MAIN"),
                "title" => Loc::getMessage("KOCB_MENU_MAIN_TITLE"),
                "icon" => "oneclickbuy-list-ico",
                "module_id" => $MODULE_ID,
                "items_id" => "menu_oneclickbuy_order",
                /*"items" => $aMenuInnerItems,*/
                "url" => "kreattika_oneclickbuy_order.php?lang=".LANGUAGE_ID,
            )
        );

        return $aMenu;
    }
}
return false;
