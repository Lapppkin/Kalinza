<?php

/**
 * @var \CMain $APPLICATION
 */

use Bitrix\Main\Page\Asset;
use Deadie\Helper;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CJSCore::Init(array("fx"));
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
        <!--<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        <?php $APPLICATION->ShowHead(); ?>
        <?php Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles.css'); ?>
        <?php //Asset::getInstance()->addCss('https://fonts.googleapis.com/css?family=Oranienbaum&display=swap&subset=cyrillic,cyrillic-ext'); ?>

        <meta name="yandex-verification" content="a56dfc858ae0a85a">
    </head>
    <body class="<?= $bodyClass ?>">
        <div id="panel"><?php $APPLICATION->ShowPanel() ?></div>

        <div id="svg-container" hidden></div>
        <div class="wrapper">

            <?php // АнтиСоветник
            $APPLICATION->IncludeComponent(
                "abricos:antisovetnik",
                "",
                array(),
                false
            ); ?>

            <!--header-->
            <header id="header">

                <!--header mobile-->
                <div class="header--mobile">
                    <div class="container">
                        <div class="row">
                            <div class="header--mobile--wrapper col-12">
                                <div class="header--mobile--menu">
                                    <?= Helper::renderIcon('menu') ?>
                                </div>
                                <div class="header--mobile--search">
                                    <a href="/search/">
                                        <?= Helper::renderIcon('search') ?>
                                    </a>
                                </div>
                                <div class="header--mobile--logo">
                                    <a href="/" title="Главная">
                                        <img src="<?= SITE_TEMPLATE_PATH . '/images/logo-mobile.svg' ?>" alt="KALINZA">
                                    </a>
                                </div>
                                <div class="header--mobile--cart">
                                    <div class="header-mobile--cart-icon">
                                        <?= Helper::renderIcon('shopping-cart') ?>
                                    </div>
                                    <div class="header--mobile--cart-counter">0</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

            <!--main-->
            <main id="main">
                <?php if ($APPLICATION->GetCurDir() !== '/'): ?>
                <div class="container">
                    <div class="row">
                <?php endif; ?>
