<!--slider-->
<div class="slider">
    <div class="slider--wrapper">

        <?php
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "slider",
            array(
                "IBLOCK_TYPE" => "content",
                "IBLOCK_ID" => SLIDERS_IBLOCK_ID,
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

<div class="slider--catalog-link">
    <a href="/catalog/kontaktnye_linzy/">Каталог контактных линз</a>
</div>
