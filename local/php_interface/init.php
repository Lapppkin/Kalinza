<?php

use Bitrix\Main\EventManager;
use core\Helper;
use core\EventHandler;

### CONSTANTS

\define('BX_CUSTOM_TO_UPPER_FUNC', 'mb_strtoupper');
\define('BX_CUSTOM_TO_LOWER_FUNC', 'mb_strtolower');

\define('CATALOG_DEFAULT_IBLOCK_ID', 2); // ID инфоблока каталога по умолчанию
\define('REVIEWS_IBLOCK_ID', 14); // ID инфоблока отзывов

### AUTOLOAD

require \dirname(__DIR__, 2) . '/vendor/autoload.php';
\Dotenv\Dotenv::create(\dirname(__DIR__, 2), '.env')->load();
\CModule::IncludeModule('iblock');

### EVENT HANDLERS

EventManager::getInstance()->addEventHandlerCompatible(
    'main',
    'OnElilog',
    [EventHandler::class, 'Check404Error']
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
