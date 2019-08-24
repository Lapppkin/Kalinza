<!--slider-->
<div class="slider">
    <div class="slider--wrapper">

        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "slider",
            array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => 12,
                "NEWS_COUNT" => 999,
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "",
                "SORT_ORDER2" => "",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "DETAIL_PICTURE",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "SLIDER_SHOW_TITLE",
                    1 => "SLIDER_LINK",
                    2 => "SLIDER_LINK_TEXT",
                    3 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_SHADOW" => "Y",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "PREVIEW_TRUNCATE_LEN" => "120",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "DISPLAY_PANEL" => "N",
                "SET_TITLE" => "N",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => "",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
                "PAGER_SHOW_ALL" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "COMPONENT_TEMPLATE" => "blog",
                "SET_BROWSER_TITLE" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_META_DESCRIPTION" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_SUBSECTIONS" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "MEDIA_PROPERTY" => "",
                "SEARCH_PAGE" => "/search/",
                "USE_RATING" => "N",
                "USE_SHARE" => "N",
                "PAGER_TITLE" => "Блог",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => "",
                "TEMPLATE_THEME" => "site",
            ),
            false
        );
        ?>
    </div>
    <div class="slider--nav"></div>
</div>
<?php
/*
?>
<div class="container container-fix">
    <div class="row row-slider-wrapper">
        <div class="slider-wrapper">
            <?php require __DIR__ . '/.component.slider.php'; ?>
        </div>
        <div class="block_0">
            <div class="block_2">
                <p>
                    Нужны очки?
                </p>
                <p>
                    Получи свой сертификат<br>
                    на 500 рублей
                </p>
                <form class="contact-form" method="post" action="/2/mail2.php">
                    <div class="form-group">
                        <input type="email"
                               class="form-control"
                               id="name"
                               required=""
                               name="email"
                               placeholder="Адрес электронной почты"
                               style="margin:0 auto !important; color:#fff;">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="btn-submit" class="btn btn-primary btn-send-message btn-md" value="Отправить">
                    </div>
                </form>
            </div>
            <div style="height: 15px; width: 100%; clear: both;">
            </div>
            <div class="block_3">
                <a href="/besplatnaya-proverka-zreniya/" style="color:#000;">
                    <p>
                        Бесплатная<br>
                        проверка зрения
                    </p>
                    <img src="/2/images/1/Bitmap3.png"> </a>
            </div>
        </div>
    </div>
</div>
<!--/slider-->

<div style="height: 45px; width: 100%; clear: both;"></div>


    */
?>
