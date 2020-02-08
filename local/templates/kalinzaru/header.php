<?php

/**
 * @var \CMain $APPLICATION
 */

use Bitrix\Main\Page\Asset;
use core\Helper;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

\CJSCore::Init(array('ajax', 'json', 'ls', 'session', 'jquery', 'popup', 'pull', 'core', 'fx'));

$bodyClass = Helper::setBodyClass($APPLICATION);
$curPage = $APPLICATION->GetCurPage(true);
$curDir = $APPLICATION->GetCurDir();

$isIndex = $curDir === '/';
$isCatalog = strpos($curDir, '/catalog/') === 0;

CModule::IncludeModule('mcart.souvenirs');
?>
<!doctype html>
<html lang="<?= LANGUAGE_ID ?>">
    <head>
        <title><?php $APPLICATION->ShowTitle(); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
        <?php $APPLICATION->ShowHead(); ?>
        <?php Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles.css'); ?>

        <meta name="yandex-verification" content="a56dfc858ae0a85a">

        <!-- Google Tag Manager -->
        <script data-skip-moving="true">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WLP4FB7');</script>
        <!-- End Google Tag Manager -->

    </head>
    <body class="<?= $bodyClass ?>">

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WLP4FB7"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '650438655759913');
            fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=650438655759913&ev=PageView&noscript=1"/></noscript>
        <!-- End Facebook Pixel Code -->

        <div id="panel"><?php $APPLICATION->ShowPanel() ?></div>

        <div id="svg-container" hidden></div>
        <div class="wrapper">

            <!--header-->
            <header id="header">

                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/header_mobile.php'); ?>

                <!--topbar-->
                <div class="header--topbar">
                    <div class="container">
                        <div class="row">
                            <div class="header--topbar--wrapper col-12">
                                <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/header_topbar.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!--header-->
                <div class="header--header">
                    <div class="container">
                        <div class="row">
                            <div class="header--header--wrapper col-12">
                                <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/header.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </header>
            <!--/header-->

            <!--menu-->
            <nav id="navigation" class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="navigation--wrapper col-12">
                            <?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/navigation.php'); ?>
                        </div>
                    </div>
                </div>
            </nav>
            <!--menu-->

            <!--main-->
            <main id="main">

                <?php if (!$isIndex): ?>
                    <!--breadcrumb-->
                    <div id="breadcrumb" class="breadcrumb">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 breadcrumb--wrapper">
                                    <?php
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
                    <!--/breadcrumb-->
                <?php endif; ?>

                <?php if ($APPLICATION->GetCurDir() !== '/'): ?>
                <div class="container">
                    <div class="row">
                <?php endif; ?>
