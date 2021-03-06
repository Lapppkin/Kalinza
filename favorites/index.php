<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Раздел избранное - Ваши отобранные товары.");
$APPLICATION->SetPageProperty("title", "Избранное - отобранные товары");
$APPLICATION->SetTitle("Избранное");

$IBLOCK_ID = CATALOG_DEFAULT_IBLOCK_ID; // ID инфоблока каталога

CModule::IncludeModule('iblock');

?>
<h1 class="col-12 page-title">Избранное</h1>

<div class="favorites col-12">
    <? if ($_COOKIE['BX_FAVOURITES']):
        $arID = explode('.', $_COOKIE['BX_FAVOURITES']); ?>
        <script>__FILTER_BASE_URL__ = '/favourites/';</script>
        <?
        global $arrFilterFav;
        $arrFilterFav = array(
            '=ID' => $arID,
        );
        $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "main",
        array(
            'ACTION_VARIABLE'                 => 'action',
            'ADD_PICT_PROP'                   => '-',
            'ADD_PROPERTIES_TO_BASKET'        => 'Y',
            'ADD_SECTIONS_CHAIN'              => 'N',
            'ADD_TO_BASKET_ACTION'            => 'BUY',
            'AJAX_MODE'                       => 'Y',
            'AJAX_OPTION_ADDITIONAL'          => '',
            'AJAX_OPTION_HISTORY'             => 'N',
            'AJAX_OPTION_JUMP'                => 'N',
            'AJAX_OPTION_STYLE'               => 'Y',
            'BACKGROUND_IMAGE'                => '-',
            'BASKET_URL'                      => '#SECTION_CODE#/#ELEMENT_CODE#/',
            'BROWSER_TITLE'                   => '-',
            'CACHE_FILTER'                    => 'N',
            'CACHE_GROUPS'                    => 'Y',
            'CACHE_TIME'                      => '36000000',
            'CACHE_TYPE'                      => 'A',
            'COMPATIBLE_MODE'                 => 'N',
            'COMPONENT_TEMPLATE'              => 'bootstrap_v5',
            'CONVERT_CURRENCY'                => 'N',
            //'CUSTOM_FILTER'                   => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":126}}]}',
            'DETAIL_URL'                      => '/catalog/#SECTION_CODE#/#CODE#/',
            'DISABLE_INIT_JS_IN_COMPONENT'    => 'N',
            'DISPLAY_BOTTOM_PAGER'            => 'N',
            'DISPLAY_COMPARE'                 => 'N',
            'DISPLAY_TOP_PAGER'               => 'N',
            'ELEMENT_SORT_FIELD'              => 'shows',
            'ELEMENT_SORT_FIELD2'             => 'shows',
            'ELEMENT_SORT_ORDER'              => 'asc',
            'ELEMENT_SORT_ORDER2'             => 'asc',
            'ENLARGE_PRODUCT'                 => 'STRICT',
            'ENLARGE_PROP'                    => '-',
            'FILTER_NAME'                     => 'arrFilterFav',
            'HIDE_NOT_AVAILABLE'              => 'N',
            'HIDE_NOT_AVAILABLE_OFFERS'       => 'N',
            'IBLOCK_ID'                       => $IBLOCK_ID,
            'IBLOCK_TYPE'                     => 'catalog',
            'IBLOCK_TYPE_ID'                  => 'catalog',
            'INCLUDE_SUBSECTIONS'             => 'A',
            'LABEL_PROP'                      => [],
            'LABEL_PROP_MOBILE'               => '',
            'LABEL_PROP_POSITION'             => 'top-left',
            'LAZY_LOAD'                       => 'N',
            'LINE_ELEMENT_COUNT'              => '3',
            'LOAD_ON_SCROLL'                  => 'N',
            'MESSAGE_404'                     => 'Y',
            'MESS_BTN_ADD_TO_BASKET'          => 'В корзину',
            'MESS_BTN_BUY'                    => 'Купить',
            'MESS_BTN_DETAIL'                 => 'Подробнее',
            'MESS_BTN_SUBSCRIBE'              => 'Подписаться',
            'MESS_NOT_AVAILABLE'              => 'Нет в наличии',
            'META_DESCRIPTION'                => '-',
            'META_KEYWORDS'                   => '-',
            'OFFERS_CART_PROPERTIES'          => [0 => 'ARTNUMBER',],
            'OFFERS_FIELD_CODE'               => [0 => 'NAME', 1 => '',],
            'OFFERS_PROPERTY_CODE'            => [0 => '', 1 => '',],
            'OFFERS_SORT_FIELD'               => 'shows',
            'OFFERS_SORT_FIELD2'              => 'shows',
            'OFFERS_SORT_ORDER'               => 'asc',
            'OFFERS_SORT_ORDER2'              => 'asc',
            'OFFER_ADD_PICT_PROP'             => '-',
            'OFFER_TREE_PROPS'                => '',
            'PAGER_BASE_LINK_ENABLE'          => 'N',
            'PAGER_DESC_NUMBERING'            => 'N',
            'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
            'PAGER_SHOW_ALL'                  => 'N',
            'PAGER_SHOW_ALWAYS'               => 'N',
            'PAGER_TEMPLATE'                  => '.default',
            'PAGER_TITLE'                     => 'Товары',
            'PAGE_ELEMENT_COUNT'              => '16',
            'PARTIAL_PRODUCT_PROPERTIES'      => 'Y',
            'PRICE_CODE'                      => [0 => 'BASE',],
            'PRICE_VAT_INCLUDE'               => 'Y',
            'PRODUCT_BLOCKS_ORDER'            => 'price,props,sku,quantityLimit,quantity,buttons',
            'PRODUCT_DISPLAY_MODE'            => 'N',
            'PRODUCT_ID_VARIABLE'             => 'id',
            'PRODUCT_PROPERTIES'              => [],
            'PRODUCT_PROPS_VARIABLE'          => 'prop',
            'PRODUCT_QUANTITY_VARIABLE'       => '',
            'PRODUCT_ROW_VARIANTS'            => "[{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false}]",
            'PRODUCT_SUBSCRIPTION'            => 'N',
            'PROPERTY_CODE'                   => [0 => '', 1 => '',],
            'PROPERTY_CODE_MOBILE'            => [],
            'RCM_PROD_ID'                     => $_REQUEST['PRODUCT_ID'],
            'RCM_TYPE'                        => 'personal',
            'SECTION_CODE'                    => '',
            'SECTION_CODE_PATH'               => '',
            'SECTION_ID'                      => '',
            'SECTION_ID_VARIABLE'             => 'SECTION_ID',
            'SECTION_URL'                     => '/catalog/#SECTION_CODE#/#CODE#/',
            'SECTION_USER_FIELDS'             => [0 => 'UF_BACKGROUND_IMAGE', 1 => '',],
            'SEF_MODE'                        => 'Y',
            'SEF_RULE'                        => '/',
            'SET_BROWSER_TITLE'               => 'Y',
            'SET_LAST_MODIFIED'               => 'N',
            'SET_META_DESCRIPTION'            => 'Y',
            'SET_META_KEYWORDS'               => 'Y',
            'SET_STATUS_404'                  => 'Y',
            'SET_TITLE'                       => 'Y',
            'SHOW_404'                        => 'N',
            'SHOW_ALL_WO_SECTION'             => 'Y',
            'SHOW_CLOSE_POPUP'                => 'N',
            'SHOW_DISCOUNT_PERCENT'           => 'N',
            'SHOW_FROM_SECTION'               => 'N',
            'SHOW_MAX_QUANTITY'               => 'N',
            'SHOW_OLD_PRICE'                  => 'Y',
            'SHOW_PRICE_COUNT'                => '1',
            'SHOW_SLIDER'                     => 'Y',
            'SLIDER_INTERVAL'                 => '3000',
            'SLIDER_PROGRESS'                 => 'N',
            'TEMPLATE_THEME'                  => '',
            'USE_ENHANCED_ECOMMERCE'          => 'N',
            'USE_MAIN_ELEMENT_SECTION'        => 'N',
            'USE_PRICE_COUNT'                 => 'N',
            'USE_PRODUCT_QUANTITY'            => 'N',
        ),
        false
    ); ?>
</div>
<? else: ?>
    <div class="favorites__empty col-12">У вас нет избранных товаров.</div>
<? endif; ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
