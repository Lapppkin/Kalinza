<?php

namespace Sotbit\Regions\Helper;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Sotbit\Regions;

Loc::loadMessages(__FILE__);

class Menu
{
    public static function getAdminMenu(
        &$arGlobalMenu,
        &$arModuleMenu
    ) {

        $sites = Site::getList();
        $settings = [];
        $develop = [];
        foreach ($sites as $lid => $name) {
            $settings[$lid] = [
                "text"  => ' ['.$lid.'] '.$name,
                "url"   => '/bitrix/admin/sotbit_origami_settings.php?lang='
                    .LANGUAGE_ID.'&SITE_ID='.$lid,
                "title" => ' ['.$lid.'] '.$name,
            ];
            $develop[$lid] = [
                "text"  => ' ['.$lid.'] '.$name,
                "url"   => '/bitrix/admin/sotbit_origami_develop.php?lang='
                    .LANGUAGE_ID.'&SITE_ID='.$lid,
                "title" => ' ['.$lid.'] '.$name,
            ];
        }

        if (!isset($arGlobalMenu['global_menu_sotbit'])) {
            $arGlobalMenu['global_menu_sotbit'] = [
                'menu_id'   => 'sotbit',
                'text'      => Loc::getMessage(
                    \SotbitRegions::moduleId.'_GLOBAL_MENU'
                ),
                'title'     => Loc::getMessage(
                    \SotbitRegions::moduleId.'_GLOBAL_MENU'
                ),
                'sort'      => 1000,
                'items_id'  => 'global_menu_sotbit_items',
                "icon"      => "",
                "page_icon" => "",
            ];
        }

        $iModuleID = "sotbit.regions";
        global $APPLICATION;
        if ($APPLICATION->GetGroupRight($iModuleID) != "D") {

                $items=
                    array(
                            array(
                                "text" => GetMessage($iModuleID."_REGIONS_LIST"),
                                "url" => \SotbitRegions::regionsPath . "?lang=".LANGUAGE_ID,
                                "title" => GetMessage($iModuleID."_REGIONS_LIST"),
                                "items_id" => "menu_sotbit.regions_regions_path",
                                'more_url' => array(
                                    \SotbitRegions::regionPath,
                                ),
                            ),
                            array(
                                "text" => GetMessage($iModuleID."_SETTINGS_SITEMAP_GENERATIONG"),
                                "url" => \SotbitRegions::sitemapPath . "?lang=".LANGUAGE_ID,
                                "title" => GetMessage($iModuleID."_SETTINGS_SITEMAP_GENERATIONG"),
                                "items_id" => "menu_sotbit.regions_seo_files",
                                'more_url' => array(
                                    \SotbitRegions::regionPath,
                                ),
                            ),
                    );
            foreach ($sites as $lid => $site) {
                $Settings = array(
                    "text" => GetMessage($iModuleID."_SETTINGS") . ' [' . $lid .'] ' . $name,
                    "url" => \SotbitRegions::settingsPath . "?lang=".LANGUAGE_ID . "&site=" . $lid,
                    "title" => GetMessage($iModuleID."_SETTINGS") . ' [' . $lid .'] ' . $name,
//                    "items_id" => "menu_sotbit.regions_settings_path",
                    'more_url' => array(
                        \SotbitRegions::regionPath,
                    ),
                );
            }
        $items[] = $Settings;

            $aMenu = array(
                "parent_menu" => 'global_menu_sotbit',
                "section" => 'sotbit.regions',
                "sort" => 350,
                "text" => GetMessage("MENU_REGIONS_TEXT"),
                "title" => GetMessage("MENU_REGIONS_TITLE"),
                "icon" => "sotbit_regions_menu_icon",
                "page_icon" => "regions_page_icon",
                "items_id" => "menu_sotbit.regions",
                "dynamic" => true,
                'items' => $items,
            );

            $arGlobalMenu['global_menu_sotbit']['items']['sotbit.regions'] = $aMenu;
        }
    }
}

?>