<?php

\define('BX_CUSTOM_TO_UPPER_FUNC', 'mb_strtoupper');
\define('BX_CUSTOM_TO_LOWER_FUNC', 'mb_strtolower');

require \dirname(__DIR__, 2) . '/vendor/autoload.php';

\Dotenv\Dotenv::create(\dirname(__DIR__, 2), '.env')->load();

\CModule::IncludeModule('iblock');

\AddEventHandler('main', 'OnEpilog', [\core\EventHandler::class, 'Check404Error'], 1);
