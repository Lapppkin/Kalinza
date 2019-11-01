<?php

/**
 * Добавление в корзину.
 */

use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (\CModule::IncludeModule('sale') && \CModule::IncludeModule('catalog') && \CModule::IncludeModule('iblock')) {

    $application = Application::getInstance();
    $context = $application->getContext();
    $request = $context->getRequest();

    if ((int) $request->getPost('product_id') > 0 && (int) $request->getPost('quantity') > 0) {
        // Добавление в корзину
        echo \Add2BasketByProductID($request->getPost('product_id'), $request->getPost('quantity'));
    }
}

echo false;
