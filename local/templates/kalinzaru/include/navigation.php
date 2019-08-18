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
