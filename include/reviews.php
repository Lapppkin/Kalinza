<?

/**
 * Отзывы о товаре.
 *
 * @var $PRODUCT_ID - ID элемента инфоблока товара
 * @var $REVIEWS_IBLOCK_ID - ID инфоблока отзывов
 *
 * @author deadie
 */

?>
<div class="catalog-element-reviews" id="catalog-element-reviews" data-product-id="<?= $PRODUCT_ID ?>">
    <div class="catalog-element-reviews--title">
        <h4>Отзывы о товаре</h4>
    </div>

    <? global $arFilterReviews;
    $arFilterReviews = array(
        "IBLOCK_ID" => $REVIEWS_IBLOCK_ID,
        "ACTIVE" => "Y",
        "PROPERTY_PRODUCT_ID" => $PRODUCT_ID,
    );
    $res = \CIBlockElement::GetList(
        array(),
        $arFilterReviews,
        false,
        false,
        array('PROPERTIES')
    );
    $reviews_count = 0;
    while ($element = $res->GetNext()) {
        $reviews_count++;
    }
    ?>
    <div class="catalog-element-reviews--add-button">
        <button class="js-add-review btn"
            data-id="<?= $PRODUCT_ID ?>"
            backurl="<?= $APPLICATION->GetCurPage() ?>">Оставить отзыв</button>
    </div>

    <div class="catalog-element-reviews--content">
        <?
        if ($reviews_count > 0) {
            global $arReviewsFilter;
            $arReviewsFilter = array(
                "IBLOCK_ID" => REVIEWS_IBLOCK_ID,
                "ACTIVE" => "Y",
                "PROPERTY_PRODUCT_ID" => $PRODUCT_ID,
            );
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "reviews",
                array(
                    "IBLOCK_TYPE" => "reviews",
                    "IBLOCK_ID"   => REVIEWS_IBLOCK_ID,
                    "ACTIVE" => "Y",
                    "CACHE_TYPE" => "N",
                    "FILTER_NAME" => "arFilterReviews",
                    "PROPERTY_CODE" => array(
                        0 => "STARS",
                        1 => "EMAIL",
                        2 => "PHONE",
                        3 => "PRODUCT_ID",
                    ),
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                ),
                false
            );
        } else {
            echo 'Отзывов пока нет, однако, ваш может стать первым!';
        }
        ?>
    </div>

</div>
<!--/отзывы-->
