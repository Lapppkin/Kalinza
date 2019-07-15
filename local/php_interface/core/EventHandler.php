<?php

namespace core;

class EventHandler
{
    public static function Check404Error()
    {
        global $APPLICATION, $USER;

        if (\defined('ERROR_404') && ERROR_404 == 'Y' && !\defined('ADMIN_SECTION')) {
            $APPLICATION->RestartBuffer();

            require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/templates/' . SITE_TEMPLATE_ID . '/header.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/404.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/templates/' . SITE_TEMPLATE_ID . '/footer.php';
        }
    }
}