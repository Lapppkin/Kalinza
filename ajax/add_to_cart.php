<?php

/**
 * Добавление в корзину.
 */

use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

session_start();
$arResult = $_SESSION['arElementResult'];

if (\CModule::IncludeModule('sale') && \CModule::IncludeModule('catalog') && \CModule::IncludeModule('iblock')) {

    $application = Application::getInstance();
    $context = $application->getContext();
    $request = $context->getRequest();

    if ((int) $request->getPost('element_id') > 0 && (int) $request->getPost('product_quantity') > 0) {

        if (\CModule::IncludeModule("sale")) {
            $productnam = [];
            $products_in_cart = \CSaleBasket::GetList([], [
                'FUSER_ID' => \CSaleBasket::GetBasketUserID(),
                'LID' => SITE_ID,
                'ORDER_ID' => null,
            ],
            false,
            false,
            [
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

        // Добавление подарка в корзину
        if (!in_array('Подарок', $productnam)) {
            if (\CModule::IncludeModule('sale')) {
                $arFields = [
                    "PRODUCT_ID"      => 577,
                    "PRICE"           => 0,
                    "CURRENCY"        => "RUB",
                    "QUANTITY"        => 1,
                    "LID"             => SITE_ID,
                    "DELAY"           => "N",
                    "CAN_BUY"         => "Y",
                    "MODULE"          => "catalog",
                    "DETAIL_PAGE_URL" => "/aksessuary/magnitik/",
                    "NAME"            => "Подарок",
                ];
                $arProps = [];
                $arFields['PROPS'] = $arProps;
                \CSaleBasket::Add($arFields);
            }
        }

        if (\CModule::IncludeModule("sale")) {
            $productId = $arResult['ID'];
        }

        $productUrl1 = preg_replace('/\/catalog/', '', $arResult['DETAIL_PAGE_URL']);
        $productUrl = $productUrl1;

        // Выбор параметров для линз обоих глаз
        if ($arResult['SECTION']['PATH'][0]['ID'] != '18') {

            $arFields = [
                "PRODUCT_ID"      => $productId,
                "PRICE"           => $request->getPost('price'),
                "CURRENCY"        => 'RUB',
                "QUANTITY"        => $request->getPost('product_quantity'),
                "DETAIL_PAGE_URL" => $productUrl,
                "LID"             => SITE_ID,
                "DELAY"           => "N",
                "CAN_BUY"         => "Y",
                "MODULE"          => "catalog",
                "CATALOG_XML_ID"  => $arResult["SECTION"]["ID"],
                "NAME"            => $arResult['NAME'],
            ];

            $arProps = [];

            if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                $arProps[] = [
                    'NAME'  => 'Базовая кривизна П',
                    'VALUE' => $request->getPost('b_k1'),
                ];
                $arProps[] = [
                    "NAME"  => "Базовая кривизна Л",
                    "VALUE" => $request->getPost('b_k2'),
                ];
            }
            if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                $arProps[] = [
                    "NAME"  => "Оптическая сила Л",
                    "VALUE" => $request->getPost('o_s1'),
                ];
                $arProps[] = [
                    "NAME"  => "Оптическая сила П",
                    "VALUE" => $request->getPost('o_s2'),
                ];
            }
            if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                $arProps[] = [
                    "NAME"  => "Цвет Л",
                    "VALUE" => $request->getPost('COLOR1'),
                ];
                $arProps[] = [
                    "NAME"  => "Цвет П",
                    "VALUE" => $request->getPost('COLOR2'),
                ];
            }
            if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                $arProps[] = [
                    "NAME"  => "Аддидация Л",
                    "VALUE" => $request->getPost('a_d1'),
                ];
                $arProps[] = [
                    "NAME"  => "Аддидация П",
                    "VALUE" => $request->getPost('a_d2'),
                ];
            }
            if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                $arProps[] = [
                    "NAME"  => "Сфера Л",
                    "VALUE" => $$request->getPost('sf1'),
                ];
                $arProps[] = [
                    "NAME"  => "Сфера П",
                    "VALUE" => $request->getPost('sf2'),
                ];
            }
            if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                $arProps[] = [
                    "NAME"  => "Ось Л",
                    "VALUE" => $request->getPost('os1'),
                ];
                $arProps[] = [
                    "NAME"  => "Ось П",
                    "VALUE" => $request->getPost('os2'),
                ];
            }
            if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                $arProps[] = [
                    "NAME"  => "Цилиндр Л",
                    "VALUE" => $request->getPost('ci1'),
                ];
                $arProps[] = [
                    "NAME"  => "Цилиндр П",
                    "VALUE" => $request->getPost('ci2'),
                ];
            }
            if (!empty($arResult["PROPERTIES"]["ob2"]["VALUE"])) {
                $arProps[] = [
                    "NAME"  => "Объем",
                    "VALUE" => $request->getPost('ob22'),
                ];
            }

            $arFields["PROPS"] = $arProps;
            \CSaleBasket::Add($arFields);

        } else {

            // Выбор параметров для линз одного глаза
            if ($request->getPost('ckeeeeee') == '1') {

                $arFields = [
                    "PRODUCT_ID"      => $productId,
                    "PRICE"           => $request->getPost('price'),
                    "CURRENCY"        => "RUB",
                    "QUANTITY"        => 1,
                    "DETAIL_PAGE_URL" => $productUrl,
                    "LID"             => SITE_ID,
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
                        "VALUE" => $request->getPost('b_k1'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Оптическая сила Л",
                        "VALUE" => $request->getPost('o_s1'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Цвет Л",
                        "VALUE" => $request->getPost('COLOR1'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Аддидация Л",
                        "VALUE" => $request->getPost('a_d1'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Сфера Л",
                        "VALUE" => $request->getPost('sf1'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Ось Л",
                        "VALUE" => $request->getPost('os1'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Цилиндр Л",
                        "VALUE" => $request->getPost('ci1'),
                    ];
                }

                $arFields["PROPS"] = $arProps;
                \CSaleBasket::Add($arFields);

                $arFields = [
                    "PRODUCT_ID"      => $productId . ' 2',
                    "PRICE"           => $_POST['price'],
                    "CURRENCY"        => 'RUB',
                    "QUANTITY"        => '1',
                    "DETAIL_PAGE_URL" => $productUrl,
                    "LID"             => SITE_ID,
                    "DELAY"           => "N",
                    "CAN_BUY"         => "Y",
                    "MODULE"          => "catalog",
                    "CATALOG_XML_ID"  => $arResult['SECTION']['ID'],
                    "NAME"            => $arResult['NAME'] . ' Right',
                ];

                $arProps = [];

                if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Базовая кривизна П",
                        "VALUE" => $request->getPost('b_k2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Оптическая сила П",
                        "VALUE" => $request->getPost('o_s2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Цвет П",
                        "VALUE" => $request->getPost('COLOR2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Аддидация П",
                        "VALUE" => $request->getPost('a_d2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Сфера П",
                        "VALUE" => $request->getPost('sf2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Ось П",
                        "VALUE" => $request->getPost('os2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Цилиндр П",
                        "VALUE" => $request->getPost('ci2'),
                    ];
                }

                $arFields["PROPS"] = $arProps;
                \CSaleBasket::Add($arFields);

            } else {

                $arFields = [
                    "PRODUCT_ID"      => $productId,
                    "PRICE"           => $request->getPost('price'),
                    "CURRENCY"        => 'RUB',
                    "QUANTITY"        => $request->getPost('product_quantity'),
                    "DETAIL_PAGE_URL" => $productUrl,
                    "LID"             => SITE_ID,
                    "DELAY"           => "N",
                    "CAN_BUY"         => "Y",
                    "MODULE"          => "catalog",
                    "CATALOG_XML_ID"  => $arResult['SECTION']['ID'],
                    "NAME"            => $arResult['NAME'],
                ];

                $arProps = [];

                if (!empty($arResult["PROPERTIES"]["b_k"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Базовая кривизна П",
                        "VALUE" => $request->getPost('b_k1'),
                    ];
                    $arProps[] = [
                        "NAME"  => "Базовая кривизна Л",
                        "VALUE" => $request->getPost('b_k2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["o_s"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Оптическая сила Л",
                        "VALUE" => $request->getPost('o_s1'),
                    ];
                    $arProps[] = [
                        "NAME"  => "Оптическая сила П",
                        "VALUE" => $request->getPost('o_s2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["COLOR"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Цвет Л",
                        "VALUE" => $request->getPost('COLOR1'),
                    ];
                    $arProps[] = [
                        "NAME"  => "Цвет П",
                        "VALUE" => $request->getPost('COLOR2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["a_d"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Аддидация Л",
                        "VALUE" => $request->getPost('a_d1'),
                    ];
                    $arProps[] = [
                        "NAME"  => "Аддидация П",
                        "VALUE" => $request->getPost('a_d2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["sf"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Сфера Л",
                        "VALUE" => $request->getPost('sf1'),
                    ];
                    $arProps[] = [
                        "NAME"  => "Сфера П",
                        "VALUE" => $request->getPost('sf2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["os"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Ось Л",
                        "VALUE" => $request->getPost('os1'),
                    ];
                    $arProps[] = [
                        "NAME"  => "Ось П",
                        "VALUE" => $request->getPost('os2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["ci"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Цилиндр Л",
                        "VALUE" => $request->getPost('ci1'),
                    ];
                    $arProps[] = [
                        "NAME"  => "Цилиндр П",
                        "VALUE" => $request->getPost('ci2'),
                    ];
                }
                if (!empty($arResult["PROPERTIES"]["ob2"]["VALUE"])) {
                    $arProps[] = [
                        "NAME"  => "Объем",
                        "VALUE" => $request->getPost('ob22'),
                    ];
                }

                $arFields["PROPS"] = $arProps;
                \CSaleBasket::Add($arFields);

            }

        }

        $arResponse = [
            'product' => [
                'id' => $arResult['ID'],
                'name' => $arResult['NAME'],
                'image' => $arResult['PREVIEW_PICTURE']['SRC'],
                'url' => $arResult['DETAIL_PAGE_URL'],
            ]
        ];

        if (!$arFields) {
            $strError = '';
            if ($ex = $APPLICATION->GetException()) {
                $strError = $ex->GetString();
            }
            $arResponse['error'] = true;
            $arResponse['message'] = $strError;
            echo json_encode($arResponse);
            die();
        } else {
            $arResponse['error'] = false;
            $arResponse['message'] = 'Товар добавлен в корзину.';
            echo json_encode($arResponse);
            die();
        }

    }

}

echo json_encode([
    'error' => true,
    'message' => 'Произошла ошибка сервера. Попробуйте еще раз.',
    'product' => false,
]);
