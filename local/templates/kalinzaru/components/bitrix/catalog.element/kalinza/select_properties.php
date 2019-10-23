<?

use core\Helper;

if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
    echo '
        <input name="checkboxbox" type="checkbox" checked id="box-1" class="box" onClick="hideOrShowText()">
        <label for="box-1">одинаковые значения для обоих глаз</label>
    ';
} ?>

<table>
    <? if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
        echo '
            <thead>
                <tr>
                    <th></th>
                    <th>Правый глаз</th>
                    <th id="ifff1" style="opacity: 0.5; cursor: not-allowed;">Левый глаз</th>
                </tr>
            </thead>
    ';
    } ?>

    <tbody>
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

        <div id="<?= $arItemIDs['BASKET_PROP_DIV'] ?>">
        <?
        if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
            foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) { ?>
                <input type="hidden"
                    name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<?= $propID; ?>]"
                    value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                <? if (isset($arResult['PRODUCT_PROPERTIES'][$propID])) {
                    unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                }
            }
        }
        //$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
        //if (!$emptyProductProperties)
        //{
        ?>
        <div>
            <? foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo) { ?>
                <div>
                    <div>
                        <?= $arResult['PROPERTIES'][$propID]['NAME'] ?>
                    </div>
                    <div>
                        <?
                        if (
                            'L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE']
                            && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']
                        ) {
                            foreach ($propInfo['VALUES'] as $valueID => $value) { ?>
                                <label>
                                    <input type="radio"
                                        name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                                        value="<?= $valueID ?>" <?= $valueID == $propInfo['SELECTED'] ? '"checked"' : '' ?>>
                                        <? echo $value; ?>
                                </label>
                                <br>
                            <? }
                        } else {
                            ?><select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"><?
                            foreach ($propInfo['VALUES'] as $valueID => $value) {
                                ?>
                                <option value="<?= $valueID ?>" <?= $valueID == $propInfo['SELECTED'] ? '"selected"' : ''; ?>>
                                <?= $value ?>
                                </option>
                            <? }
                            ?></select><?
                        }
                        ?>
                    </div>
                </div>
            <? } ?>
        </div>
    </div>

    <? if (isset($_POST['nazvanie_knopki'])) {

        if (CModule::IncludeModule("sale")) {
            $productnam = [];
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
        if (!in_array("Подарок", $productnam)) {
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
    ?>

        <form method="post" id="select-properties">
            <input type="hidden" name="ckeeeeee" id="ckeeeeee" value="0">
            <input type="hidden" name="element_id" value="<?= $arResult['ID'] ?>">
            <input type="hidden" name="price" id="price_t" value="<?= $arResult['PRICES']["BASE"]["VALUE"] ?>">
            <input type="hidden" name="ob22" id="ob22" value="<?= $arResult["PROPERTIES"]["ob2"]["VALUE"][0] ?>">

            <? if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                echo '
                    <tr>
                        <td>Базовая кривизна</td>
                        <td><select name="b_k1" class="seleee">';
                $val = count($arResult["PROPERTIES"]["b_k"]["VALUE"]);
                for ($i = 0; $i < $val; $i++) {
                    echo '<option value="' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '</option>';
                }
                echo '
                    </select>
                        </td>
                        <td><select id="ifff2" name="b_k2" class="seleee" style="opacity: 0.5; cursor: not-allowed;" disabled>';
                $val = count($arResult["PROPERTIES"]["b_k"]["VALUE"]);
                for ($i = 0; $i < $val; $i++) {
                    echo '<option value="' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '">' . $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] . '</option>';
                }
                echo '
                    </select></td>
                </tr>';
            } ?>
            <? if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
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
            } ?>
            <? if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
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
            } ?>
            <? if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
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
            } ?>
            <? if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
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
            } ?>
            <? if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
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
            } ?>
            <? if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
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
            } ?>
            <? if (!empty($arResult["PROPERTIES"]["ob2"]["VALUE"])) {
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
            } ?>
            <script>
                $(document).on('change', '#myselect', function () {
                    $('#mydiv').html($(this).val());
                    $('#price_t').val($(this).val());
                    $('#ob22').val($(this).find('option:selected').text());
                });
                // document.getElementById('myselect').addEventListener('change', function() {
                //     var text1                                  = document.getElementById('mydiv');
                //     document.getElementById('mydiv').innerHTML = this.value;
                //     document.getElementById('price_t').value   = this.value;
                //     document.getElementById('ob22').value      = $(this).find('option:selected').text();
                // });
            </script>
            <tr>
                <td>Количество</td>
                <td colspan=2>
                    <span class="quan quan-minus"><?= \core\Helper::renderIcon('minus') ?></span>
                    <input name="kolvo" id="koll" type="text" value="1">
                    <span class="quan quan-plus"><?= \core\Helper::renderIcon('plus') ?></span>
                    &nbsp;уп.
                </td>
            </tr>
        </form>
    </tbody>

</table>

<div class="clearfix"></div>

<script>
    jQuery(function() {
        jQuery('input.box').change(function() {
            if (document.getElementById('box-1').checked) {

                document.getElementById('koll').value = '1';
                document.getElementById('ckeeeeee').value = '0';

                if (document.getElementById('ifff1')) {
                    document.getElementById('ifff1').style.opacity = '0.5';
                    document.getElementById('ifff1').style.cursor  = 'not-allowed';
                    document.getElementById('ifff1').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff2')) {
                    document.getElementById('ifff2').style.opacity = '0.5';
                    document.getElementById('ifff2').style.cursor  = 'not-allowed';
                    document.getElementById('ifff2').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff3')) {
                    document.getElementById('ifff3').style.opacity = '0.5';
                    document.getElementById('ifff3').style.cursor  = 'not-allowed';
                    document.getElementById('ifff3').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff4')) {
                    document.getElementById('ifff4').style.opacity = '0.5';
                    document.getElementById('ifff4').style.cursor  = 'not-allowed';
                    document.getElementById('ifff4').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff5')) {
                    document.getElementById('ifff5').style.opacity = '0.5';
                    document.getElementById('ifff5').style.cursor  = 'not-allowed';
                    document.getElementById('ifff5').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff6')) {
                    document.getElementById('ifff6').style.opacity = '0.5';
                    document.getElementById('ifff6').style.cursor  = 'not-allowed';
                    document.getElementById('ifff6').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff7')) {
                    document.getElementById('ifff7').style.opacity = '0.5';
                    document.getElementById('ifff7').style.cursor  = 'not-allowed';
                    document.getElementById('ifff7').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff8')) {
                    document.getElementById('ifff8').style.opacity = '0.5';
                    document.getElementById('ifff8').style.cursor  = 'not-allowed';
                    document.getElementById('ifff8').setAttribute('disabled', 'disabled');
                }
                if (document.getElementById('ifff9')) {
                    document.getElementById('ifff9').style.opacity = '0.5';
                    document.getElementById('ifff9').style.cursor  = 'not-allowed';
                    document.getElementById('ifff9').setAttribute('disabled', 'disabled');
                }
            } else {

                document.getElementById('koll').value = '2';
                document.getElementById('ckeeeeee').value = '1';

                if (document.getElementById('ifff1')) {
                    document.getElementById('ifff1').style.opacity = '1';
                    document.getElementById('ifff1').style.cursor  = 'pointer';
                    document.getElementById('ifff1').removeAttribute('disabled');
                }
                if (document.getElementById('ifff2')) {
                    document.getElementById('ifff2').style.opacity = '1';
                    document.getElementById('ifff2').style.cursor  = 'pointer';
                    document.getElementById('ifff2').removeAttribute('disabled');
                }
                if (document.getElementById('ifff3')) {
                    document.getElementById('ifff3').style.opacity = '1';
                    document.getElementById('ifff3').style.cursor  = 'pointer';
                    document.getElementById('ifff3').removeAttribute('disabled');
                }
                if (document.getElementById('ifff4')) {
                    document.getElementById('ifff4').style.opacity = '1';
                    document.getElementById('ifff4').style.cursor  = 'pointer';
                    document.getElementById('ifff4').removeAttribute('disabled');
                }
                if (document.getElementById('ifff5')) {
                    document.getElementById('ifff5').style.opacity = '1';
                    document.getElementById('ifff5').style.cursor  = 'pointer';
                    document.getElementById('ifff5').removeAttribute('disabled');
                }
                if (document.getElementById('ifff6')) {
                    document.getElementById('ifff6').style.opacity = '1';
                    document.getElementById('ifff6').style.cursor  = 'pointer';
                    document.getElementById('ifff6').removeAttribute('disabled');
                }
                if (document.getElementById('ifff7')) {
                    document.getElementById('ifff7').style.opacity = '1';
                    document.getElementById('ifff7').style.cursor  = 'pointer';
                    document.getElementById('ifff7').removeAttribute('disabled');
                }
                if (document.getElementById('ifff8')) {
                    document.getElementById('ifff8').style.opacity = '1';
                    document.getElementById('ifff8').style.cursor  = 'pointer';
                    document.getElementById('ifff8').removeAttribute('disabled');
                }
                if (document.getElementById('ifff9')) {
                    document.getElementById('ifff9').style.opacity = '1';
                    document.getElementById('ifff9').style.cursor  = 'pointer';
                    document.getElementById('ifff9').removeAttribute('disabled');
                }
            }

        });
    });
</script>

<?/*
<p>
    <a class="btn btn-primary btn-lg bx_big bx_bt_button bx_cart" href="javascript:void(0);" id="<?= $arItemIDs['BUY_LINK'] ?>">Добавить в корзину</a>
</p>
*/ ?>
