<?php

use core\Helper;

?>
<!--header mobile-->
<div class="header--mobile">
    <div class="container">
        <div class="row">
            <div class="header--mobile--wrapper col-12">
                <div class="header--mobile--menu">
                    <?= Helper::renderIcon('menu') ?>
                </div>
                <div class="header--mobile--search">
                    <a href="/search/">
                        <?= Helper::renderIcon('search') ?>
                    </a>

                    <!--search bar-->
                    <div class="header--mobile--search-bar"></div>

                </div>
                <div class="header--mobile--logo">
                    <a href="/" title="Главная">
                        <img src="<?= SITE_TEMPLATE_PATH . '/images/logo-mobile.svg' ?>" alt="KALINZA">
                    </a>
                </div>
                <div class="header--mobile--cart">
                    <a class="header-mobile--cart-icon" href="/personal/cart/">
                        <?= Helper::renderIcon('shopping-cart') ?>
                    </a>
                    <div class="header--mobile--cart-counter">0</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--popup menu-->
<div class="header--mobile--menu-popup">
    <div class="header--mobile--menu-popup--wrapper">

        <div class="mobile-menu--header">
            <div class="mobile-menu--close">
                <?= Helper::renderIcon('close') ?>
            </div>
            <div class="mobile-menu--logo">
                <a href="/" title="Главная">
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/logo-mobile.svg' ?>" alt="KALINZA">
                </a>
            </div>
        </div>

        <div class="mobile-menu--location">
            <div class="mobile-menu--location-icon"><?= Helper::renderIcon('location') ?></div>
            <div class="mobile-menu--location-city">Краснодар</div>
        </div>

        <div class="mobile-menu--auth">
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

        <div class="mobile-menu--catalog">
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
                    "MAX_LEVEL"             => "0",    // Уровень вложенности меню
                    "CHILD_MENU_TYPE"       => "left",    // Тип меню для остальных уровней
                    "USE_EXT"               => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "DELAY"                 => "N",    // Откладывать выполнение шаблона меню
                    "ALLOW_MULTI_SELECT"    => "N",    // Разрешить несколько активных пунктов одновременно
                    "COMPONENT_TEMPLATE"    => "catalog_horizontal",
                ),
                false
            ); ?>

            <div class="mobile-menu--catalog--favorites header--topbar--favorites">
                Избранное &nbsp;
                <a href="/favorites">
                    <?= Helper::renderIcon('heart') ?>
                    <div class="header--topbar--favorites-counter">0</div>
                </a>
            </div>
        </div>

        <div class="mobile-menu--menu">
            <div class="mobile-menu--menu--folder">О компании <?= Helper::renderIcon('unwrap') ?></div>
            <ul>
                <?php $APPLICATION->IncludeComponent('bitrix:menu',
                    'bottom_menu',
                    array(
                        'ROOT_MENU_TYPE'        => 'bottom_company',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ),
                    false); ?>
            </ul>

            <div class="mobile-menu--menu--folder">Информации <?= Helper::renderIcon('unwrap') ?></div>
            <ul>
                <?php $APPLICATION->IncludeComponent('bitrix:menu',
                    'bottom_menu',
                    array(
                        'ROOT_MENU_TYPE'        => 'bottom_info',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ),
                    false); ?>
            </ul>

            <div class="mobile-menu--menu--folder">Наши салоны оптики <?= Helper::renderIcon('unwrap') ?></div>
            <ul>
                <?php $APPLICATION->IncludeComponent('bitrix:menu',
                    'bottom_menu',
                    array(
                        'ROOT_MENU_TYPE'        => 'bottom_shops',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ),
                    false); ?>
            </ul>

            <div class="mobile-menu--menu--folder">Бренды <?= Helper::renderIcon('unwrap') ?></div>
            <ul>
                <?php $APPLICATION->IncludeComponent('bitrix:menu',
                    'bottom_menu',
                    array(
                        'ROOT_MENU_TYPE'        => 'bottom_brands',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ),
                    false); ?>
            </ul>

            <div class="mobile-menu--menu--folder">Линзы по сроку ношения <?= Helper::renderIcon('unwrap') ?></div>
            <ul>
                <?php $APPLICATION->IncludeComponent('bitrix:menu',
                    'bottom_menu',
                    array(
                        'ROOT_MENU_TYPE'        => 'bottom_lens',
                        'MENU_CACHE_TYPE'       => 'A',
                        'MENU_CACHE_TIME'       => '36000000',
                        'MENU_CACHE_USE_GROUPS' => 'Y',
                        'MENU_CACHE_GET_VARS'   => [],
                        'CACHE_SELECTED_ITEMS'  => 'N',
                        'MAX_LEVEL'             => '1',
                        'USE_EXT'               => 'Y',
                        'DELAY'                 => 'N',
                        'ALLOW_MULTI_SELECT'    => 'N',
                        'COMPONENT_TEMPLATE'    => 'bottom_menu',
                        'CHILD_MENU_TYPE'       => 'left',
                    ),
                    false); ?>
            </ul>

        </div>

        <div class="mobile-menu--footer">
            <div class="mobile-menu--footer--phone">
                <a href="tel:88001234567">8-800-123-45-67</a>
            </div>
            <div class="mobile-menu--footer--callback">
                <a href="#" data-toggle="modal" data-target="#modal--callback">Заказать звонок</a>
            </div>
            <div class="mobile-menu--footer--socials">
                <a href="http://t-do.ru/kalinza" class="messenger-icon messenger-icon-telegram" rel="nofollow" target="_blank">
                    <?= Helper::renderIcon('telegram') ?>
                </a>
                <a href="https://api.whatsapp.com/send?phone=79182447228" class="messenger-icon messenger-icon-whatsapp" rel="nofollow" target="_blank">
                    <?= Helper::renderIcon('whatsapp') ?>
                </a>
                <a href="viber://chat?number=79182447228" class="messenger-icon messenger-icon-viber" rel="nofollow" target="_blank">
                    <?= Helper::renderIcon('viber') ?>
                </a>
            </div>
        </div>

    </div>
</div>
