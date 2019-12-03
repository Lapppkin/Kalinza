<?php

use Bitrix\Main\Application;
use core\Regionality;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$response = [
    'error' => false,
];

$application = Application::getInstance();
$context = $application->getContext();
$request = $context->getRequest();

if (bitrix_sessid() !== $request->getPost('sessid')) {
    $response['error'] = true;
    goto ex;
}

$REGION_ID = (int) $request->getPost('REGION_ID');

if ($REGION_ID === 0) {
    $response['error'] = true;
    goto ex;
}

// Установка куки
setcookie('sotbit_regions_id', $REGION_ID, 0, '/');
Regionality::setRegionId($REGION_ID);
$response['region'] = $REGION_ID;

ex:
print json_encode($response);
