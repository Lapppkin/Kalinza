<?php

use Bitrix\Main\Application;
use core\Helper;

if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])): ?>
    <input name="same_eyes" type="checkbox" id="same-eyes" class="box" checked>
    <label for="same-eyes">одинаковые значения для обоих глаз</label>
<? endif; ?>

<?php

$application = Application::getInstance();
$context = $application->getContext();
$request = $context->getRequest();

session_start();
$_SESSION['arElementResult'] = $arResult;

?>

<form method="post" id="select-properties">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="ckeeeeee" id="ckeeeeee" value="0">
    <input type="hidden" name="element_id" value="<?= $arResult['ID'] ?>">
    <input type="hidden" name="price" id="price_t" value="<?= $arResult['PRICES']["BASE"]["VALUE"] ?>">
    <input type="hidden" name="ob22" id="ob22" value="<?= $arResult["PROPERTIES"]["ob2"]["VALUE"][0] ?>">

    <table class="select-properties-table">

        <? if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) { ?>
            <thead>
                <tr>
                    <th></th>
                    <th>Правый глаз</th>
                    <th id="ifff1" style="opacity: 0.5; cursor: not-allowed;">Левый глаз</th>
                </tr>
            </thead>
        <? } ?>

        <tbody>
            <? /* if ($tralala == '1') { ?>
                <select class="product-item-scu-container">
                    <? foreach ($arResult["OFFERS"] as $arOffer) {
                        foreach ($arOffer["PROPERTIES"] as $arPrice) { ?>
                            <? if ($arPrice["PROPERTY_TYPE"] == "L") { ?>
                                <option value="<? echo $arPrice["ID"]; ?>"><? echo $arPrice["VALUE"]; ?></option>
                            <? }
                        }
                    } ?>
                </select>
            <? } */ ?>

            <div id="<?= $arItemIDs['BASKET_PROP_DIV'] ?>">
                <? if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                    foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) { ?>
                        <input type="hidden"
                            name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                            value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                        <? if (isset($arResult['PRODUCT_PROPERTIES'][$propID])) {
                            unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                        }
                    }
                } ?>
            <div>

            <? foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo) { ?>
                <div>
                    <div><?= $arResult['PROPERTIES'][$propID]['NAME'] ?></div>
                    <div>
                        <? if ('L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']) { ?>
                            <? foreach ($propInfo['VALUES'] as $valueID => $value) { ?>
                                <label>
                                    <input type="radio"
                                        name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]"
                                        value="<?= $valueID ?>" <?= $valueID == $propInfo['SELECTED'] ? '"checked"' : '' ?>>
                                        <?= $value ?>
                                </label>
                            <? }
                        } else { ?>
                            <label for="select-<?= $propID ?>" hidden></label>
                            <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propID ?>]" id="select-<?= $propID ?>">
                            <? foreach ($propInfo['VALUES'] as $valueID => $value) { ?>
                                <option value="<?= $valueID ?>" <?= $valueID == $propInfo['SELECTED'] ? '"selected"' : '' ?>>
                                <?= $value ?>
                                </option>
                            <? } ?>
                            </select>
                        <? } ?>
                    </div>
                </div>
            <? } ?>

            </div>
        </div>

        <? // Базовая кривизна
        if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) { ?>
            <tr>
                <td>Базовая кривизна</td>
                <td>
                    <select name="b_k1">
                        <? $val = count($arResult["PROPERTIES"]["b_k"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <select id="ifff2" name="b_k2" disabled>
                        <? $val = count($arResult["PROPERTIES"]["b_k"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["b_k"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

        <? // Оптическая сила
        if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) { ?>
            <tr>
                <td>Оптическая сила</td>
                <td>
                    <select name="o_s1">
                        <? $val = count($arResult["PROPERTIES"]["o_s"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] ?></option>
                            <? } ?>
                    </select>
                </td>
                <td>
                    <select id="ifff3" name="o_s2" disabled>
                        <? $val = count($arResult["PROPERTIES"]["o_s"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["o_s"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

        <? // Аддидация
        if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) { ?>
            <tr>
                <td>Аддидация</td>
                <td>
                    <select name="a_d1">
                        <? $val = count($arResult["PROPERTIES"]["a_d"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <select id="ifff4" name="a_d2" disabled>
                        <? $val = count($arResult["PROPERTIES"]["a_d"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["a_d"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

        <? // Сфера
        if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) { ?>
            <tr>
                <td>Сфера</td>
                <td>
                    <select name="sf1">
                        <? $val = count($arResult["PROPERTIES"]["sf"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["sf"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["sf"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <select name="sf2" id="ifff5" disabled>
                        <? $val = count($arResult["PROPERTIES"]["sf"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["sf"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["sf"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

        <? // Цилиндр
        if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) { ?>
            <tr>
                <td>Цилиндр</td>
                <td>
                    <select name="ci1">
                        <? $val = count($arResult["PROPERTIES"]["ci"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["ci"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["ci"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <select id="ifff6" name="ci2" disabled>
                        <? $val = count($arResult["PROPERTIES"]["ci"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["ci"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["ci"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

        <? // Ось
        if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) { ?>
            <tr>
                <td>Ось</td>
                <td>
                    <select name="os1">
                        <? $val = count($arResult["PROPERTIES"]["os"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["os"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["os"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <select id="ifff7" name="os2" disabled>
                        <? $val = count($arResult["PROPERTIES"]["os"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["os"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["os"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

        <? // Цвет
        if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) { ?>
            <tr>
                <td>Цвет</td>
                <td>
                    <select name="COLOR1">
                        <? $val = count($arResult["PROPERTIES"]["COLOR"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
                <td>
                    <select name="COLOR2" id="ifff8" disabled>
                        <? $val = count($arResult["PROPERTIES"]["COLOR"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option value="<?= $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["COLOR"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

        <? // Объем
        if (!empty($arResult["PROPERTIES"]["ob2"]["VALUE"])) { ?>
            <tr>
                <td>Объем</td>
                <td>
                    <select name="ob21" id="myselect">
                        <? $val = count($arResult["PROPERTIES"]["ob2"]["VALUE"]);
                        for ($i = 0; $i < $val; $i++) { ?>
                            <option data="<?= $arResult["PROPERTIES"]["ob2"]["VALUE"][$i] ?>" value="<?= $arResult["PROPERTIES"]["cob2"]["VALUE"][$i] ?>">
                                <?= $arResult["PROPERTIES"]["ob2"]["VALUE"][$i] ?>
                            </option>
                        <? } ?>
                    </select>
                </td>
            </tr>
        <? } ?>

            <tr class="select-properties-table--quantity">
                <td>Количество</td>
                <td colspan=2>
                    <div class="quan-wrapper">
                        <span class="quan quan-minus"><?= Helper::renderIcon('minus') ?></span>
                        <input type="text" name="product_quantity"
                            id="product-quantity"
                            <?/*value="<?= empty($arResult["PROPERTIES"]["b_k"]["VALUE"]) ? 1 : 2 ?>">*/?>
                            value="1">
                        <span class="quan quan-plus"><?= Helper::renderIcon('plus') ?></span>
                        &nbsp;уп.
                    </div>
                </td>
            </tr>

        </tbody>
    </table>

</form>

<div class="clearfix"></div>

<script>
    $(document).ready(function () {
        $(document).on('change', 'input.box', function() {

            var props = [
                'ifff1',
                'ifff2',
                'ifff3',
                'ifff4',
                'ifff5',
                'ifff6',
                'ifff7',
                'ifff8',
                'ifff9',
            ];

            if ($('#same-eyes').is(':checked')) {

                $('#product-quantity').val(1);
                $('#ckeeeeee').val(1);

                props.forEach(function (item) {
                    $('#' + item).attr('disabled', true);
                });

            } else {

                $('#product-quantity').val(2);
                $('#ckeeeeee').val(2);

                props.forEach(function (item) {
                    $('#' + item).removeAttr('disabled');
                });

            }
        });
    });
</script>
