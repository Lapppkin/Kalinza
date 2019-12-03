<?

use core\Helper;

?>
<div class="header--topbar--left">
    <?= Helper::renderIcon('location') ?>

    <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . '/include/choose_region.php'); ?>

    <?
    /*
    $APPLICATION->IncludeComponent("altasib:geobase",
        "topbar",
        array()
    );
    $APPLICATION->IncludeComponent(
        "altasib:geobase.select.city",
        "topbar",
        array(
            "LOADING_AJAX" => "Y",
            "RIGHT_ENABLE" => "N",
            "SMALL_ENABLE" => "N",
            "SPAN_LEFT" => "",
            "SPAN_RIGHT" => "Выберите город",
    ));
    */
    ?>

    <? $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "topbar_kalinza",
        array(
            "ROOT_MENU_TYPE"        => "topbar",
            "MENU_CACHE_TYPE"       => "A",
            "MENU_CACHE_TIME"       => "36000000",
            "MENU_CACHE_USE_GROUPS" => "N",
            "MENU_THEME"            => "",
            "CACHE_SELECTED_ITEMS"  => "N",
            "MENU_CACHE_GET_VARS"   => array(),
            "MAX_LEVEL"             => "2",
            "CHILD_MENU_TYPE"       => "",
            "USE_EXT"               => "Y",
            "DELAY"                 => "N",
            "ALLOW_MULTI_SELECT"    => "N",
            "COMPONENT_TEMPLATE"    => "",
            "COMPOSITE_FRAME_MODE"  => "A",
            "COMPOSITE_FRAME_TYPE"  => "AUTO",
        ),
        false
    ); ?>
</div>

<div class="header--topbar--right">

    <div class="header--topbar--favorites">
        <a href="/favorites">
            <?= Helper::renderIcon('heart') ?>
            <div class="header--topbar--favorites-counter">0</div>
        </a>
    </div>

    <? $APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket.line",
        "topbar",
        array(
            "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
            "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
            "SHOW_PERSONAL_LINK" => "N",
            "SHOW_NUM_PRODUCTS" => "N",
            "SHOW_TOTAL_PRICE" => "N",
            "SHOW_PRODUCTS" => "N",
            "POSITION_FIXED" => "N",
            "SHOW_AUTHOR" => "Y",
            "PATH_TO_REGISTER" => SITE_DIR . "login/",
            "PATH_TO_PROFILE" => SITE_DIR . "personal/",
            "COMPONENT_TEMPLATE" => "template1",
            "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
            "SHOW_EMPTY_VALUES" => "N",
            "PATH_TO_AUTHORIZE" => "",
            "SHOW_REGISTRATION" => "Y",
            "HIDE_ON_BASKET_PAGES" => "Y",
        ),
        false
    ); ?>
</div>
