<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$templateLibrary = ['popup'];
$currencyList    = '';
if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList      = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = [
    'TEMPLATE_THEME'   => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/style.css',
    'TEMPLATE_CLASS'   => 'bx_' . $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES'       => $currencyList,
];
unset($currencyList, $templateLibrary);

$strMainID              = $this->GetEditAreaId($arResult['ID']);
$arItemIDs              = [
    'ID'                 => $strMainID,
    'PICT'               => $strMainID . '_pict',
    'DISCOUNT_PICT_ID'   => $strMainID . '_dsc_pict',
    'STICKER_ID'         => $strMainID . '_sticker',
    'BIG_SLIDER_ID'      => $strMainID . '_big_slider',
    'BIG_IMG_CONT_ID'    => $strMainID . '_bigimg_cont',
    'SLIDER_CONT_ID'     => $strMainID . '_slider_cont',
    'SLIDER_LIST'        => $strMainID . '_slider_list',
    'SLIDER_LEFT'        => $strMainID . '_slider_left',
    'SLIDER_RIGHT'       => $strMainID . '_slider_right',
    'OLD_PRICE'          => $strMainID . '_old_price',
    'PRICE'              => $strMainID . '_price',
    'DISCOUNT_PRICE'     => $strMainID . '_price_discount',
    'SLIDER_CONT_OF_ID'  => $strMainID . '_slider_cont_',
    'SLIDER_LIST_OF_ID'  => $strMainID . '_slider_list_',
    'SLIDER_LEFT_OF_ID'  => $strMainID . '_slider_left_',
    'SLIDER_RIGHT_OF_ID' => $strMainID . '_slider_right_',
    'QUANTITY'           => $strMainID . '_quantity',
    'QUANTITY_DOWN'      => $strMainID . '_quant_down',
    'QUANTITY_UP'        => $strMainID . '_quant_up',
    'QUANTITY_MEASURE'   => $strMainID . '_quant_measure',
    'QUANTITY_LIMIT'     => $strMainID . '_quant_limit',
    'BASIS_PRICE'        => $strMainID . '_basis_price',
    'BUY_LINK'           => $strMainID . '_buy_link',
    'ADD_BASKET_LINK'    => $strMainID . '_add_basket_link',
    'BASKET_ACTIONS'     => $strMainID . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $strMainID . '_not_avail',
    'COMPARE_LINK'       => $strMainID . '_compare_link',
    'PROP'               => $strMainID . '_prop_',
    'PROP_DIV'           => $strMainID . '_skudiv',
    'DISPLAY_PROP_DIV'   => $strMainID . '_sku_prop',
    'OFFER_GROUP'        => $strMainID . '_set_group_',
    'BASKET_PROP_DIV'    => $strMainID . '_basket_prop',
];
$strObName              = 'ob' . preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
    : $arResult['NAME']
);
$strAlt   = (
isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
    : $arResult['NAME']
);
?>
<div id="<? echo $arItemIDs['ID']; ?>">

    <h1><span><?
            echo(
            isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
                ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
                : $arResult["NAME"]
            ); ?>
</span></h1>

    <?

    $arFirstPhoto = current($arResult['MORE_PHOTO']);

    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

    <div class="col-md-12">

        <link rel="stylesheet" href="/2/css/style_3.css">
        <link rel="stylesheet" href="/2/css/global.css">
        <div style="height: 5px; width: 100%; clear: both;"></div>
        <div class=" ">
            <div class="container container-fix">
                <div class="row">
                    <div class="col-md-10">
                        <table class="text30">

                            <tr>
                                <td>
                                    <div id="products_example">
                                        <div id="products">
                                            <div class="pagi_scr">
                                                <ul class="pagination">
                                                    <?
                                                    foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto) {
                                                        ?>
                                                        <li><a data-fancybox="gallery" href="<? echo $arOnePhoto['SRC']; ?>"><img src="<? echo $arOnePhoto['SRC']; ?>"
                                                                                                                                  width="55"
                                                                                                                                  alt="<? echo $arOnePhoto['ID']; ?>"></a></li>
                                                        <?
                                                    }
                                                    unset($arOnePhoto);
                                                    ?>
                                                    <?
                                                    $URL         = '';
                                                    $ID_PICTYRE1 = '';
                                                    $ID_PICTYRE1 = $arResult["PROPERTIES"]["dopf1"]["VALUE"];
                                                    $URL         = CFile::GetPath($ID_PICTYRE1);
                                                    if (!empty($URL)) {
                                                        echo '<li><a data-fancybox="gallery" id="f1" href="' . $URL . '"><img src="' . $URL . '" width="55" alt="' . $URL . '"></a></li>';
                                                    }
                                                    $URL         = '';
                                                    $ID_PICTYRE1 = '';
                                                    ?>
                                                    <?
                                                    $URL2        = '';
                                                    $ID_PICTYRE2 = '';
                                                    $ID_PICTYRE2 = $arResult["PROPERTIES"]["dopf2"]["VALUE"];
                                                    $URL2        = CFile::GetPath($ID_PICTYRE2);
                                                    if (!empty($URL2)) {
                                                        echo '<li><a data-fancybox="gallery" id="f2" href="' . $URL2 . '"><img src="' . $URL2 . '" width="55" alt="' . $URL2 . '"></a></li>';
                                                    }
                                                    $URL2        = '';
                                                    $ID_PICTYRE2 = '';
                                                    ?>
                                                    <?
                                                    $URL3        = '';
                                                    $ID_PICTYRE3 = '';
                                                    $ID_PICTYRE3 = $arResult["PROPERTIES"]["dopf3"]["VALUE"];
                                                    $URL3        = CFile::GetPath($ID_PICTYRE3);
                                                    if (!empty($URL3)) {
                                                        echo '<li><a data-fancybox="gallery" id="f3" href="' . $URL3 . '"><img src="' . $URL3 . '" width="55" alt="' . $URL3 . '"></a></li>';
                                                    }
                                                    $URL3        = '';
                                                    $ID_PICTYRE3 = '';
                                                    ?>
                                                    <?
                                                    $URL4        = '';
                                                    $ID_PICTYRE4 = '';
                                                    $ID_PICTYRE4 = $arResult["PROPERTIES"]["dopf4"]["VALUE"];
                                                    $URL4        = CFile::GetPath($ID_PICTYRE4);
                                                    if (!empty($URL4)) {
                                                        echo '<li><a data-fancybox="gallery" id="f4" href="' . $URL4 . '"><img src="' . $URL4 . '" width="55" alt="' . $URL4 . '"></a></li>';
                                                    }
                                                    $URL4        = '';
                                                    $ID_PICTYRE4 = '';
                                                    ?>
                                                    <?
                                                    $URL5        = '';
                                                    $ID_PICTYRE5 = '';
                                                    $ID_PICTYRE5 = $arResult["PROPERTIES"]["dopf5"]["VALUE"];
                                                    $URL5        = CFile::GetPath($ID_PICTYRE5);
                                                    if (!empty($URL5)) {
                                                        echo '<li><a data-fancybox="gallery" id="f5" href="' . $URL5 . '"><img src="' . $URL5 . '" width="55" alt="' . $URL5 . '"></a></li>';
                                                    }
                                                    $URL5        = '';
                                                    $ID_PICTYRE5 = '';
                                                    ?>
                                                    <?
                                                    $URL6        = '';
                                                    $ID_PICTYRE6 = '';
                                                    $ID_PICTYRE6 = $arResult["PROPERTIES"]["dopf6"]["VALUE"];
                                                    $URL6        = CFile::GetPath($ID_PICTYRE6);
                                                    if (!empty($URL6)) {
                                                        echo '<li><a data-fancybox="gallery" id="f6" href="' . $URL6 . '"><img src="' . $URL6 . '" width="55" alt="' . $URL6 . '"></a></li>';
                                                    }
                                                    $URL6        = '';
                                                    $ID_PICTYRE6 = '';
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="slides_container">
                                                <?
                                                foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto) {
                                                    ?>
                                                    <a data-fancybox="gallery" href="<? echo $arOnePhoto['SRC']; ?>"><img src="<? echo $arOnePhoto['SRC']; ?>"
                                                                                                                          width="366"
                                                                                                                          alt="<? echo $arOnePhoto['ID']; ?>"></a>
                                                    <?
                                                }
                                                unset($arOnePhoto);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>

                                    <div class="price">
                                        <?
                                        if (!empty($arResult["PROPERTIES"]["skidka"]["VALUE"])) {
                                            echo '<div class="price_old">' . $arResult["PROPERTIES"]["skidka"]["VALUE"] . ' ₽</div>';
                                        }
                                        ?>
                                        <div class="price_new">
                                            <div id="mydiv" style="float:left;"><? echo $arResult['PRICES']["BASE"]["VALUE"]; ?></div>
                                            ₽
                                        </div>

                                    </div>

                                    <?
                                    if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                        echo '

                                    <div style="height: 70px; width: 100%; clear: both;"></div>
                                      <input name="checkboxbox" type="checkbox" checked id="box-1" class="box" onClick="hideOrShowText()">
                                      <label for="box-1">одинаковые значения для обоих глаз</label>
                                    <div style="height: 10px; width: 100%; clear: both;"></div>
';
                                    }
                                    ?>
                                    <table class="text40">
                                        <?
                                        if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                            echo '
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Правый глаз</th>
                                                            <th id="ifff1" style="opacity: 0.5; cursor: not-allowed;">Левый глаз</th>
                                                        </tr>
                                                    </thead>
';
                                        }
                                        ?>
                                        <tbody>

                                        <?
                                        //echo "<pre>";
                                        //print_r($arResult);
                                        //echo "</pre>";

                                        ?>


                                        <?

                                        ?>

                                        <? if ($tralala == '1') { ?>
                                            <select class="product-item-scu-container seleee">
                                                <? foreach ($arResult["OFFERS"] as $arOffer) {
                                                    foreach ($arOffer["PROPERTIES"] as $arPrice) { ?>
                                                        <? if ($arPrice["PROPERTY_TYPE"] == "L") { ?>
                                                            <option value="<? echo $arPrice["ID"]; ?>"><? echo $arPrice["VALUE"]; ?></option>
                                                        <? }
                                                    }
                                                } ?>
                                            </select>
                                        <? } ?>

                                        <?
                                        //$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
                                        //if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
                                        //{
                                        ?>
                                        <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>">
                                            <?
                                            if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                                                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {
                                                    ?>
                                                    <input type="hidden"
                                                           name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                                           value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                                                    <?
                                                    if (isset($arResult['PRODUCT_PROPERTIES'][$propID])) {
                                                        unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                                                    }
                                                }
                                            }
                                            //$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
                                            //if (!$emptyProductProperties)
                                            //{
                                            ?>
                                            <div>
                                                <?
                                                foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo) {
                                                    ?>
                                                    <div>
                                                        <div><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></div>
                                                        <div>
                                                            <?
                                                            if (
                                                                'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
                                                                && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
                                                            ) {
                                                                foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                    ?><label><input type="radio"
                                                                                    name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"
                                                                                    value="<? echo $valueID; ?>" <? echo($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
                                                                    </label><br><?
                                                                }
                                                            } else {
                                                                ?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
                                                                foreach ($propInfo['VALUES'] as $valueID => $value) {
                                                                    ?>
                                                                    <option value="<? echo $valueID; ?>" <? echo($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option><?
                                                                }
                                                                ?></select><?
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                            <?
                                            //}
                                            ?>
                                        </div>

                                        <?php
                                        //echo "<pre>";
                                        //print_r($productname);
                                        //echo "</pre>";

                                        //echo "<pre>";
                                        //print_r($arResult);
                                        //echo "</pre>";

                                        if (isset($_POST['nazvanie_knopki'])) {

                                            if (CModule::IncludeModule("sale")) {
                                                $productnam       = [];
                                                $products_in_cart = CSaleBasket::GetList([], [
                                                    'FUSER_ID' => CSaleBasket::GetBasketUserID(),
                                                    'LID'      => SITE_ID,
                                                    'ORDER_ID' => null,
                                                ], false, false, [
                                                    'ID',
                                                    'NAME',
                                                    'PRODUCT_PRICE_ID',
                                                    'PRICE',
                                                    'CURRENCY',
                                                    'QUANTITY',
                                                    'DETAIL_PAGE_URL',
                                                ]);

                                                while ($product = $products_in_cart->GetNext()) {
                                                    $productnam[] = $product['NAME'];
                                                }
                                            }
                                            if (in_array("Подарок", $productnam)) {
                                            } else {
                                                if (CModule::IncludeModule("sale")) {
                                                    $arFields = [
                                                        "PRODUCT_ID"      => 577,
                                                        "PRICE"           => 0,
                                                        "CURRENCY"        => "RUB",
                                                        "QUANTITY"        => 1,
                                                        "LID"             => s1,
                                                        "DELAY"           => "N",
                                                        "CAN_BUY"         => "Y",
                                                        "MODULE"          => "catalog",
                                                        "DETAIL_PAGE_URL" => "/aksessuary/magnitik/",
                                                        "NAME"            => "Подарок",
                                                    ];

                                                    $arProps           = [];
                                                    $arFields["PROPS"] = $arProps;
                                                    CSaleBasket::Add($arFields);
                                                }
                                            }

                                            if (CModule::IncludeModule("sale")) {
                                                $productId = $arResult['ID'];
                                            }
                                            $productUrl1 = preg_replace('/\/catalog/', '', $arResult['DETAIL_PAGE_URL']);
                                            $productUrl  = $productUrl1;
                                            {

                                                if ($arResult['SECTION']['PATH'][0]['ID'] != '18') {
                                                    $arFields = [
                                                        "PRODUCT_ID"      => $productId,
                                                        "PRICE"           => $_POST['price'],
                                                        "CURRENCY"        => "RUB",
                                                        "QUANTITY"        => $_POST['kolvo'],
                                                        "DETAIL_PAGE_URL" => $productUrl,
                                                        "LID"             => s1,
                                                        "DELAY"           => "N",
                                                        "CAN_BUY"         => "Y",
                                                        "MODULE"          => "catalog",
                                                        "CATALOG_XML_ID"  => $arResult["SECTION"]["ID"],
                                                        "NAME"            => $arResult['NAME'],
                                                    ];

                                                    $arProps = [];

                                                    if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Базовая кривизна П",
                                                            "VALUE" => $_POST["b_k1"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Базовая кривизна Л",
                                                            "VALUE" => $_POST["b_k2"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Оптическая сила Л",
                                                            "VALUE" => $_POST["o_s1"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Оптическая сила П",
                                                            "VALUE" => $_POST["o_s2"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Цвет Л",
                                                            "VALUE" => $_POST["COLOR1"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Цвет П",
                                                            "VALUE" => $_POST["COLOR2"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Аддидация Л",
                                                            "VALUE" => $_POST["a_d1"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Аддидация П",
                                                            "VALUE" => $_POST["a_d2"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Сфера Л",
                                                            "VALUE" => $_POST["sf1"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Сфера П",
                                                            "VALUE" => $_POST["sf2"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Ось Л",
                                                            "VALUE" => $_POST["os1"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Ось П",
                                                            "VALUE" => $_POST["os2"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Цилиндр Л",
                                                            "VALUE" => $_POST["ci1"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Цилиндр П",
                                                            "VALUE" => $_POST["ci2"],
                                                        ];
                                                    }
                                                    if (!empty($arResult["PROPERTIES"]["ob2"]["VALUE"])) {
                                                        $arProps[] = [
                                                            "NAME"  => "Объем",
                                                            "VALUE" => $_POST["ob22"],
                                                        ];
                                                    }

                                                    $arFields["PROPS"] = $arProps;
                                                    CSaleBasket::Add($arFields);
                                                } else {

                                                    if ($_POST['ckeeeeee'] == '1') {

                                                        $arFields = [
                                                            "PRODUCT_ID"      => $productId,
                                                            "PRICE"           => $_POST['price'],
                                                            "CURRENCY"        => "RUB",
                                                            "QUANTITY"        => '1',
                                                            "DETAIL_PAGE_URL" => $productUrl,
                                                            "LID"             => s1,
                                                            "DELAY"           => "N",
                                                            "CAN_BUY"         => "Y",
                                                            "MODULE"          => "catalog",
                                                            "CATALOG_XML_ID"  => $arResult["SECTION"]["ID"],
                                                            "NAME"            => $arResult['NAME'] . ' Left',
                                                        ];

                                                        $arProps = [];

                                                        if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Базовая кривизна Л",
                                                                "VALUE" => $_POST["b_k1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Оптическая сила Л",
                                                                "VALUE" => $_POST["o_s1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цвет Л",
                                                                "VALUE" => $_POST["COLOR1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Аддидация Л",
                                                                "VALUE" => $_POST["a_d1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Сфера Л",
                                                                "VALUE" => $_POST["sf1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Ось Л",
                                                                "VALUE" => $_POST["os1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цилиндр Л",
                                                                "VALUE" => $_POST["ci1"],
                                                            ];
                                                        }

                                                        $arFields["PROPS"] = $arProps;
                                                        CSaleBasket::Add($arFields);

                                                        $arFields = [
                                                            "PRODUCT_ID"      => $productId . ' 2',
                                                            "PRICE"           => $_POST['price'],
                                                            "CURRENCY"        => "RUB",
                                                            "QUANTITY"        => '1',
                                                            "DETAIL_PAGE_URL" => $productUrl,
                                                            "LID"             => s1,
                                                            "DELAY"           => "N",
                                                            "CAN_BUY"         => "Y",
                                                            "MODULE"          => "catalog",
                                                            "CATALOG_XML_ID"  => $arResult["SECTION"]["ID"],
                                                            "NAME"            => $arResult['NAME'] . ' Right',
                                                        ];

                                                        $arProps = [];

                                                        if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Базовая кривизна П",
                                                                "VALUE" => $_POST["b_k2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Оптическая сила П",
                                                                "VALUE" => $_POST["o_s2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цвет П",
                                                                "VALUE" => $_POST["COLOR2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Аддидация П",
                                                                "VALUE" => $_POST["a_d2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Сфера П",
                                                                "VALUE" => $_POST["sf2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Ось П",
                                                                "VALUE" => $_POST["os2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цилиндр П",
                                                                "VALUE" => $_POST["ci2"],
                                                            ];
                                                        }

                                                        $arFields["PROPS"] = $arProps;
                                                        CSaleBasket::Add($arFields);
                                                    } else {

                                                        $arFields = [
                                                            "PRODUCT_ID"      => $productId,
                                                            "PRICE"           => $_POST['price'],
                                                            "CURRENCY"        => "RUB",
                                                            "QUANTITY"        => $_POST['kolvo'],
                                                            "DETAIL_PAGE_URL" => $productUrl,
                                                            "LID"             => s1,
                                                            "DELAY"           => "N",
                                                            "CAN_BUY"         => "Y",
                                                            "MODULE"          => "catalog",
                                                            "CATALOG_XML_ID"  => $arResult["SECTION"]["ID"],
                                                            "NAME"            => $arResult['NAME'],
                                                        ];

                                                        $arProps = [];

                                                        if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Базовая кривизна П",
                                                                "VALUE" => $_POST["b_k1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Базовая кривизна Л",
                                                                "VALUE" => $_POST["b_k2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Оптическая сила Л",
                                                                "VALUE" => $_POST["o_s1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Оптическая сила П",
                                                                "VALUE" => $_POST["o_s2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цвет Л",
                                                                "VALUE" => $_POST["COLOR1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цвет П",
                                                                "VALUE" => $_POST["COLOR2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Аддидация Л",
                                                                "VALUE" => $_POST["a_d1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Аддидация П",
                                                                "VALUE" => $_POST["a_d2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Сфера Л",
                                                                "VALUE" => $_POST["sf1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Сфера П",
                                                                "VALUE" => $_POST["sf2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Ось Л",
                                                                "VALUE" => $_POST["os1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Ось П",
                                                                "VALUE" => $_POST["os2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цилиндр Л",
                                                                "VALUE" => $_POST["ci1"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Цилиндр П",
                                                                "VALUE" => $_POST["ci2"],
                                                            ];
                                                        }
                                                        if (!empty($arResult["PROPERTIES"]["ob2"]["VALUE"])) {
                                                            $arProps[] = [
                                                                "NAME"  => "Объем",
                                                                "VALUE" => $_POST["ob22"],
                                                            ];
                                                        }

                                                        $arFields["PROPS"] = $arProps;
                                                        CSaleBasket::Add($arFields);

                                                    }

                                                }

                                                if (!$arFields) {
                                                    $strError = '';
                                                    /** @global $APPLICATION $ex */
                                                    if ($ex = $APPLICATION->GetException()) {
                                                        $strError = $ex->GetString();
                                                    }
                                                    //echo sprintf('Ошибка добавления товара %s в корзину: %s', $productId, $strError);
                                                } else {
                                                    //echo sprintf('Товар %s успешно добавлен в корзину', $productId);
                                                    LocalRedirect("/personal/cart/");
                                                }
                                            }
                                        }
                                        ?>
                                        <form method="POST">
                                            <input type="hidden" name="ckeeeeee" id="ckeeeeee" value="0">
                                            <input type="hidden" name="element_id" value="<?= $arResult['ID'] ?>">
                                            <input type="hidden" name="price" id="price_t" value="<?= $arResult['PRICES']["BASE"]["VALUE"] ?>">
                                            <input type="hidden" name="ob22" id="ob22" value="<?= $arResult["PROPERTIES"]["ob2"]["VALUE"][0] ?>">

                                            <?
                                            if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Базовая кривизна</td>
                                                            			<td><select name="b_k1" class="seleee">
																		';
                                                $val = count($arResult["PROPERTIES"]["b_k"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select>
																		</td>
                                                            			<td><select id="ifff2" name="b_k2" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled>
																		';
                                                $val = count($arResult["PROPERTIES"]["b_k"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <?
                                            if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Оптическая сила</td>
                                                            			<td><select name="o_s1" class="seleee">
																		';
                                                $val = count($arResult["PROPERTIES"]["o_s"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
                                                            			<td><select id="ifff3" name="o_s2" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled="disabled">
																		';
                                                $val = count($arResult["PROPERTIES"]["o_s"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <?
                                            if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Аддидация</td>
                                                            			<td><select name="a_d1" class="seleee">
																		';
                                                $val = count($arResult["PROPERTIES"]["a_d"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
                                                            			<td><select id="ifff4" name="a_d2" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled="disabled">';
                                                $val = count($arResult["PROPERTIES"]["a_d"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <?
                                            if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Сфера</td>
                                                            			<td><select name="sf1" class="seleee">';
                                                $val = count($arResult["PROPERTIES"]["sf"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["sf"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["sf"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
                                                            			<td><select name="sf2" id="ifff5" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled>';
                                                $val = count($arResult["PROPERTIES"]["sf"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["sf"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["sf"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <?
                                            if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Цилиндр</td>
                                                            			<td><select name="ci1" class="seleee">
																		';
                                                $val = count($arResult["PROPERTIES"]["ci"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["ci"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["ci"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
                                                            			<td><select id="ifff6" name="ci2" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled>
																		';
                                                $val = count($arResult["PROPERTIES"]["ci"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["ci"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["ci"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <?
                                            if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Ось</td>
                                                            			<td><select name="os1" class="seleee">
																		';
                                                $val = count($arResult["PROPERTIES"]["os"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["os"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["os"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
                                                            			<td><select id="ifff7" name="os2" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled>
																		';
                                                $val = count($arResult["PROPERTIES"]["os"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["os"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["os"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <?
                                            if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Цвет</td>
                                                        				<td>
																		<select name="COLOR1" class="seleee">
																		';
                                                $val = count($arResult["PROPERTIES"]["COLOR"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select>
																	</td>
                                                            			<td><select  name="COLOR2" id="ifff8" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled>
																		';
                                                $val = count($arResult["PROPERTIES"]["COLOR"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option value="' . $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select></td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <?
                                            if (!empty($arResult["PROPERTIES"]["ob2"]["VALUE"])) {
                                                echo '
																	<tr>
																		<td>Объем</td>
                                                        				<td>
																		<select name="ob21" id="myselect" class="seleee">
																		';
                                                $val = count($arResult["PROPERTIES"]["ob2"]["VALUE"]);
                                                for ($i = 0; $i < $val; $i++) {
                                                    echo '<option data="' . $arResult["PROPERTIES"]["ob2"]["VALUE"][$i] . '" value="' . $arResult["PROPERTIES"]["cob2"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["ob2"]["VALUE"][$i] . '</option>';
                                                }
                                                echo '
																	</select>
																	</td>
																	</tr>
																	';
                                            }
                                            ?>
                                            <script type="text/javascript">
                                                document.getElementById('myselect').addEventListener('change', function() {
                                                    var text1                                  = document.getElementById('mydiv');
                                                    document.getElementById('mydiv').innerHTML = this.value;
                                                    document.getElementById('price_t').value   = this.value;
                                                    document.getElementById('ob22').value      = $(this).find('option:selected').text();
                                                });
                                            </script>
                                            <tr>
                                                <td>Количество</td>
                                                <td colspan=2><input name="kolvo" id="koll" type="text" value="1">, уп.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div style="height: 15px; width: 100%; clear: both;"></div>
                                    <p><input type="submit" class="btn btn-primary btn-lg bx_big bx_bt_button bx_cart" name="nazvanie_knopki" value="Добавить в корзину"/></p>
                                    </form>
                                    <!-- <p><a class="btn btn-primary btn-lg bx_big bx_bt_button bx_cart" href="javascript:void(0);"id="<? echo $arItemIDs['BUY_LINK']; ?>">Добавить в корзину</a></p> -->
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="col-md-2 text5">
                        <h5><b>Быстро оформить
                                заказ</b></h5>
                        <p>
                            Введите Ваше имя
                            и номер телефона, мы сами оформим заказ и Вам перезвоним.
                        </p>

                        <form class="font11" action="/2/mail3.php" method="post">
                            <input type="text" name="name" value="" placeholder="Имя" required/>
                            <input type="text" name="phone" value="" placeholder="Телефон" required/>
                            <input type="hidden" name="tovar" value="https://kalinza.ru<? echo $arResult["ORIGINAL_PARAMETERS"]["CURRENT_BASE_PAGE"]; ?> "/>
                            <input class="btn btn-primary btn-lg" type="submit" value="Отправить"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div style="height: 45px; width: 100%; clear: both;"></div>

        <div class="text2">
            <div class="container container-fix1">
                <div class="row">
                    <div class="col-md-5">

                        <h5>Описание товара</h5>

                        <p class="textp">
                            <? echo $arResult["DETAIL_TEXT"]; ?><br><br>
                        </p>

                        <!-- <img src="/2/images/brans.png"/> -->
                    </div>
                    <div class="col-md-4">

                        <h5>Характеристики товара</h5>
                        <table class="textt">
                            <?
                            if (!empty($arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"])) {
                                echo '
											<tr>
												<td>Производитель</td><td>' . $arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["Srok"]["VALUE"])) {
                                echo '
											<tr>
												<td>Срок ношения</td><td>' . $arResult["PROPERTIES"]["Srok"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["Shtyk"]["VALUE"])) {
                                echo '
											<tr>
												<td>Штук в упаковке</td><td>' . $arResult["PROPERTIES"]["Shtyk"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["Vlago"]["VALUE"])) {
                                echo '
											<tr>
												<td>Влагосодержание</td><td>' . $arResult["PROPERTIES"]["Vlago"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["Pronic"]["VALUE"])) {
                                echo '
											<tr>
												<td>Проницаемость</td><td>' . $arResult["PROPERTIES"]["Pronic"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["Rezh"]["VALUE"])) {
                                echo '
											<tr>
												<td>Режим ношения</td><td>' . $arResult["PROPERTIES"]["Rezh"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["Mat"]["VALUE"])) {
                                echo '
											<tr>
												<td>Материал</td><td>' . $arResult["PROPERTIES"]["Mat"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["Diam"]["VALUE"])) {
                                echo '
											<tr>
												<td>Диаметр</td><td>' . $arResult["PROPERTIES"]["Diam"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ?>
                            <?
                            if (!empty($arResult["PROPERTIES"]["ob"]["VALUE"])) {
                                echo '
											<tr>
												<td>Объем</td><td>' . $arResult["PROPERTIES"]["ob"]["VALUE"] . '</td>
											</tr>
											';
                            }
                            ob
                            ?>
                        </table>
                    </div>
                    <div class="col-md-2 provvvv">
                        <a href="/besplatnaya-proverka-zreniya/index.php/">
                            <img src="/2/images/shbmnk.jpg"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div style="width: 100%; height: 45px; clear: both;"></div>

        <div class=" ">
            <div class="container container-fix">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Недавно вы просматривали</h4>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:catalog.products.viewed",
                            ".default",
                            [
                                "ACTION_VARIABLE"             => "action_cpv",
                                "ADDITIONAL_PICT_PROP_2"      => "MORE_PHOTO",
                                "ADDITIONAL_PICT_PROP_3"      => "-",
                                "ADD_PROPERTIES_TO_BASKET"    => "Y",
                                "ADD_TO_BASKET_ACTION"        => "BUY",
                                "BASKET_URL"                  => "/personal/cart/",
                                "CACHE_GROUPS"                => "Y",
                                "CACHE_TIME"                  => "3600",
                                "CACHE_TYPE"                  => "A",
                                "CART_PROPERTIES_2"           => [
                                    0 => "NEWPRODUCT",
                                    1 => "NEWPRODUCT,SALELEADER",
                                    2 => "",
                                ],
                                "CART_PROPERTIES_3"           => [
                                    0 => "COLOR_REF",
                                    1 => "SIZES_SHOES",
                                    2 => "",
                                ],
                                "CONVERT_CURRENCY"            => "Y",
                                "CURRENCY_ID"                 => "RUB",
                                "DATA_LAYER_NAME"             => "dataLayer",
                                "DEPTH"                       => "",
                                "DISCOUNT_PERCENT_POSITION"   => "top-right",
                                "ENLARGE_PRODUCT"             => "STRICT",
                                "ENLARGE_PROP_2"              => "NEWPRODUCT",
                                "HIDE_NOT_AVAILABLE"          => "N",
                                "HIDE_NOT_AVAILABLE_OFFERS"   => "L",
                                "IBLOCK_ID"                   => "2",
                                "IBLOCK_MODE"                 => "single",
                                "IBLOCK_TYPE"                 => "catalog",
                                "LABEL_PROP_2"                => [
                                    0 => "NEWPRODUCT",
                                ],
                                "LABEL_PROP_MOBILE_2"         => "",
                                "LABEL_PROP_POSITION"         => "top-left",
                                "MESS_BTN_ADD_TO_BASKET"      => "В корзину",
                                "MESS_BTN_BUY"                => "Купить",
                                "MESS_BTN_DETAIL"             => "Подробнее",
                                "MESS_BTN_SUBSCRIBE"          => "Подписаться",
                                "MESS_NOT_AVAILABLE"          => "Нет в наличии",
                                "MESS_RELATIVE_QUANTITY_FEW"  => "мало",
                                "MESS_RELATIVE_QUANTITY_MANY" => "много",
                                "MESS_SHOW_MAX_QUANTITY"      => "Наличие",
                                "OFFER_TREE_PROPS_3"          => [
                                    0 => "COLOR_REF",
                                    1 => "SIZES_SHOES",
                                    2 => "SIZES_CLOTHES",
                                ],
                                "PAGE_ELEMENT_COUNT"          => "3",
                                "PARTIAL_PRODUCT_PROPERTIES"  => "N",
                                "PRICE_CODE"                  => [
                                    0 => "BASE",
                                ],
                                "PRICE_VAT_INCLUDE"           => "Y",
                                "PRODUCT_BLOCKS_ORDER"        => "price,props,quantityLimit,sku,quantity,buttons,compare",
                                "PRODUCT_ID_VARIABLE"         => "id",
                                "PRODUCT_PROPS_VARIABLE"      => "prop",
                                "PRODUCT_QUANTITY_VARIABLE"   => "",
                                "PRODUCT_ROW_VARIANTS"        => "[{'VARIANT':'2','BIG_DATA':false}]",
                                "PRODUCT_SUBSCRIPTION"        => "Y",
                                "PROPERTY_CODE_2"             => [
                                    0 => "NEWPRODUCT",
                                    1 => "SALELEADER",
                                    2 => "SPECIALOFFER",
                                    3 => "MANUFACTURER",
                                    4 => "MATERIAL",
                                    5 => "COLOR",
                                    6 => "SALELEADER,SPECIALOFFER,MATERIAL,COLOR,KEYWORDS,BRAND_REF",
                                    7 => "",
                                ],
                                "PROPERTY_CODE_3"             => [
                                    0 => "ARTNUMBER",
                                    1 => "COLOR_REF",
                                    2 => "SIZES_SHOES",
                                    3 => "SIZES_CLOTHES",
                                    4 => "",
                                ],
                                "PROPERTY_CODE_MOBILE_2"      => "",
                                "RELATIVE_QUANTITY_FACTOR"    => "5",
                                "SECTION_CODE"                => "",
                                "SECTION_ELEMENT_CODE"        => "",
                                "SECTION_ELEMENT_ID"          => "",
                                "SECTION_ID"                  => "",
                                "SHOW_CLOSE_POPUP"            => "N",
                                "SHOW_DISCOUNT_PERCENT"       => "N",
                                "SHOW_FROM_SECTION"           => "N",
                                "SHOW_MAX_QUANTITY"           => "N",
                                "SHOW_OLD_PRICE"              => "N",
                                "SHOW_PRICE_COUNT"            => "1",
                                "SHOW_PRODUCTS_2"             => "N",
                                "SHOW_SLIDER"                 => "N",
                                "SLIDER_INTERVAL"             => "3000",
                                "SLIDER_PROGRESS"             => "Y",
                                "TEMPLATE_THEME"              => "",
                                "USE_ENHANCED_ECOMMERCE"      => "N",
                                "USE_PRICE_COUNT"             => "N",
                                "USE_PRODUCT_QUANTITY"        => "N",
                                "COMPONENT_TEMPLATE"          => ".default",
                                "DISPLAY_COMPARE"             => "N",
                                "PROPERTY_CODE_4"             => [
                                ],
                                "PROPERTY_CODE_MOBILE_4"      => [
                                ],
                                "CART_PROPERTIES_4"           => [
                                ],
                                "ADDITIONAL_PICT_PROP_4"      => "-",
                                "LABEL_PROP_4"                => [
                                ],
                                "PROPERTY_CODE_5"             => [
                                ],
                                "PROPERTY_CODE_MOBILE_5"      => [
                                ],
                                "CART_PROPERTIES_5"           => [
                                ],
                                "ADDITIONAL_PICT_PROP_5"      => "-",
                                "LABEL_PROP_5"                => [
                                ],
                                "PROPERTY_CODE_7"             => [
                                ],
                                "PROPERTY_CODE_MOBILE_7"      => [
                                ],
                                "CART_PROPERTIES_7"           => [
                                ],
                                "ADDITIONAL_PICT_PROP_7"      => "-",
                                "LABEL_PROP_7"                => [
                                ],
                                "PROPERTY_CODE_8"             => [
                                ],
                                "PROPERTY_CODE_MOBILE_8"      => [
                                ],
                                "CART_PROPERTIES_8"           => [
                                ],
                                "ADDITIONAL_PICT_PROP_8"      => "-",
                                "LABEL_PROP_8"                => [
                                ],
                            ],
                            false
                        ); ?>
                    </div>
                    <div class="col-md-6">
                        <h4>Наши курьеры и операторы</h4>
                        <div class=" ">
                            <aside id="colorlib-hero22">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <li>
                                            <a href="/kalinza-v-litsakh/" style="color:#000;text-decoration:none;">
                                        <li>
                                            <img src="/2/images/1/lica.png"/>
                                            <div class="overlay"></div>
                                            <div class="container2">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
                                                        <div class="slider-text-inner">
                                                            <h4><b>Артюхов Сергей</b></h4>
                                                            <p>Оптометрист</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:none;">
            <?
            if ('Y' == $arParams['DISPLAY_NAME']) {
                ?>
                <div class="bx_item_title"><span><?
                        echo(
                        isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != ''
                            ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]
                            : $arResult["NAME"]
                        ); ?>
</span></div>
                <?
            }
            reset($arResult['MORE_PHOTO']);
            $arFirstPhoto = current($arResult['MORE_PHOTO']);
            ?>
            <div class="bx_item_container">
                <div class="bx_lt">
                    <div class="bx_item_slider" id="<? echo $arItemIDs['BIG_SLIDER_ID']; ?>">
                        <div class="bx_bigimages" id="<? echo $arItemIDs['BIG_IMG_CONT_ID']; ?>">
                            <div class="bx_bigimages_imgcontainer">
                                <span class="bx_bigimages_aligner"><img id="<? echo $arItemIDs['PICT']; ?>"
                                                                        src="<? echo $arFirstPhoto['SRC']; ?>"
                                                                        alt="<? echo $strAlt; ?>"
                                                                        title="<? echo $strTitle; ?>"></span>
                                <?
                                if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']) {
                                    if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])) {
                                        if (0 < $arResult['MIN_PRICE']['DISCOUNT_DIFF']) {
                                            ?>
                                            <div class="bx_stick_disc right bottom"
                                                 id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>"><? echo -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']; ?>%
                                            </div>
                                            <?
                                        }
                                    } else {
                                        ?>
                                        <div class="bx_stick_disc right bottom" id="<? echo $arItemIDs['DISCOUNT_PICT_ID'] ?>" style="display: none;"></div>
                                        <?
                                    }
                                }
                                if ($arResult['LABEL']) {
                                    ?>
                                    <div class="bx_stick average left top"
                                         id="<? echo $arItemIDs['STICKER_ID'] ?>"
                                         title="<? echo $arResult['LABEL_VALUE']; ?>"><? echo $arResult['LABEL_VALUE']; ?></div>
                                    <?
                                }
                                ?>
                            </div>
                        </div>
                        <?
                        if ($arResult['SHOW_SLIDER']) {
                            if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])) {
                                if (5 < $arResult['MORE_PHOTO_COUNT']) {
                                    $strClass      = 'bx_slider_conteiner full';
                                    $strOneWidth   = (100 / $arResult['MORE_PHOTO_COUNT']) . '%';
                                    $strWidth      = (20 * $arResult['MORE_PHOTO_COUNT']) . '%';
                                    $strSlideStyle = '';
                                } else {
                                    $strClass      = 'bx_slider_conteiner';
                                    $strOneWidth   = '20%';
                                    $strWidth      = '100%';
                                    $strSlideStyle = 'display: none;';
                                }
                                ?>
                                <div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['SLIDER_CONT_ID']; ?>">
                                    <div class="bx_slider_scroller_container">
                                        <div class="bx_slide">
                                            <ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST']; ?>">
                                                <?
                                                foreach ($arResult['MORE_PHOTO'] as &$arOnePhoto) {
                                                    ?>
                                                    <li data-value="<? echo $arOnePhoto['ID']; ?>" style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;">
                                                        <span class="cnt"><span class="cnt_item" style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></span></li>
                                                    <?
                                                }
                                                unset($arOnePhoto);
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="bx_slide_left" id="<? echo $arItemIDs['SLIDER_LEFT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                                        <div class="bx_slide_right" id="<? echo $arItemIDs['SLIDER_RIGHT']; ?>" style="<? echo $strSlideStyle; ?>"></div>
                                    </div>
                                </div>
                                <?
                            } else {
                                foreach ($arResult['OFFERS'] as $key => $arOneOffer) {
                                    if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT']) {
                                        continue;
                                    }
                                    $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
                                    if (5 < $arOneOffer['MORE_PHOTO_COUNT']) {
                                        $strClass      = 'bx_slider_conteiner full';
                                        $strOneWidth   = (100 / $arOneOffer['MORE_PHOTO_COUNT']) . '%';
                                        $strWidth      = (20 * $arOneOffer['MORE_PHOTO_COUNT']) . '%';
                                        $strSlideStyle = '';
                                    } else {
                                        $strClass      = 'bx_slider_conteiner';
                                        $strOneWidth   = '20%';
                                        $strWidth      = '100%';
                                        $strSlideStyle = 'display: none;';
                                    }
                                    ?>
                                    <div class="<? echo $strClass; ?>"
                                         id="<? echo $arItemIDs['SLIDER_CONT_OF_ID'] . $arOneOffer['ID']; ?>"
                                         style="display: <? echo $strVisible; ?>;">
                                        <div class="bx_slider_scroller_container">
                                            <div class="bx_slide">
                                                <ul style="width: <? echo $strWidth; ?>;" id="<? echo $arItemIDs['SLIDER_LIST_OF_ID'] . $arOneOffer['ID']; ?>">
                                                    <?
                                                    foreach ($arOneOffer['MORE_PHOTO'] as &$arOnePhoto) {
                                                        ?>
                                                        <li data-value="<? echo $arOneOffer['ID'] . '_' . $arOnePhoto['ID']; ?>"
                                                            style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>"><span class="cnt"><span class="cnt_item"
                                                                                                                                                                   style="background-image:url('<? echo $arOnePhoto['SRC']; ?>');"></span></span>
                                                        </li>
                                                        <?
                                                    }
                                                    unset($arOnePhoto);
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="bx_slide_left"
                                                 id="<? echo $arItemIDs['SLIDER_LEFT_OF_ID'] . $arOneOffer['ID'] ?>"
                                                 style="<? echo $strSlideStyle; ?>"
                                                 data-value="<? echo $arOneOffer['ID']; ?>"></div>
                                            <div class="bx_slide_right"
                                                 id="<? echo $arItemIDs['SLIDER_RIGHT_OF_ID'] . $arOneOffer['ID'] ?>"
                                                 style="<? echo $strSlideStyle; ?>"
                                                 data-value="<? echo $arOneOffer['ID']; ?>"></div>
                                        </div>
                                    </div>
                                    <?
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="bx_rt">
                    <?
                    $useBrands     = ('Y' == $arParams['BRAND_USE']);
                    $useVoteRating = ('Y' == $arParams['USE_VOTE_RATING']);
                    if ($useBrands || $useVoteRating) {
                        ?>
                        <div class="bx_optionblock">
                            <?
                            if ($useVoteRating) {
                                ?><?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:iblock.vote",
                                    "stars",
                                    [
                                        "IBLOCK_TYPE"       => $arParams['IBLOCK_TYPE'],
                                        "IBLOCK_ID"         => $arParams['IBLOCK_ID'],
                                        "ELEMENT_ID"        => $arResult['ID'],
                                        "ELEMENT_CODE"      => "",
                                        "MAX_VOTE"          => "5",
                                        "VOTE_NAMES"        => ["1", "2", "3", "4", "5"],
                                        "SET_STATUS_404"    => "N",
                                        "DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
                                        "CACHE_TYPE"        => $arParams['CACHE_TYPE'],
                                        "CACHE_TIME"        => $arParams['CACHE_TIME'],
                                    ],
                                    $component,
                                    ["HIDE_ICONS" => "Y"]
                                ); ?><?
                            }
                            if ($useBrands) {
                                ?><?
                                $APPLICATION->IncludeComponent("bitrix:catalog.brandblock", ".default", [
                                    "IBLOCK_TYPE"  => $arParams['IBLOCK_TYPE'],
                                    "IBLOCK_ID"    => $arParams['IBLOCK_ID'],
                                    "ELEMENT_ID"   => $arResult['ID'],
                                    "ELEMENT_CODE" => "",
                                    "PROP_CODE"    => $arParams['BRAND_PROP_CODE'],
                                    "CACHE_TYPE"   => $arParams['CACHE_TYPE'],
                                    "CACHE_TIME"   => $arParams['CACHE_TIME'],
                                    "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
                                    "WIDTH"        => "",
                                    "HEIGHT"       => "",
                                ],
                                    $component,
                                    ["HIDE_ICONS" => "Y"]
                                ); ?><?
                            }
                            ?>
                        </div>
                        <?
                    }
                    unset($useVoteRating, $useBrands);
                    ?>
                    <div class="item_price">
                        <?
                        $minPrice         = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
                        $boolDiscountShow = (0 < $minPrice['DISCOUNT_DIFF']);
                        ?>
                        <div class="item_old_price"
                             id="<? echo $arItemIDs['OLD_PRICE']; ?>"
                             style="display: <? echo($boolDiscountShow ? '' : 'none'); ?>"><? echo($boolDiscountShow ? $minPrice['PRINT_VALUE'] : ''); ?></div>
                        <div class="item_current_price" id="<? echo $arItemIDs['PRICE']; ?>"><? echo $minPrice['PRINT_DISCOUNT_VALUE']; ?></div>
                        <div class="item_economy_price"
                             id="<? echo $arItemIDs['DISCOUNT_PRICE']; ?>"
                             style="display: <? echo($boolDiscountShow ? '' : 'none'); ?>"><? echo($boolDiscountShow ? GetMessage('CT_BCE_CATALOG_ECONOMY_INFO', ['#ECONOMY#' => $minPrice['PRINT_DISCOUNT_DIFF']]) : ''); ?></div>
                    </div>
                    <?
                    unset($minPrice);
                    if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                        ?>
                        <div class="item_info_section">
                            <?
                            if (!empty($arResult['DISPLAY_PROPERTIES'])) {
                                ?>
                                <dl>
                                    <?
                                    foreach ($arResult['DISPLAY_PROPERTIES'] as &$arOneProp) {
                                        ?>
                                        <dt><? echo $arOneProp['NAME']; ?></dt>
                                        <dd><?
                                        echo(
                                        is_array($arOneProp['DISPLAY_VALUE'])
                                            ? implode(' / ', $arOneProp['DISPLAY_VALUE'])
                                            : $arOneProp['DISPLAY_VALUE']
                                        ); ?></dd><?
                                    }
                                    unset($arOneProp);
                                    ?>
                                </dl>
                                <?
                            }
                            if ($arResult['SHOW_OFFERS_PROPS']) {
                                ?>
                                <dl id="<? echo $arItemIDs['DISPLAY_PROP_DIV'] ?>" style="display: none;"></dl>
                                <?
                            }
                            ?>
                        </div>
                        <?
                    }
                    if ('' != $arResult['PREVIEW_TEXT']) {
                        if (
                            'S' == $arParams['DISPLAY_PREVIEW_TEXT_MODE']
                            || ('E' == $arParams['DISPLAY_PREVIEW_TEXT_MODE'] && '' == $arResult['DETAIL_TEXT'])
                        ) {
                            ?>
                            <div class="item_info_section">
                                <?
                                echo('html' == $arResult['PREVIEW_TEXT_TYPE'] ? $arResult['PREVIEW_TEXT'] : '<p>' . $arResult['PREVIEW_TEXT'] . '</p>');
                                ?>
                            </div>
                            <?
                        }
                    }
                    if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP'])) {
                        $arSkuProps = [];
                        ?>
                        <div class="item_info_section" style="padding-right:150px;" id="<? echo $arItemIDs['PROP_DIV']; ?>">
                            <?
                            foreach ($arResult['SKU_PROPS'] as &$arProp) {
                                if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']])) {
                                    continue;
                                }
                                $arSkuProps[] = [
                                    'ID'           => $arProp['ID'],
                                    'SHOW_MODE'    => $arProp['SHOW_MODE'],
                                    'VALUES_COUNT' => $arProp['VALUES_COUNT'],
                                ];
                                if ('TEXT' == $arProp['SHOW_MODE']) {
                                    if (5 < $arProp['VALUES_COUNT']) {
                                        $strClass      = 'bx_item_detail_size full';
                                        $strOneWidth   = (100 / $arProp['VALUES_COUNT']) . '%';
                                        $strWidth      = (20 * $arProp['VALUES_COUNT']) . '%';
                                        $strSlideStyle = '';
                                    } else {
                                        $strClass      = 'bx_item_detail_size';
                                        $strOneWidth   = '20%';
                                        $strWidth      = '100%';
                                        $strSlideStyle = 'display: none;';
                                    }
                                    ?>
                                    <div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_cont">
                                        <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
                                        <div class="bx_size_scroller_container">
                                            <div class="bx_size">
                                                <ul id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
                                                    <?
                                                    foreach ($arProp['VALUES'] as $arOneValue) {
                                                        $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                                        ?>
                                                        <li data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID']; ?>"
                                                            data-onevalue="<? echo $arOneValue['ID']; ?>"
                                                            style="width: <? echo $strOneWidth; ?>; display: none;">
                                                            <i title="<? echo $arOneValue['NAME']; ?>"></i><span class="cnt"
                                                                                                                 title="<? echo $arOneValue['NAME']; ?>"><? echo $arOneValue['NAME']; ?></span>
                                                        </li>
                                                        <?
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="bx_slide_left"
                                                 style="<? echo $strSlideStyle; ?>"
                                                 id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_left"
                                                 data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                            <div class="bx_slide_right"
                                                 style="<? echo $strSlideStyle; ?>"
                                                 id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_right"
                                                 data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                        </div>
                                    </div>
                                    <?
                                } elseif ('PICT' == $arProp['SHOW_MODE']) {
                                    if (5 < $arProp['VALUES_COUNT']) {
                                        $strClass      = 'bx_item_detail_scu full';
                                        $strOneWidth   = (100 / $arProp['VALUES_COUNT']) . '%';
                                        $strWidth      = (20 * $arProp['VALUES_COUNT']) . '%';
                                        $strSlideStyle = '';
                                    } else {
                                        $strClass      = 'bx_item_detail_scu';
                                        $strOneWidth   = '20%';
                                        $strWidth      = '100%';
                                        $strSlideStyle = 'display: none;';
                                    }
                                    ?>
                                    <div class="<? echo $strClass; ?>" id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_cont">
                                        <span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
                                        <div class="bx_scu_scroller_container">
                                            <div class="bx_scu">
                                                <ul id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;margin-left:0%;">
                                                    <?
                                                    foreach ($arProp['VALUES'] as $arOneValue) {
                                                        $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                                        ?>
                                                        <li data-treevalue="<? echo $arProp['ID'] . '_' . $arOneValue['ID'] ?>"
                                                            data-onevalue="<? echo $arOneValue['ID']; ?>"
                                                            style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>; display: none;">
                                                            <i title="<? echo $arOneValue['NAME']; ?>"></i>
                                                            <span class="cnt"><span class="cnt_item"
                                                                                    style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
                                                                                    title="<? echo $arOneValue['NAME']; ?>"></span></span></li>
                                                        <?
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="bx_slide_left"
                                                 style="<? echo $strSlideStyle; ?>"
                                                 id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_left"
                                                 data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                            <div class="bx_slide_right"
                                                 style="<? echo $strSlideStyle; ?>"
                                                 id="<? echo $arItemIDs['PROP'] . $arProp['ID']; ?>_right"
                                                 data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                        </div>
                                    </div>
                                    <?
                                }
                            }
                            unset($arProp);
                            ?>
                        </div>
                        <?
                    }
                    ?>
                    <div class="item_info_section">
                        <?
                        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                            $canBuy = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'];
                        } else {
                            $canBuy = $arResult['CAN_BUY'];
                        }
                        $buyBtnMessage         = ($arParams['MESS_BTN_BUY'] != '' ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCE_CATALOG_BUY'));
                        $addToBasketBtnMessage = ($arParams['MESS_BTN_ADD_TO_BASKET'] != '' ? $arParams['MESS_BTN_ADD_TO_BASKET'] : GetMessage('CT_BCE_CATALOG_ADD'));
                        $notAvailableMessage   = ($arParams['MESS_NOT_AVAILABLE'] != '' ? $arParams['MESS_NOT_AVAILABLE'] : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE'));
                        $showBuyBtn            = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
                        $showAddBtn            = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);

                        $showSubscribeBtn  = false;
                        $compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCE_CATALOG_COMPARE'));

                        if ($arParams['USE_PRODUCT_QUANTITY'] == 'Y') {
                            if ($arParams['SHOW_BASIS_PRICE'] == 'Y') {
                                $basisPriceInfo = [
                                    '#PRICE#'   => $arResult['MIN_BASIS_PRICE']['PRINT_DISCOUNT_VALUE'],
                                    '#MEASURE#' => (isset($arResult['CATALOG_MEASURE_NAME']) ? $arResult['CATALOG_MEASURE_NAME'] : ''),
                                ];
                                ?>
                                <p id="<? echo $arItemIDs['BASIS_PRICE']; ?>"
                                   class="item_section_name_gray"><? echo GetMessage('CT_BCE_CATALOG_MESS_BASIS_PRICE', $basisPriceInfo); ?></p>
                                <?
                            }
                            ?>
                            <span class="item_section_name_gray"><? echo GetMessage('CATALOG_QUANTITY'); ?></span>
                            <div class="item_buttons vam">
		<span class="item_buttons_counter_block">
			<a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</a>
			<input id="<? echo $arItemIDs['QUANTITY']; ?>" type="text" class="tac transparent_input" value="<? echo(isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])
                ? 1
                : $arResult['CATALOG_MEASURE_RATIO']
            ); ?>">
			<a href="javascript:void(0)" class="bx_bt_button_type_2 bx_small bx_fwb" id="<? echo $arItemIDs['QUANTITY_UP']; ?>">+</a>
			<span class="bx_cnt_desc"
                  id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"><? echo(isset($arResult['CATALOG_MEASURE_NAME']) ? $arResult['CATALOG_MEASURE_NAME'] : ''); ?></span>
		</span>
                                <span class="item_buttons_counter_block" id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" style="display: <? echo($canBuy ? '' : 'none'); ?>;">
<?
if ($showBuyBtn) {
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><span></span><? echo $buyBtnMessage; ?></a>
    <?
}
if ($showAddBtn) {
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['ADD_BASKET_LINK']; ?>"><span></span><? echo $addToBasketBtnMessage; ?></a>
    <?
}
?>
		</span>
                                <span id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>"
                                      class="bx_notavailable"
                                      style="display: <? echo(!$canBuy ? '' : 'none'); ?>;"><? echo $notAvailableMessage; ?></span>
                                <?
                                if ($arParams['DISPLAY_COMPARE'] || $showSubscribeBtn) {
                                    ?>
                                    <span class="item_buttons_counter_block">
<?
if ($arParams['DISPLAY_COMPARE']) {
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button_type_2 bx_cart" id="<? echo $arItemIDs['COMPARE_LINK']; ?>"><? echo $compareBtnMessage; ?></a>
    <?
}
if ($showSubscribeBtn) {

}
?>
		</span>
                                    <?
                                }
                                ?>
                            </div>
                            <?
                            if ('Y' == $arParams['SHOW_MAX_QUANTITY']) {
                                if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                                    ?>
                                    <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>" style="display: none;"><? echo GetMessage('OSTATOK'); ?>: <span></span></p>
                                    <?
                                } else {
                                    if ('Y' == $arResult['CATALOG_QUANTITY_TRACE'] && 'N' == $arResult['CATALOG_CAN_BUY_ZERO']) {
                                        ?>
                                        <p id="<? echo $arItemIDs['QUANTITY_LIMIT']; ?>"><? echo GetMessage('OSTATOK'); ?>: <span><? echo $arResult['CATALOG_QUANTITY']; ?></span>
                                        </p>
                                        <?
                                    }
                                }
                            }
                        } else {
                            ?>
                            <div class="item_buttons vam">
		<span class="item_buttons_counter_block" id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" style="display: <? echo($canBuy ? '' : 'none'); ?>;">
<?
if ($showBuyBtn) {
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['BUY_LINK']; ?>"><span></span><? echo $buyBtnMessage; ?></a>
    <?
}
if ($showAddBtn) {
    ?>
    <a href="javascript:void(0);" class="bx_big bx_bt_button bx_cart" id="<? echo $arItemIDs['ADD_BASKET_LINK']; ?>"><span></span><? echo $addToBasketBtnMessage; ?></a>
    <?
}
?>
		</span>
                                <span id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>"
                                      class="bx_notavailable"
                                      style="display: <? echo(!$canBuy ? '' : 'none'); ?>;"><? echo $notAvailableMessage; ?></span>
                                <?
                                if ($arParams['DISPLAY_COMPARE'] || $showSubscribeBtn) {
                                    ?>
                                    <span class="item_buttons_counter_block">
	<?
    if ($arParams['DISPLAY_COMPARE']) {
        ?>
        <a href="javascript:void(0);" class="bx_big bx_bt_button_type_2 bx_cart" id="<? echo $arItemIDs['COMPARE_LINK']; ?>"><? echo $compareBtnMessage; ?></a>
        <?
    }
    if ($showSubscribeBtn) {

    }
    ?>
		</span>
                                    <?
                                }
                                ?>
                            </div>
                            <?
                        }
                        unset($showAddBtn, $showBuyBtn);
                        ?>
                    </div>
                    <div class="clb"></div>
                </div>

                <div class="bx_md">
                    <div class="item_info_section">
                        <?
                        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                            if ($arResult['OFFER_GROUP']) {
                                foreach ($arResult['OFFER_GROUP_VALUES'] as $offerID) {
                                    ?>
                                    <span id="<? echo $arItemIDs['OFFER_GROUP'] . $offerID; ?>" style="display: none;">
<?
$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
    ".default",
    [
        "IBLOCK_ID"              => $arResult["OFFERS_IBLOCK"],
        "ELEMENT_ID"             => $offerID,
        "PRICE_CODE"             => $arParams["PRICE_CODE"],
        "BASKET_URL"             => $arParams["BASKET_URL"],
        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
        "CACHE_TYPE"             => $arParams["CACHE_TYPE"],
        "CACHE_TIME"             => $arParams["CACHE_TIME"],
        "CACHE_GROUPS"           => $arParams["CACHE_GROUPS"],
        "TEMPLATE_THEME"         => $arParams['~TEMPLATE_THEME'],
        "CONVERT_CURRENCY"       => $arParams['CONVERT_CURRENCY'],
        "CURRENCY_ID"            => $arParams["CURRENCY_ID"],
    ],
    $component,
    ["HIDE_ICONS" => "Y"]
); ?><?
?>
	</span>
                                    <?
                                }
                            }
                        } else {
                            if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP']) {
                                ?><?
                                $APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
                                    ".default",
                                    [
                                        "IBLOCK_ID"        => $arParams["IBLOCK_ID"],
                                        "ELEMENT_ID"       => $arResult["ID"],
                                        "PRICE_CODE"       => $arParams["PRICE_CODE"],
                                        "BASKET_URL"       => $arParams["BASKET_URL"],
                                        "CACHE_TYPE"       => $arParams["CACHE_TYPE"],
                                        "CACHE_TIME"       => $arParams["CACHE_TIME"],
                                        "CACHE_GROUPS"     => $arParams["CACHE_GROUPS"],
                                        "TEMPLATE_THEME"   => $arParams['~TEMPLATE_THEME'],
                                        "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                                        "CURRENCY_ID"      => $arParams["CURRENCY_ID"],
                                    ],
                                    $component,
                                    ["HIDE_ICONS" => "Y"]
                                ); ?><?
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="bx_rb">
                    <div class="item_info_section">
                        <?
                        if ('' != $arResult['DETAIL_TEXT']) {
                            ?>
                            <div class="bx_item_description">
                                <div class="bx_item_section_name_gray" style="border-bottom: 1px solid #f2f2f2;"><? echo GetMessage('FULL_DESCRIPTION'); ?></div>
                                <?
                                if ('html' == $arResult['DETAIL_TEXT_TYPE']) {
                                    echo $arResult['DETAIL_TEXT'];
                                } else {
                                    ?><p><? echo $arResult['DETAIL_TEXT']; ?></p><?
                                }
                                ?>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                </div>
                <div class="bx_lb">
                    <div class="tac ovh">
                    </div>
                    <div class="tab-section-container">
                        <?
                        if ('Y' == $arParams['USE_COMMENTS']) {
                            ?>
                            <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.comments",
                                "",
                                [
                                    "ELEMENT_ID"       => $arResult['ID'],
                                    "ELEMENT_CODE"     => "",
                                    "IBLOCK_ID"        => $arParams['IBLOCK_ID'],
                                    "SHOW_DEACTIVATED" => $arParams['SHOW_DEACTIVATED'],
                                    "URL_TO_COMMENT"   => "",
                                    "WIDTH"            => "",
                                    "COMMENTS_COUNT"   => "5",
                                    "BLOG_USE"         => $arParams['BLOG_USE'],
                                    "FB_USE"           => $arParams['FB_USE'],
                                    "FB_APP_ID"        => $arParams['FB_APP_ID'],
                                    "VK_USE"           => $arParams['VK_USE'],
                                    "VK_API_ID"        => $arParams['VK_API_ID'],
                                    "CACHE_TYPE"       => $arParams['CACHE_TYPE'],
                                    "CACHE_TIME"       => $arParams['CACHE_TIME'],
                                    'CACHE_GROUPS'     => $arParams['CACHE_GROUPS'],
                                    "BLOG_TITLE"       => "",
                                    "BLOG_URL"         => $arParams['BLOG_URL'],
                                    "PATH_TO_SMILE"    => "",
                                    "EMAIL_NOTIFY"     => $arParams['BLOG_EMAIL_NOTIFY'],
                                    "AJAX_POST"        => "Y",
                                    "SHOW_SPAM"        => "Y",
                                    "SHOW_RATING"      => "N",
                                    "FB_TITLE"         => "",
                                    "FB_USER_ADMIN_ID" => "",
                                    "FB_COLORSCHEME"   => "light",
                                    "FB_ORDER_BY"      => "reverse_time",
                                    "VK_TITLE"         => "",
                                    "TEMPLATE_THEME"   => $arParams['~TEMPLATE_THEME'],
                                ],
                                $component,
                                ["HIDE_ICONS" => "Y"]
                            ); ?>
                            <?
                        }
                        ?>
                    </div>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="clb"></div>
        </div><?
        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
            foreach ($arResult['JS_OFFERS'] as &$arOneJS) {
                if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE']) {
                    $arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT']       = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
                    $arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
                }
                $strProps = '';
                if ($arResult['SHOW_OFFERS_PROPS']) {
                    if (!empty($arOneJS['DISPLAY_PROPERTIES'])) {
                        foreach ($arOneJS['DISPLAY_PROPERTIES'] as $arOneProp) {
                            $strProps .= '<dt>' . $arOneProp['NAME'] . '</dt><dd>' . (
                                is_array($arOneProp['VALUE'])
                                    ? implode(' / ', $arOneProp['VALUE'])
                                    : $arOneProp['VALUE']
                                ) . '</dd>';
                        }
                    }
                }
                $arOneJS['DISPLAY_PROPERTIES'] = $strProps;
            }
            if (isset($arOneJS)) {
                unset($arOneJS);
            }
            $arJSParams = [
                'CONFIG'          => [
                    'USE_CATALOG'           => $arResult['CATALOG'],
                    'SHOW_QUANTITY'         => $arParams['USE_PRODUCT_QUANTITY'],
                    'SHOW_PRICE'            => true,
                    'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
                    'SHOW_OLD_PRICE'        => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
                    'DISPLAY_COMPARE'       => $arParams['DISPLAY_COMPARE'],
                    'SHOW_SKU_PROPS'        => $arResult['SHOW_OFFERS_PROPS'],
                    'OFFER_GROUP'           => $arResult['OFFER_GROUP'],
                    'MAIN_PICTURE_MODE'     => $arParams['DETAIL_PICTURE_MODE'],
                    'SHOW_BASIS_PRICE'      => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
                    'ADD_TO_BASKET_ACTION'  => $arParams['ADD_TO_BASKET_ACTION'],
                    'SHOW_CLOSE_POPUP'      => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
                ],
                'PRODUCT_TYPE'    => $arResult['CATALOG_TYPE'],
                'VISUAL'          => [
                    'ID' => $arItemIDs['ID'],
                ],
                'DEFAULT_PICTURE' => [
                    'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
                    'DETAIL_PICTURE'  => $arResult['DEFAULT_PICTURE'],
                ],
                'PRODUCT'         => [
                    'ID'   => $arResult['ID'],
                    'NAME' => $arResult['~NAME'],
                ],
                'BASKET'          => [
                    'QUANTITY'         => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                    'BASKET_URL'       => $arParams['BASKET_URL'],
                    'SKU_PROPS'        => $arResult['OFFERS_PROP_CODES'],
                    'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                    'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
                ],
                'OFFERS'          => $arResult['JS_OFFERS'],
                'OFFER_SELECTED'  => $arResult['OFFERS_SELECTED'],
                'TREE_PROPS'      => $arSkuProps,
            ];
            if ($arParams['DISPLAY_COMPARE']) {
                $arJSParams['COMPARE'] = [
                    'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
                    'COMPARE_PATH'         => $arParams['COMPARE_PATH'],
                ];
            }
        } else {
            ?>
            <!-- -------------------- -->
            <?
        }
        if ($arResult['MIN_PRICE']['DISCOUNT_VALUE'] != $arResult['MIN_PRICE']['VALUE']) {
            $arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']       = -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
            $arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
        }
        $arJSParams = [
            'CONFIG'       => [
                'USE_CATALOG'           => $arResult['CATALOG'],
                'SHOW_QUANTITY'         => $arParams['USE_PRODUCT_QUANTITY'],
                'SHOW_PRICE'            => (isset($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']) && is_array($arResult['MIN_PRICE'])),
                'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
                'SHOW_OLD_PRICE'        => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
                'DISPLAY_COMPARE'       => $arParams['DISPLAY_COMPARE'],
                'MAIN_PICTURE_MODE'     => $arParams['DETAIL_PICTURE_MODE'],
                'SHOW_BASIS_PRICE'      => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
                'ADD_TO_BASKET_ACTION'  => $arParams['ADD_TO_BASKET_ACTION'],
                'SHOW_CLOSE_POPUP'      => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
            ],
            'VISUAL'       => [
                'ID' => $arItemIDs['ID'],
            ],
            'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
            'PRODUCT'      => [
                'ID'             => $arResult['ID'],
                'PICT'           => $arFirstPhoto,
                'NAME'           => $arResult['~NAME'],
                'SUBSCRIPTION'   => true,
                'PRICE'          => $arResult['MIN_PRICE'],
                'BASIS_PRICE'    => $arResult['MIN_BASIS_PRICE'],
                'SLIDER_COUNT'   => $arResult['MORE_PHOTO_COUNT'],
                'SLIDER'         => $arResult['MORE_PHOTO'],
                'CAN_BUY'        => $arResult['CAN_BUY'],
                'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
                'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
                'MAX_QUANTITY'   => $arResult['CATALOG_QUANTITY'],
                'STEP_QUANTITY'  => $arResult['CATALOG_MEASURE_RATIO'],
            ],
            'BASKET'       => [
                'ADD_PROPS'        => ($arParams['ADD_PROPERTIES_TO_BASKET'] == 'Y'),
                'QUANTITY'         => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                'PROPS'            => $arParams['PRODUCT_PROPS_VARIABLE'],
                'EMPTY_PROPS'      => $emptyProductProperties,
                'BASKET_URL'       => $arParams['BASKET_URL'],
                'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
            ],
        ];
        if ($arParams['DISPLAY_COMPARE']) {
            $arJSParams['COMPARE'] = [
                'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
                'COMPARE_PATH'         => $arParams['COMPARE_PATH'],
            ];
        }
        unset($emptyProductProperties);

        ?>
        <script type="text/javascript">
            var <? echo $strObName; ?> =;
            new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
            BX.message({
                ECONOMY_INFO_MESSAGE:         '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
                BASIS_PRICE_MESSAGE:          '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
                TITLE_ERROR:                  '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
                TITLE_BASKET_PROPS:           '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
                BASKET_UNKNOWN_ERROR:         '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
                BTN_SEND_PROPS:               '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
                BTN_MESSAGE_BASKET_REDIRECT:  '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
                BTN_MESSAGE_CLOSE:            '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
                BTN_MESSAGE_CLOSE_POPUP:      '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
                TITLE_SUCCESSFUL:             '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
                COMPARE_MESSAGE_OK:           '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
                COMPARE_UNKNOWN_ERROR:        '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
                COMPARE_TITLE:                '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
                BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
                SITE_ID:                      '<? echo SITE_ID; ?>'
            });
        </script>
    </div>
    <? $APPLICATION->SetPageProperty("novoe_svoistvo", "2"); ?>

    <div style="height: 45px; width: 100%; clear: both;"></div>

    <? //echo"<pre>";print_r($arResult);echo"</pre>";?>
