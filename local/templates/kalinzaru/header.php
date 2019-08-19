<? if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var \CMain $APPLICATION
 */

use Bitrix\Main\Page\Asset;

CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
$curDir = $APPLICATION->GetCurDir();

$isIndex = $curDir === '/';
$isCatalog = strpos($curDir, '/catalog/') === 0;

CModule::IncludeModule('mcart.souvenirs');
?>
<!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
    <head>
        <title><? $APPLICATION->ShowTitle() ?></title>
        <meta charset="UTF-8">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <? $APPLICATION->ShowHead() ?>
        <? Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles.css'); ?>
        <? Asset::getInstance()->addCss('https://fonts.googleapis.com/css?family=Oranienbaum&display=swap&subset=cyrillic,cyrillic-ext'); ?>

        <meta name="yandex-verification" content="a56dfc858ae0a85a">
    </head>
    <body>
        <div id="panel"><? $APPLICATION->ShowPanel() ?></div>

        <div id="svg-container" hidden></div>
        <div class="wrapper">

            <header id="header">

                <div class="header--topbar">
                    <div class="container">
                        <div class="row">
                            <div class="header--topbar--wrapper col-12">
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/header_topbar.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header--header">
                    <div class="container">
                        <div class="row">
                            <div class="header--header--wrapper col-12">
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/header.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </header>

            <nav id="navigation" class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="navigation--wrapper col-12">
                            <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/navigation.php'); ?>
                        </div>
                    </div>
                </div>
            </nav>

            <? if (!$isIndex): ?>
            <div id="breadcrumb" class="breadcrumb">
                <div class="container">
                    <div class="row">
                        <div class="col-12 breadcrumb--wrapper">
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:breadcrumb",
                                ".default",
                                array(
                                    "START_FROM" => "0",
                                    "PATH" => "",
                                    "SITE_ID" => "s1",
                                    "COMPONENT_TEMPLATE" => ".default",
                                ),
                                false,
                                array(
                                    "HIDE_ICONS" => "N",
                                )
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <? endif; ?>

            <main id="main">
                <div class="container">
                    <div class="row">
