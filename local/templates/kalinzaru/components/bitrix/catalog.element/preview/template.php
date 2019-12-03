<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use core\Helper;

$this->setFrameMode(true);
$templateLibrary = ['popup'];
$currencyList    = '';
if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList      = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = [
    'TEMPLATE_THEME'   => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS'   => 'bx_' . $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES'       => $currencyList,
];
unset($currencyList, $templateLibrary);

$strMainID              = $this->GetEditAreaId($arResult['ID']);
$arItemIDs              = [
    'ID'                 => $strMainID,
    'PICT'               => $strMainID . '_pict',
    'DISCOUNT_PICT_ID'   => $strMainID . '_dsc_pict',
    'STICKER_ID'         => $strMainID . '_sticker',
    'BIG_SLIDER_ID'      => $strMainID . '_big_slider',
    'BIG_IMG_CONT_ID'    => $strMainID . '_bigimg_cont',
    'SLIDER_CONT_ID'     => $strMainID . '_slider_cont',
    'SLIDER_LIST'        => $strMainID . '_slider_list',
    'SLIDER_LEFT'        => $strMainID . '_slider_left',
    'SLIDER_RIGHT'       => $strMainID . '_slider_right',
    'OLD_PRICE'          => $strMainID . '_old_price',
    'PRICE'              => $strMainID . '_price',
    'DISCOUNT_PRICE'     => $strMainID . '_price_discount',
    'SLIDER_CONT_OF_ID'  => $strMainID . '_slider_cont_',
    'SLIDER_LIST_OF_ID'  => $strMainID . '_slider_list_',
    'SLIDER_LEFT_OF_ID'  => $strMainID . '_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID . '_slider_right_',
    'QUANTITY'           => $strMainID . '_quantity',
    'QUANTITY_DOWN'      => $strMainID . '_quant_down',
    'QUANTITY_UP'        => $strMainID . '_quant_up',
    'QUANTITY_MEASURE'   => $strMainID . '_quant_measure',
    'QUANTITY_LIMIT'     => $strMainID . '_quant_limit',
    'BASIS_PRICE'        => $strMainID . '_basis_price',
    'BUY_LINK'           => $strMainID . '_buy_link',
    'ADD_BASKET_LINK'    => $strMainID . '_add_basket_link',
    'BASKET_ACTIONS'     => $strMainID . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
    'COMPARE_LINK'       => $strMainID . '_compare_link',
    'PROP'               => $strMainID . '_prop_',
    'PROP_DIV'           => $strMainID . '_skudiv',
    'DISPLAY_PROP_DIV'   => $strMainID . '_sku_prop',
    'OFFER_GROUP'        => $strMainID . '_set_group_',
    'BASKET_PROP_DIV'    => $strMainID . '_basket_prop',
];
$strObName              = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
    : $arResult['NAME']
);
$strAlt   = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
    : $arResult['NAME']
);
?>

<div class="catalog-element-wrapper col-12" id="<?= $arItemIDs['ID'] ?>">

    <!--изображения-->
    <div class="catalog-element-images">
        <? $arFirstPhoto = current($arResult['MORE_PHOTO']); ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

        <!--основное изображение-->
        <div class="catalog-element-images-main">
            <? foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto): ?>
                <? $resizeImg = \CFile::ResizeImageGet($arOnePhoto['ID'], ['width' => 220, 'height' => 9999], BX_RESIZE_IMAGE_PROPORTIONAL_ALT); ?>
                <a data-fancybox="gallery" href="<?= $arOnePhoto['SRC'] ?>">
                    <img src="<?= $resizeImg['src'] ?>" width="220" alt="<?= $arOnePhoto['ID'] ?>">
                </a>
            <? endforeach; ?>
            <? unset($arOnePhoto); ?>
        </div>

    </div>

    <!--инфо-->
    <div class="catalog-element-info">

        <!--название-->
        <div class="catalog-element-title">
            <h1 class="h2"><?= isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
                    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
                    : $arResult["NAME"] ?></h1>
            <!--повтор заказа-->
            <?/*
            <button class="catalog-element-repeat-order btn btn-transparent btn-transparent-primary btn-large">Повторить заказ</button>
            */?>
        </div>

        <!--избранное-->
        <div class="catalog-element-favorites">
            <div class="js-toggle-favorite" data-favorite-id="<?= $arResult['ID'] ?>" title="Добавить в избранное">
                <?= Helper::renderIcon('heart-filled') ?> <span class="hidden-xs">&nbsp;Избранное</span>
            </div>
        </div>

        <!--рейтинг-->
        <?
        $rate = array();
        $reviews = \CIBlockElement::GetList(
            array('CREATED' => 'ASC'),
            array(
                'ACTIVE' => 'Y',
                'IBLOCK_ID' => REVIEWS_IBLOCK_ID,
                'PROPERTY_PRODUCT_ID' => $arResult['ID'],
            ),
            false,
            false,
            array('PROPERTY_STARS')
        );
        while ($review = $reviews->GetNextElement()) {
            $fields = $review->GetFields();
            $rate[] = (int) $fields['PROPERTY_STARS_VALUE'];
        }
        $rate = array_filter($rate);
        $average_rate = ceil(array_sum($rate) / count($rate));
        ?>
        <div class="catalog-element-rating" title="Рейтинг: <?= (int) $average_rate > 0 ? (int) $average_rate : 'нет оценок' ?>">
            <? for ($s = 1; $s <= 5; $s++): ?>
                <? if ($s > (int) $average_rate): ?>
                    <img src="<?= SITE_DIR . 'include/images/star-empty.png' ?>" alt="" height="16" width="16">
                <? else: ?>
                    <img src="<?= SITE_DIR . 'include/images/star.png' ?>" alt="" height="16" width="16">
                <? endif; ?>
            <? endfor; ?>
        </div>

        <!--выбор параметров-->
        <div class="catalog-element-properties">
            <?/*<div class="catalog-element-properties--title">Выберите параметры</div>*/?>
            <div class="catalog-element-properties--content">
                <? require_once __DIR__ . '/select_properties.php'; ?>
            </div>
        </div>

        <!--корзина-->
        <div class="catalog-element-buy-block">

            <!--цена-->
            <div class="catalog-element-price">
                <? if ($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arResult['PRICES']["BASE"]["VALUE"]): ?>
                    <div class="price_old"><span class="value"><?= $arResult['PRICES']["BASE"]["VALUE"] ?></span><span class="rouble">₽</span></div>
                    <div class="price_new"><span class="value"><?= $arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"] ?></span><span class="rouble">₽</span></div>
                <? else: ?>
                    <div class="price_new"><span class="value"><?= $arResult['PRICES']["BASE"]["VALUE"] ?></span><span class="rouble">₽</span></div>
                <? endif; ?>
            </div>

            <!--добавить в корзину-->
            <div class="catalog-element-addtocart">
                <input type="submit" class="btn btn-primary bx_big bx_bt_button bx_cart"
                    value="Добавить в корзину"
                    form="select-properties-<?= $arResult['ID'] ?>"
                    name="catalog-element-addtocart"
                    data-product-id="<?= $arResult['ID'] ?>"
                    data-quantity="1">
            </div>

            <!--вернуться к покупкам-->
            <div class="catalog-element-return">
                <button class="btn-transparent" data-dismiss="modal">Вернуться к покупкам</button>
            </div>

        </div>

        <div class="catalog-element-price-info">Цены на сайте и в салонах оптики могут отличаться.</div>

        <div class="catalog-element-more"><a href="/catalog<?= $arResult['DETAIL_PAGE_URL'] ?>">Подробнее о товаре...</a></div>

    </div>

    <? if (
        !empty($arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["Srok"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["Shtyk"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["Vlago"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["Pronic"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["Rezh"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["Mat"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["Diam"]["VALUE"])
        || !empty($arResult["PROPERTIES"]["ob"]["VALUE"])
    ): ?>
    <? endif; ?>

</div>

<? $APPLICATION->SetPageProperty("novoe_svoistvo", "2"); ?>
