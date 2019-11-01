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
                <? $resizeImg = \CFile::ResizeImageGet($arOnePhoto['ID'], ['width' => 366, 'height' => 9999], BX_RESIZE_IMAGE_PROPORTIONAL_ALT); ?>
                <a data-fancybox="gallery" href="<?= $arOnePhoto['SRC'] ?>">
                    <img src="<?= $resizeImg['src'] ?>" width="366" alt="<?= $arOnePhoto['ID'] ?>">
                </a>
            <? endforeach; ?>
            <? unset($arOnePhoto); ?>
        </div>

        <!--дополнительные изображения-->
        <div class="catalog-element-images-more">
            <ul>
                <? foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto): ?>
                    <? $resizeImg = \CFile::ResizeImageGet($arOnePhoto['ID'], ['width' => 366, 'height' => 9999],BX_RESIZE_IMAGE_PROPORTIONAL_ALT); ?>
                    <li>
                        <div data-img="<?= $resizeImg['src'] ?>" data-img-full="<? echo $arOnePhoto['SRC']; ?>">
                            <img src="<?= $resizeImg['src'] ?>" width="55" alt="<?= $arOnePhoto['ID'] ?>">
                        </div>
                    </li>
                <? endforeach; ?>
                <? unset($arOnePhoto); ?>

                <?
                for ($i = 1; $i <= 6; $i++) {
                    $ID_PICTYRE = $arResult['PROPERTIES']['dopf' . $i]['VALUE'];
                    $URL = \CFile::GetPath($ID_PICTYRE);
                    if (!empty($URL)) {
                        $resizeImg = \CFile::ResizeImageGet($ID_PICTYRE, ['width' => 366, 'height' => 9999], BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
                        echo '<li><div id="f' . $i . '" data-img="' . $resizeImg['src'] . '" data-img-full="' . $URL . '"><img src="' . $resizeImg['src'] . '" width="55" alt="' . $URL . '"></div></li>';
                    }
                }
                ?>
            </ul>
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
            <div class="js-toggle-favorite" data-favorite-id="<?= $arResult['ID'] ?>" title="Добавить в избранное"><?= Helper::renderIcon('heart-filled') ?></div>
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
            <div class="catalog-element-properties--title">Выберите параметры</div>
            <div class="catalog-element-properties--content">
                <? require_once __DIR__ . '/select_properties.php'; ?>
            </div>
        </div>

        <!--корзина-->
        <div class="catalog-element-buy-block">

            <!--цена-->
            <div class="catalog-element-price">
                <? if ($arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"] < $arResult['PRICES']["BASE"]["VALUE"]): ?>
                    <div class="price_old"><?= $arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"] ?> ₽</div>
                <? endif; ?>
                <div class="price_new"><?= $arResult['PRICES']["BASE"]["VALUE"] ?> ₽</div>
            </div>

            <!--добавить в корзину-->
            <div class="catalog-element-addtocart">
                <input type="submit" class="btn btn-primary bx_big bx_bt_button bx_cart" name="nazvanie_knopki" value="Добавить в корзину" form="select-properties"
                    data-product-id="<?= $arResult['ID'] ?>"
                    data-quantity="1"
                >
            </div>

            <!--купить в один клик-->
            <div class="catalog-element-buyoneclick">
                <a href="javascript:void(0)">Купить в 1 клик</a>
            </div>

        </div>

        <div class="catalog-element-price-info">Цены на сайте и в салонах оптики могут отличаться.</div>

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
    <!--харастеристики-->
    <div class="catalog-element-options">
        <div class="catalog-element-options--title">
            <h4>Характеристики</h4>
        </div>
        <div class="catalog-element-options--content">
            <table>
                <tbody>
                    <? if (!empty($arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"])) {
                        echo '<tr><td>Производитель</td><td>' . $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["Srok"]["VALUE"])) {
                        echo '<tr><td>Срок ношения</td><td>' . $arResult["PROPERTIES"]["Srok"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["Shtyk"]["VALUE"])) {
                        echo '<tr><td>Штук в упаковке</td><td>' . $arResult["PROPERTIES"]["Shtyk"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["Vlago"]["VALUE"])) {
                        echo '<tr><td>Влагосодержание</td><td>' . $arResult["PROPERTIES"]["Vlago"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["Pronic"]["VALUE"])) {
                        echo '<tr><td>Проницаемость</td><td>' . $arResult["PROPERTIES"]["Pronic"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["Rezh"]["VALUE"])) {
                        echo '<tr><td>Режим ношения</td><td>' . $arResult["PROPERTIES"]["Rezh"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["Mat"]["VALUE"])) {
                        echo '<tr><td>Материал</td><td>' . $arResult["PROPERTIES"]["Mat"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["Diam"]["VALUE"])) {
                        echo '<tr><td>Диаметр</td><td>' . $arResult["PROPERTIES"]["Diam"]["VALUE"] . '</td></tr>';
                    } ?>
                    <? if (!empty($arResult["PROPERTIES"]["ob"]["VALUE"])) {
                        echo '<tr><td>Объем</td><td>' . $arResult["PROPERTIES"]["ob"]["VALUE"] . '</td></tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <? endif; ?>

    <? if ('' != $arResult['DETAIL_TEXT']) { ?>
    <!--описание-->
    <div class="catalog-element-description">
        <div class="catalog-element-description--title">
            <h4><?= GetMessage('FULL_DESCRIPTION') ?></h4>
        </div>
        <div class="catalog-element-description--content">
            <? if ('html' == $arResult['DETAIL_TEXT_TYPE']) { ?>
                <?= $arResult['DETAIL_TEXT'] ?>
            <? } else {
                ?><p><?= $arResult['DETAIL_TEXT']; ?></p><?
            } ?>
        </div>
    </div>
    <? } ?>

    <!--отзывы-->
    <? $APPLICATION->IncludeFile(
        SITE_DIR . '/include/reviews.php',
        array(
            'REVIEWS_IBLOCK_ID' => REVIEWS_IBLOCK_ID,
            'PRODUCT_ID' => $arResult['ID'],
        )
    ); ?>

</div>

<!--персональные рекомендации-->
<div class="catalog-element-recommended col-12">
    <div class="popular-products--wrapper">
    </div>
</div>

<?/*
<!--вы недавно просматривали-->
<div class="catalog-element-viewed col-12">
    <div class="catalog-element-viewed--title">
        <h4 class="h3">Вы недавно смотрели</h4>
    </div>
    <div class="catalog-element-viewed--content">
        <? $APPLICATION->IncludeComponent(
            "bitrix:catalog.products.viewed",
            ".default",
            [
                "ACTION_VARIABLE"             => "action_cpv",
                "ADDITIONAL_PICT_PROP_2"      => "MORE_PHOTO",
                "ADDITIONAL_PICT_PROP_3"      => "-",
                "ADD_PROPERTIES_TO_BASKET"    => "Y",
                "ADD_TO_BASKET_ACTION"        => "BUY",
                "BASKET_URL"                  => "/personal/cart/",
                "CACHE_GROUPS"                => "Y",
                "CACHE_TIME"                  => "3600",
                "CACHE_TYPE"                  => "A",
                "CART_PROPERTIES_2"           => [
                    0 => "NEWPRODUCT",
                    1 => "NEWPRODUCT,SALELEADER",
                    2 => "",
                ],
                "CART_PROPERTIES_3"           => [
                    0 => "COLOR_REF",
                    1 => "SIZES_SHOES",
                    2 => "",
                ],
                "CONVERT_CURRENCY"            => "Y",
                "CURRENCY_ID"                 => "RUB",
                "DATA_LAYER_NAME"             => "dataLayer",
                "DEPTH"                       => "",
                "DISCOUNT_PERCENT_POSITION"   => "top-right",
                "ENLARGE_PRODUCT"             => "STRICT",
                "ENLARGE_PROP_2"              => "NEWPRODUCT",
                "HIDE_NOT_AVAILABLE"          => "N",
                "HIDE_NOT_AVAILABLE_OFFERS"   => "L",
                "IBLOCK_ID"                   => "2",
                "IBLOCK_MODE"                 => "single",
                "IBLOCK_TYPE"                 => "catalog",
                "LABEL_PROP_2"                => [
                    0 => "NEWPRODUCT",
                ],
                "LABEL_PROP_MOBILE_2"         => "",
                "LABEL_PROP_POSITION"         => "top-left",
                "MESS_BTN_ADD_TO_BASKET"      => "Купить",
                "MESS_BTN_BUY"                => "Купить",
                "MESS_BTN_DETAIL"             => "Подробнее",
                "MESS_BTN_SUBSCRIBE"          => "Подписаться",
                "MESS_NOT_AVAILABLE"          => "Нет в наличии",
                "MESS_RELATIVE_QUANTITY_FEW"  => "мало",
                "MESS_RELATIVE_QUANTITY_MANY" => "много",
                "MESS_SHOW_MAX_QUANTITY"      => "Наличие",
                "OFFER_TREE_PROPS_3"          => [
                    0 => "COLOR_REF",
                    1 => "SIZES_SHOES",
                    2 => "SIZES_CLOTHES",
                ],
                "PAGE_ELEMENT_COUNT"          => "3",
                "PARTIAL_PRODUCT_PROPERTIES"  => "N",
                "PRICE_CODE"                  => [
                    0 => "BASE",
                ],
                "PRICE_VAT_INCLUDE"           => "Y",
                "PRODUCT_BLOCKS_ORDER"        => "price,props,quantityLimit,sku,quantity,buttons,compare",
                "PRODUCT_ID_VARIABLE"         => "id",
                "PRODUCT_PROPS_VARIABLE"      => "prop",
                "PRODUCT_QUANTITY_VARIABLE"   => "",
                "PRODUCT_ROW_VARIANTS"        => "[{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION"        => "Y",
                "PROPERTY_CODE_2"             => [
                    0 => "NEWPRODUCT",
                    1 => "SALELEADER",
                    2 => "SPECIALOFFER",
                    3 => "MANUFACTURER",
                    4 => "MATERIAL",
                    5 => "COLOR",
                    6 => "SALELEADER,SPECIALOFFER,MATERIAL,COLOR,KEYWORDS,BRAND_REF",
                    7 => "",
                ],
                "PROPERTY_CODE_3"             => [
                    0 => "ARTNUMBER",
                    1 => "COLOR_REF",
                    2 => "SIZES_SHOES",
                    3 => "SIZES_CLOTHES",
                    4 => "",
                ],
                "PROPERTY_CODE_MOBILE_2"      => "",
                "RELATIVE_QUANTITY_FACTOR"    => "5",
                "SECTION_CODE"                => "",
                "SECTION_ELEMENT_CODE"        => "",
                "SECTION_ELEMENT_ID"          => "",
                "SECTION_ID"                  => "",
                "SHOW_CLOSE_POPUP"            => "N",
                "SHOW_DISCOUNT_PERCENT"       => "N",
                "SHOW_FROM_SECTION"           => "N",
                "SHOW_MAX_QUANTITY"           => "N",
                "SHOW_OLD_PRICE"              => "N",
                "SHOW_PRICE_COUNT"            => "1",
                "SHOW_PRODUCTS_2"             => "N",
                "SHOW_SLIDER"                 => "N",
                "SLIDER_INTERVAL"             => "3000",
                "SLIDER_PROGRESS"             => "Y",
                "TEMPLATE_THEME"              => "",
                "USE_ENHANCED_ECOMMERCE"      => "N",
                "USE_PRICE_COUNT"             => "N",
                "USE_PRODUCT_QUANTITY"        => "N",
                "COMPONENT_TEMPLATE"          => ".default",
                "DISPLAY_COMPARE"             => "N",
                "PROPERTY_CODE_4"             => [],
                "PROPERTY_CODE_MOBILE_4"      => [],
                "CART_PROPERTIES_4"           => [],
                "ADDITIONAL_PICT_PROP_4"      => "-",
                "LABEL_PROP_4"                => [],
                "PROPERTY_CODE_5"             => [],
                "PROPERTY_CODE_MOBILE_5"      => [],
                "CART_PROPERTIES_5"           => [],
                "ADDITIONAL_PICT_PROP_5"      => "-",
                "LABEL_PROP_5"                => [],
                "PROPERTY_CODE_7"             => [],
                "PROPERTY_CODE_MOBILE_7"      => [],
                "CART_PROPERTIES_7"           => [],
                "ADDITIONAL_PICT_PROP_7"      => "-",
                "LABEL_PROP_7"                => [],
                "PROPERTY_CODE_8"             => [],
                "PROPERTY_CODE_MOBILE_8"      => [],
                "CART_PROPERTIES_8"           => [],
                "ADDITIONAL_PICT_PROP_8"      => "-",
                "LABEL_PROP_8"                => [],
            ],
            false
        ); ?>
    </div>
</div>
*/ ?>

<? $APPLICATION->SetPageProperty("novoe_svoistvo", "2"); ?>
