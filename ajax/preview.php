<?

/**
 * Предпросмотр товара
 *
 * @author deadie
 *
 * @var $DB
 */

use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION, $USER;

$errors = [];

$application = Application::getInstance();
$context = $application->getContext();
$request = $context->getRequest();

$product_id = $request->getPost('product_id');

$APPLICATION->IncludeComponent('bitrix:catalog.element', 'preview', array(
    'IBLOCK_TYPE' => 'catalog',
    'IBLOCK_ID' => CATALOG_DEFAULT_IBLOCK_ID,
    'ELEMENT_ID' => $product_id,
    'PRICE_CODE' => array(
        0 => 'BASE',
    ),
    'SHOW_BASIS_PRICE' => 'Y',

), false);
