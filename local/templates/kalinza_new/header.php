<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);

//$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>


<? CModule::IncludeModule('mcart.souvenirs'); ?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/2/favicon.ico"/>
    <? $APPLICATION->ShowHead(); ?>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="/2/css/animate.css">
    <link rel="stylesheet" href="/2/css/icomoon.css">
    <link rel="stylesheet" href="/2/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/2/css/magnific-popup.css">
    <link rel="stylesheet" href="/2/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/2/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/2/css/flexslider.css">
    <link rel="stylesheet" href="/2/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="/2/css/style.css">
    <link rel="stylesheet" href="/2/css/style_4.css">

    <style>
        .container-fix {
            /* width: 1256px; */
        }

        .altasib_geobase_link {
            display:         block;
            text-decoration: none;
            position:        relative;
            float:           left;
            color:           #3c97e8;
        }
    </style>

    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta name="yandex-verification" content="a56dfc858ae0a85a"/>
</head>

<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<!-- <div style="width: 1300px;overflow: hidden;margin: 0 auto;"> -->
<div style="">
    <div id="page">
        <nav class="colorlib-nav" role="navigation">
            <div class="top-menu">
                <div class="container container-fix">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row" style="padding-bottom: 10px;">
                                <div class="col-md-6">
                                    <div class="left menu_top_left">

                                        <? $APPLICATION->IncludeComponent("altasib:geobase", "", Array()); ?>
                                        <? $APPLICATION->IncludeComponent("altasib:geobase.select.city", "", Array(
                                            "LOADING_AJAX" => "Y",
                                            "RIGHT_ENABLE" => "N",
                                            "SMALL_ENABLE" => "N",
                                            "SPAN_LEFT"    => "",
                                            "SPAN_RIGHT"   => "Выберите город",
                                        )); ?>

                                        <a class="" href="/nashi-magaziny/">Наши магазины</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right menu_top_right">
                                        <? $APPLICATION->IncludeComponent(
                                            "bitrix:sale.basket.basket.line",
                                            "template1",
                                            array(
                                                "PATH_TO_BASKET"       => SITE_DIR . "personal/cart/",
                                                "PATH_TO_PERSONAL"     => SITE_DIR . "personal/",
                                                "SHOW_PERSONAL_LINK"   => "N",
                                                "SHOW_NUM_PRODUCTS"    => "N",
                                                "SHOW_TOTAL_PRICE"     => "N",
                                                "SHOW_PRODUCTS"        => "N",
                                                "POSITION_FIXED"       => "N",
                                                "SHOW_AUTHOR"          => "Y",
                                                "PATH_TO_REGISTER"     => SITE_DIR . "login/",
                                                "PATH_TO_PROFILE"      => SITE_DIR . "personal/",
                                                "COMPONENT_TEMPLATE"   => "template1",
                                                "PATH_TO_ORDER"        => SITE_DIR . "personal/order/make/",
                                                "SHOW_EMPTY_VALUES"    => "N",
                                                "PATH_TO_AUTHORIZE"    => "",
                                                "SHOW_REGISTRATION"    => "Y",
                                                "HIDE_ON_BASKET_PAGES" => "Y",
                                            ),
                                            false
                                        ); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container container-fix">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="top">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div id="colorlib-logo"><a href="/"><img src="/2/images/Logo.svg"/></a></div>
                                    </div>
                                    <div class="col-md-6 center">
                                        <div class="delivery">
                                            <img src="/2/images/delivery-icon.svg"/>
                                            <p>Доставка в день заказа!*</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="loc">

                                            <? if (CModule::IncludeModule("altasib.geobase")) {
                                                $arData = CAltasibGeoBase::GetDataKladr();
                                                if ($arData['CITY']['NAME'] == '') {
                                                    echo '<a class="phone button_modal" href="tel:+78612921640">+7 861 292-16-40</a>';
                                                }
                                                if ($arData['CITY']['NAME'] != '' and $arData['CITY']['NAME'] != 'Краснодар' and $arData['CITY']['NAME'] != 'Ижевск' and $arData['CITY']['NAME'] != 'Новосибирск' and $arData['CITY']['NAME'] != 'Ставрополь' and $arData['CITY']['NAME'] != 'Железногорск' and $arData['CITY']['NAME'] != 'Шахты') {
                                                    echo '<a class="phone button_modal" href="tel:+78612921640">+7 861 292-16-40</a>';
                                                }
                                                if ($arData['CITY']['NAME'] == 'Краснодар') {
                                                    echo '<a class="phone button_modal" href="tel:+78612921640">+7 861 292-16-40</a>';
                                                }
                                                if ($arData['CITY']['NAME'] == 'Ижевск') {
                                                    echo '<a class="phone button_modal" href="tel:+79641821029">+7 964 182-10-29</a>';
                                                }
                                                if ($arData['CITY']['NAME'] == 'Новосибирск') {
                                                    echo '<a class="phone button_modal" href="tel:+79607892123">+7 960 789-21-23</a>';
                                                }
                                                if ($arData['CITY']['NAME'] == 'Ставрополь') {
                                                    echo '<a class="phone button_modal" href="tel:+79283392421">+7 928 339-24-21</a>';
                                                }
                                                if ($arData['CITY']['NAME'] == 'Железногорск') {
                                                    echo '<a class="phone button_modal" href="tel:+79102717410">+7 910 271-74-10</a>';
                                                }
                                                if ($arData['CITY']['NAME'] == 'Шахты') {
                                                    echo '<a class="phone button_modal" href="tel:+79281657919">+7 928 165-79-19</a>';
                                                }

                                            } ?>
                                            <a class="phone_modal button_modal" data-modal="modal_2" href="#">Заказать звонок</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="nav">
                    <input class="nav__check" type="checkbox" id="showmenu"/>
                    <label class="nav__showmenu" for="showmenu">&#9776;</label>
                    <ul class="menu">
                        <? $APPLICATION->IncludeComponent("bitrix:menu", "horizontal_kalinza", Array(
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
                        ); ?>
                    </ul>
                </nav>

                <div class="menu-wrap">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-xs-9">
                                <div class="menu-1">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "horizontal_kalinza",
                                        array(
                                            "ROOT_MENU_TYPE"        => "top",
                                            "MENU_CACHE_TYPE"       => "A",
                                            "MENU_CACHE_TIME"       => "36000000",
                                            "MENU_CACHE_USE_GROUPS" => "N",
                                            "MENU_THEME"            => "green",
                                            "CACHE_SELECTED_ITEMS"  => "N",
                                            "MENU_CACHE_GET_VARS"   => array(),
                                            "MAX_LEVEL"             => "4",
                                            "CHILD_MENU_TYPE"       => "podmeni",
                                            "USE_EXT"               => "Y",
                                            "DELAY"                 => "N",
                                            "ALLOW_MULTI_SELECT"    => "N",
                                            "COMPONENT_TEMPLATE"    => "horizontal_kalinza",
                                            "COMPOSITE_FRAME_MODE"  => "A",
                                            "COMPOSITE_FRAME_TYPE"  => "AUTO",
                                        ),
                                        false
                                    ); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:sale.basket.basket.line",
                                    "template2",
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
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <?
        if ($curPage == SITE_DIR . "index.php") {
            ?>

            <div class="dispno">
                <aside id="colorlib-hero0">
                    <div class="flexslider1">
                        <ul class="slides1">
                            <li style="background-image: url(https://kalinza.ru/2/img/846_final.jpg);">
                                <div class="overlay"></div>
                                <div class="container container-fix1">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
                                            <div class="slider-text-inner">
                                                <h4 style="display:none;">Купи 2 упаковки любых линз Acuvue<b> и получи подарок!</b></h4>
                                                <p><a class="btn btn-primary btn-lg"
                                                      href="/catalog/johnson_johnson/"
                                                      style="z-index: 9999;position: relative;display: block; background: #15a0dc; color: #15a0dc; font-weight: bold;">Купить
                                                        сейчас</a></p>
                                            </div>
                                            <style>
                                                #colorlib-hero .flexslider .slider-text > .slider-text-inner .btn:hover, .dispno #colorlib-hero0 .flexslider1 .slides1 li .container .slider-text .slider-text-inner p a.btn {
                                                    color: #fff !important;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
            <section class="ac-container dispno">
                <div>
                    <input id="ac-1" name="accordion-1" type="checkbox" checked/>
                    <label for="ac-1">Контактные линзы <span></span></label>
                    <article id="ac_1">
                        <ul style="color:#000 !important;">
                            <li class="bx-inclinksfooter-item"><a href="/catalog/odnodnevnye/">Однодневные</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/dvukhnedelnye/">Двухнедельные</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/ezhemesyachnye/">Ежемесячные</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/kvartalnye/">Квартальные</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/nepreryvnogo_nosheniya/">Непрерывного ношения</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/toricheskie/">Торические</a></li>
                        </ul>
                    </article>
                </div>
                <div>
                    <input id="ac-2" name="accordion-2" type="checkbox" checked/>
                    <label for="ac-2">Цветные линзы<span></span></label>
                    <article id="ac_2">
                        <ul>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/odnodnevnye_linzy/">Однодневные линзы</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/ezhemesyachnye_linzy/">Ежемесячные линзы</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/kvartalnye_linzy/">Квартальные линзы</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/polgoda/">Полгода</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/svetlykh_i_temnykh_glaz&#9;/">Светлых и темных глаз</a></li>
                            <li class="bx-inclinksfooter-item"><a href="/catalog/svetlykh_glaz/">Светлых глаз</a></li>
                        </ul>
                    </article>
                </div>

                <div><a href="/catalog/rastvory/"><label for="ac-3">Растворы</label></a></div>
                <div><a href="/catalog/kapli/"><label for="ac-4">Капли</label></a></div>
                <div><a href="/catalog/aksessuary/"><label for="ac-5">Аксессуары</label></a></div>
                <div><a href="/catalog/skidki/"><label for="ac-6">Скидки</label></a></div>
            </section>

            <div style="height: 30px; width: 100%; clear: both;"></div>
            <?
        }
        ?>

        <!-- modal -->
        <div id="modal_1" class="modal-overlay">
            <div class="modal">

                <a class="close-modal">
                    <svg viewBox="0 0 20 20">
                        <path fill="#4ab8e6"
                              d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                    </svg>
                </a><!-- close modal -->

                <div class="modal-contents TOLKO_MAIN">
                    <table style="width: 100%; text-align: center;">
                        <tr>
                            <td><img src="/2/images/Logo.svg" width="80%"/></td>
                        </tr>
                    </table>
                    <div style="height: 50px; width: 100%; clear: both;"></div>

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.authorize",
                        "template1",
                        array(
                            "AUTH_RESULT"        => $APPLICATION->arAuthResult,
                            "COMPONENT_TEMPLATE" => "template1",
                        ),
                        false
                    ); ?>

                    <div style="height: 5px; width: 100%; clear: both;"></div>
                    <div class="dr_set">
                        <h3>Вход или регистрация<br>через соцсети</h3>
                        <?php
                        $APPLICATION->IncludeComponent(
                            "ulogin:auth",
                            "",
                            Array(
                                "SEND_MAIL"   => "N",
                                "SOCIAL_LINK" => "Y",
                                "GROUP_ID"    => array("5"),
                                "ULOGINID1"   => "",
                                "ULOGINID2"   => "",
                            )
                        );
                        ?>
                        <div style="height: 15px; width: 100%; clear: both;"></div>
                    </div>

                </div>

            </div>
        </div>

        <div id="modal_2" class="modal-overlay">
            <div class="modal">
                <a class="close-modal">
                    <svg viewBox="0 0 20 20">
                        <path fill="#4ab8e6"
                              d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                    </svg>
                </a><!-- close modal -->
                <div class="modal-contents TOLKO_MAIN">
                    <table style="width: 100%; text-align: center;">
                        <tr>
                            <td><img src="/2/images/Logo.svg" width="80%"/></td>
                        </tr>
                    </table>
                    <div class="fdgsfg" style="width:100%; text-align: center; padding-top: 20px;">
                        <h2>Закажите звонок</h2>
                        <p>И наши менеджеры перезвонят в течение 10 минут!</p>
                        <form method="post" action="/2/mail.php">
                            <div>
                                <input type="text" name="name" placeholder="Ваше имя" style="width:80%;" required>
                            </div>
                            <div>
                                <input type="text" name="phone" id="phone_mask" placeholder="Ваше телефон" style="width:80%;" required>
                            </div>
                            <div class="text30" style="width: 80%;padding-top: 10px;text-align: center;margin: 0 auto;">
                                <input type="checkbox" id="box-2" class="box" style="padding:5px;display: block;opacity: 0;" required>
                                <label for="box-2">Я согласен с политикой конфиденциальности и защиты информации</label>
                            </div>
                            <div style="padding-top:30px;">
                                <input type="submit" id="btn-submit" class="btn btn-primary btn-send-message btn-md" value="Отправить">
                            </div>
                        </form>
                    </div>
                    <div style="height: 40px; width: 100%; clear: both;"></div>
                </div>
            </div>
        </div>

        <div class="bx-wrapper" id="bx_eshop_wrap">
            <header class="bx-header">
                <div class="bx-header-section container">
                    <?
                    if ($curPage != SITE_DIR . "index.php") {
                        ?>
                        <div class="row">
                            <div class="col-lg-12" id="navigation">

                                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:breadcrumb",
                                    ".default",
                                    array(
                                        "START_FROM"         => "0",
                                        "PATH"               => "",
                                        "SITE_ID"            => "s1",
                                        "COMPONENT_TEMPLATE" => ".default",
                                    ),
                                    false,
                                    array(
                                        "HIDE_ICONS" => "N",
                                    )
                                ); ?>
                            </div>
                        </div>
                        <?
                    }
                    ?>
                </div>
            </header>

            <div class="workarea">
                <div class="container bx-content-seection">
                    <div class="row">

