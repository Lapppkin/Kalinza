<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Config\Configuration;
use core\Helper;
use core\EventHandler;
use core\Regionality;

session_start();

### CONSTANTS

\define('BX_CUSTOM_TO_UPPER_FUNC', 'mb_strtoupper');
\define('BX_CUSTOM_TO_LOWER_FUNC', 'mb_strtolower');

$config = Configuration::getInstance()->get('siteconfig');

$region = Regionality::getRegionFromCookie();

\define('CATALOG_DEFAULT_IBLOCK_ID', $config['catalog']); // ID инфоблока каталога по умолчанию
\define('SLIDERS_IBLOCK_ID', $config['sliders']); // ID инфоблока слайдера
\define('REVIEWS_IBLOCK_ID', $config['reviews']); // ID инфоблока отзывов
\define('SHOPS_IBLOCK_ID', $config['shops']); // ID инфоблока магазинов
\define('REGION_ID', $region); // ID региона

### AUTOLOAD

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php';
\Dotenv\Dotenv::create($_SERVER['DOCUMENT_ROOT'], '.env')->load();
\CModule::IncludeModule('iblock');

### EVENT HANDLERS

EventManager::getInstance()->addEventHandlerCompatible(
    'main',
    'OnElilog',
    array(EventHandler::class, 'Check404Error')
);

### GLOBAL WRAPPERS

function dump($value, $public = false) {
    Helper::dump($value, $public);
}

function dd($value, $public = false) {
    Helper::dd($value, $public);
}

function renderIcon(string $name, string $class = '') {
    return Helper::renderIcon($name, $class);
}
