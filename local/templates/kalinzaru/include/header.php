<?

use core\Helper;

?>
<div class="header--header--logo">
    <a href="/">
        <img src="<?= SITE_TEMPLATE_PATH . '/images/svg/logo.svg' ?>" alt="kalinza.ru" title="На главную">
    </a>
</div>

<div class="header--header--search">
    <? $APPLICATION->IncludeComponent(
        'bitrix:search.title',
        'kalinza_visual',
        array(
            'NUM_CATEGORIES'            => '1',
            'TOP_COUNT'                 => '0',
            'CHECK_DATES'               => 'N',
            'SHOW_OTHERS'               => 'Y',
            'PAGE'                      => SITE_DIR . 'search/',
            'CATEGORY_0_TITLE'          => GetMessage('SEARCH_GOODS'),
            'CATEGORY_0'                => array(
                0 => 'no',
            ),
            'CATEGORY_0_iblock_catalog' => CATALOG_DEFAULT_IBLOCK_ID,
            'CATEGORY_OTHERS_TITLE'     => GetMessage('SEARCH_OTHER'),
            'SHOW_INPUT'                => 'Y',
            'INPUT_ID'                  => 'title-search-input',
            'CONTAINER_ID'              => 'title-search-result-wrapper',
            'PRICE_CODE'                => array(
                0 => 'BASE',
            ),
            'SHOW_PREVIEW'              => 'Y',
            'PREVIEW_WIDTH'             => '75',
            'PREVIEW_HEIGHT'            => '75',
            'CONVERT_CURRENCY'          => 'Y',
            'COMPONENT_TEMPLATE'        => 'kalinza_visual',
            'ORDER'                     => 'date',
            'USE_LANGUAGE_GUESS'        => 'Y',
            'PRICE_VAT_INCLUDE'         => 'Y',
            'PREVIEW_TRUNCATE_LEN'      => '',
            'CURRENCY_ID'               => 'RUB',
        ),
        false
    ); ?>
    <div id="search-title-result-wrapper"></div>
</div>

<div class="header--header--contacts">
    <div class="header--header--contacts-phone">
        <?php $APPLICATION->IncludeFile('/include/company_phone.php'); ?>
    </div>
    <div class="header--header--contacts-callback">
        <a href="#" data-toggle="modal" data-target="#modal--callback">Заказать звонок</a>
    </div>
    <div class="header--header--contacts-messengers">
        <? $APPLICATION->IncludeFile('/include/messenger_icons_short.php') ?>
    </div>
</div>
