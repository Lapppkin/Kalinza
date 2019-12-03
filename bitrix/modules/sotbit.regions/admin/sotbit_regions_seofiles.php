<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

require_once($_SERVER['DOCUMENT_ROOT']
    .'/bitrix/modules/main/include/prolog_admin_before.php');
require($_SERVER['DOCUMENT_ROOT']
    .'/bitrix/modules/main/include/prolog_admin_after.php');


Loc::loadMessages(__FILE__);

if (!Loader::includeModule('sotbit.regions')) {
    return false;
}


if ($run_sitemap == 'Y') {
    $sitemap = new Sotbit\Regions\Seo\Sitemap($site_id);
    $rs = $sitemap->run();
    if ($rs->isSuccess()) {
        LocalRedirect(BX_ROOT."/admin/sotbit_regions_seofiles.php?lang="
            .LANGUAGE_ID.'&sitemap_ok=Y');
    } else {
        $errors = $rs->getErrors();
        foreach($errors as $error){
            $code = $error->getCode();
            break;
        }
        LocalRedirect(BX_ROOT."/admin/sotbit_regions_seofiles.php?lang="
            .LANGUAGE_ID.'&sitemap_error='.$code);
    }
}

if ($run_robots == 'Y') {
    $robots = new Sotbit\Regions\Seo\Robots();
    $rs = $robots->run();
    if ($rs->isSuccess()) {
        LocalRedirect(BX_ROOT."/admin/sotbit_regions_seofiles.php?lang="
            .LANGUAGE_ID.'&robots_ok=Y');
    }
    else{
        $errors = $rs->getErrors();
        foreach($errors as $error){
            $code = $error->getCode();
            break;
        }
        LocalRedirect(BX_ROOT."/admin/sotbit_regions_seofiles.php?lang="
            .LANGUAGE_ID.'&robots_error='.$code);
    }
}

if ($sitemap_ok == 'Y') {
    CAdminMessage::ShowNote(Loc::getMessage(SotbitRegions::moduleId
        .'_SITEMAP_SUCCESS'));
} elseif ($sitemap_error > 0) {
    CAdminMessage::ShowMessage([
        "MESSAGE" => Loc::getMessage(SotbitRegions::moduleId.'_SITEMAP_ERROR_'
            .$sitemap_error),
        "TYPE"    => "",
    ]);
}
if ($robots_ok == 'Y') {
    CAdminMessage::ShowNote(Loc::getMessage(SotbitRegions::moduleId
        .'_ROBOTS_SUCCESS'));
}
elseif ($robots_error > 0) {
    CAdminMessage::ShowMessage([
        "MESSAGE" => Loc::getMessage(SotbitRegions::moduleId.'_ROBOTS_ERROR_'
            .$robots_error),
        "TYPE"    => "",
    ]);
}


$sites = SotbitRegions::getSites();

$actions = [];
foreach ($sites as $lid => $name) {
    $actions[] = [
        'TEXT' => '['.$lid.'] '.$name,
        'LINK' => 'sotbit_regions_seofiles.php?lang='.LANGUAGE_ID
            .'&run_sitemap=Y&site_id='.$lid,
    ];
}

echo '<h3>'.Loc::getMessage(SotbitRegions::moduleId.'_SITEMAP_TITLE').'</h3>';


$aContext = [];
$aContext[] = [
    'TEXT'  => Loc::getMessage(SotbitRegions::moduleId.'_SITEMAP_GEN'),
    'TITLE' => Loc::getMessage(SotbitRegions::moduleId.'_SITEMAP_GEN'),
    'ICON'  => 'btn_new',
    'MENU'  => $actions,
];
$lAdminSitemap = new CAdminList('', []);
$lAdminSitemap->AddAdminContextMenu($aContext, false, false);
$lAdminSitemap->DisplayList();


echo '<h3>'.Loc::getMessage(SotbitRegions::moduleId.'_ROBOTS_TITLE').'</h3>';
$aContext = [];
$aContext[] = [
    'TEXT'  => Loc::getMessage(SotbitRegions::moduleId.'_ROBOTS_GEN'),
    'TITLE' => Loc::getMessage(SotbitRegions::moduleId.'_ROBOTS_GEN'),
    'ICON'  => 'btn_new',
    'LINK'  => 'sotbit_regions_seofiles.php?lang='.LANGUAGE_ID.'&run_robots=Y',
    'MENU'  => [],
];
$lAdminRobots = new CAdminList('', []);
$lAdminRobots->AddAdminContextMenu($aContext, false, false);
$lAdminRobots->DisplayList();

require($_SERVER['DOCUMENT_ROOT']
    .'/bitrix/modules/main/include/epilog_admin.php');
?>