<? $APPLICATION->IncludeComponent("bitrix:menu",
    "horizontal_kalinza",
    array(
        "ROOT_MENU_TYPE"        => "top",    // Тип меню для первого уровня
        "MENU_CACHE_TYPE"       => "A",    // Тип кеширования
        "MENU_CACHE_TIME"       => "36000000",    // Время кеширования (сек.)
        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
        "MENU_THEME"            => "green",    // Тема меню
        "CACHE_SELECTED_ITEMS"  => "N",
        "MENU_CACHE_GET_VARS"   => "",    // Значимые переменные запроса
        "MAX_LEVEL"             => "3",    // Уровень вложенности меню
        "CHILD_MENU_TYPE"       => "left",    // Тип меню для остальных уровней
        "USE_EXT"               => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
        "DELAY"                 => "N",    // Откладывать выполнение шаблона меню
        "ALLOW_MULTI_SELECT"    => "N",    // Разрешить несколько активных пунктов одновременно
        "COMPONENT_TEMPLATE"    => "catalog_horizontal",
    ),
    false
);

$APPLICATION->IncludeComponent(
    "bitrix:sale.basket.basket.line",
    "kalinza",
    array(
        "PATH_TO_BASKET"       => "/personal/cart/",
        "PATH_TO_PERSONAL"     => SITE_DIR . "personal/",
        "SHOW_PERSONAL_LINK"   => "N",
        "SHOW_NUM_PRODUCTS"    => "Y",
        "SHOW_TOTAL_PRICE"     => "N",
        "SHOW_PRODUCTS"        => "N",
        "POSITION_FIXED"       => "N",
        "SHOW_AUTHOR"          => "N",
        "PATH_TO_REGISTER"     => SITE_DIR . "login/",
        "PATH_TO_PROFILE"      => SITE_DIR . "personal/",
        "COMPONENT_TEMPLATE"   => "template2",
        "PATH_TO_ORDER"        => "/personal/order/make/",
        "SHOW_EMPTY_VALUES"    => "N",
        "PATH_TO_AUTHORIZE"    => "",
        "SHOW_REGISTRATION"    => "N",
        "HIDE_ON_BASKET_PAGES" => "N",
    ),
    false
);
