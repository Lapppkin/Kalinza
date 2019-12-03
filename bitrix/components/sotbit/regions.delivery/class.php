<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Sotbit\Regions\Location;
use Bitrix\Sale\Delivery\Services\Table;
Loc::loadMessages(__FILE__);

class SotbitRegionsDeliveryComponent extends \CBitrixComponent
{
    public function onPrepareComponentParams($arParams)
    {
        if(!$arParams['CACHE_TIME']){
            $arParams['CACHE_TIME'] = 36000000;
        }
        if(!$arParams['CACHE_TYPE']){
            $arParams['CACHE_TYPE'] = 'A';
        }
        return $arParams;
    }
    public function executeComponent()
    {
        $moduleIncluded = false;
        try {
            if(!Loader::includeModule('sotbit.regions') ||
                !Loader::includeModule('sale') ||
                !Loader::includeModule('catalog')
            )
            {
                return false;
            }
        } catch (\Bitrix\Main\LoaderException $e) {
        }

        if($this->arParams['AJAX'] == 'Y')
        {
            $this->includeComponentTemplate();
            return false;
        }
        
        if(!$this->arParams['ELEMENT_ID']){
            return false;
        }
            $domain = new Location\Domain();

            if($this->arParams['LOCATION_TO'] > 0)
            {
                $currentCode = $this->arParams['LOCATION_TO'];
                $rs = \Bitrix\Sale\Location\LocationTable::getList(
                    [
                        'filter' => [
                            'TYPE_ID'           => [1, 5],
                            'ID' => $this->arParams['LOCATION_TO'],
                        ],
                        'order'  => [
                            'SORT'      => 'asc',
                            'TYPE_ID'   => 'asc',
                            'NAME.NAME' => 'asc'
                        ],
                        'select' => [
                            'ID',
                            'CODE',
                            'COUNTRY_ID',
                            'TYPE_ID',
                            'NAME.NAME',
                        ],
                    ]
                );
                while($city = $rs->fetch()){
                    $currentCode = $city['CODE'];
                }
            }
            else{
                $currentCode = $domain->getProp('LOCATION')['CODE'];
            }

            if(!$currentCode)
            {
                $name = $domain->getProp('NAME');
                if($name){
                    $rs = \Bitrix\Sale\Location\LocationTable::getList(
                        [
                            'filter' => [
                                'TYPE_ID'           => 5,
                                '=NAME.LANGUAGE_ID' => LANGUAGE_ID,
                                '=NAME.NAME' => $name
                            ],
                            'order'  => [
                                'SORT'      => 'asc',
                                'TYPE_ID'   => 'asc',
                                'NAME.NAME' => 'asc'
                            ],
                            'select' => [
                                'ID',
                                'CODE'
                            ],
                        ]
                    );
                    if($city = $rs->fetch()){
                        $currentCode = $city['CODE'];
                    }
                }
            }
            if(!$currentCode){
                return false;
            }

            //if ($this->startResultCache($this->arParams['CACHE_TIME'], ['ELEMENT_ID' => $this->arParams['ELEMENT_ID'],'CURRENT_CODE' => $currentCode],'/'.SITE_ID.'/sotbit/sotbit.regions'))
            {
                $this->arResult['RAND'] = $this->randString();
                if($this->arParams['AJAX'] != 'Y')
                {
                    $this->arResult['PRODUCT'] = [];
                    $rs = \Bitrix\Catalog\Model\Product::getList(
                        [
                            'filter' => ['ID' => $this->arParams['ELEMENT_ID']],
                            'select' => [
                                'WEIGHT',
                                'WIDTH',
                                'HEIGHT',
                                'LENGTH',
                                'MEASURE'
                            ],
                            'limit'  => 1
                        ]
                    );
                    while ($product = $rs->fetch())
                    {
                        if ($product['MEASURE'] > 0)
                        {
                            $product['MEASURE'] = \CCatalogMeasure::getList([],
                                ['ID' => $product['MEASURE']], false, false, ['*'])
                                ->fetch();
                        }
                        $this->arResult['PRODUCT'] = $product;
                    }


                    $this->arResult['DELIVERY'] = [];
                    $this->setDeliveries($currentCode);
                    $this->arResult['PAYMENT'] = [];
                    $this->setPayments($currentCode);

                    $this->arResult['CURRENT'] = $currentCode;

                    $this->arResult['TITLE_CITIES'] = [];
                    //$favoriteCodes = $this->getFavoriteLocationCodes();

                    $rs = \Bitrix\Sale\Location\LocationTable::getList(
                        [
                            'filter' => [
                                'TYPE_ID'           => [1, 5],
                                'CODE' => $currentCode,
                                '=NAME.LANGUAGE_ID' => LANGUAGE_ID,
                            ],
                            'order'  => [
                                'SORT'      => 'asc',
                                'TYPE_ID'   => 'asc',
                                'NAME.NAME' => 'asc'
                            ],
                            'select' => [
                                'ID',
                                'CODE',
                                'COUNTRY_ID',
                                'TYPE_ID',
                                'NAME.NAME',
                                'PARENT.COUNTRY_ID',
                            ],
                        ]
                    );
                    while ($location = $rs->fetch())
                    {
                        if ($location['CODE'] == $currentCode)
                        {
                            $location['CURRENT'] = 'Y';
                            $this->arResult['USER_REGION_NAME']
                                = $this->arResult['USER_REGION_NAME_LOCATION']
                                = $location['SALE_LOCATION_LOCATION_NAME_NAME'];
                            $fullName
                                = \Bitrix\Sale\Location\Admin\LocationHelper::getLocationStringById(
                                $location['ID'],
                                ['INVERSE' => true]
                            );

                            $pos = strpos($fullName, ',');
                            $this->arResult['USER_REGION_FULL_NAME']
                                = '<span data-entity="item" data-index="'
                                .$location['ID'].'">'.substr($fullName, 0, $pos + 1)
                                .'</span>'.substr($fullName, $pos + 1,
                                    strlen($fullName));
                        }

/*
                        if ($location['TYPE_ID'] == 1) {
                            $this->arResult['REGION_LIST_COUNTRIES'][$location['ID']]
                                = $location;
                            $this->arResult['REGION_LIST_COUNTRIES'][$location['ID']]['CITY']
                                = [];
                        } else {
                            if (isset($this->arResult['REGION_LIST_COUNTRIES'][$location['COUNTRY_ID']]['CITY'])) {
                                if (in_array($location['CODE'], $favoriteCodes)) {
                                    $this->arResult['FAVORITES'][$location['COUNTRY_ID']][]
                                        = $location;
                                }
                                if ($location['SALE_LOCATION_LOCATION_NAME_NAME']
                                    == Loc::getMessage('SOTBIT_REGIONS_MOSCOW')
                                    || $location['SALE_LOCATION_LOCATION_NAME_NAME']
                                    == Loc::getMessage('SOTBIT_REGIONS_SP')
                                ) {
                                    $this->arResult['TITLE_CITIES'][] = $location;
                                }
                                $letter = substr(
                                    $location['SALE_LOCATION_LOCATION_NAME_NAME'],
                                    0,
                                    1
                                );
                                $this->arResult['REGION_LIST_COUNTRIES'][$location['COUNTRY_ID']]['CITY'][$letter][]
                                    = $location;
                            }
                        }*/
                    }
                }
            $this->includeComponentTemplate();
        }
    }

    /**
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     */
    protected function getFavoriteLocationCodes()
    {
        $return = [];
        $rs = \Bitrix\Sale\Location\DefaultSiteTable::getList(
            [
                'select' => ['LOCATION_CODE'],
                'filter' => ['SITE_ID' => SITE_ID]
            ]
        );
        while ($location = $rs->fetch()) {
            $return[$location['LOCATION_CODE']] = $location['LOCATION_CODE'];
        }

        return $return;
    }

    protected function setDeliveries($currentCode){
        $rs = Table::getList(
            [
                'select' => [
                    'ID',
                    'NAME',
                    'DESCRIPTION',
                    'LOGOTIP',
                    'CLASS_NAME',
                    'PARENT_ID'
                ],
                'order' => ['SORT' => 'asc'],
                'filter' => [
                    'ACTIVE'    => 'Y',
                ],
            ]
        );

        $limit = intval($this->arParams["LIMIT"]);
        $arParentNames = array();

        while($delivery = $rs->fetch())
        {
            if($delivery['CLASS_NAME'] == '\Bitrix\Sale\Delivery\Services\EmptyDeliveryService'){
                $arParentNames[$delivery["ID"]] = $delivery["NAME"];
                continue;
            }

            if($delivery['PARENT_ID'] == 0 && $delivery['CLASS_NAME'] != '\Bitrix\Sale\Delivery\Services\Configurable'){
                $arParentNames[$delivery["ID"]] = $delivery["NAME"];
                continue;
            }

            $limit--;
            if($this->arParams["LIMIT"] && $limit < 0)
                break;

            $order = \Bitrix\Sale\Order::create(SITE_ID, null);
            $personTypeId = 1;
            $personType = \Bitrix\Sale\Internals\PersonTypeTable::getList(
                [
                    'filter' => [
                        "ACTIVE" => "Y",
                        "LID"=> SITE_ID
                    ],
                    'limit' => 1
                ])->fetch();
            if($personType > 0){
                $personTypeId = $personType['ID'];
            }

            $currency = \Bitrix\Sale\Internals\SiteCurrencyTable::getSiteCurrency(SITE_ID);
            $order->setPersonTypeId($personTypeId);
            $basket = \Bitrix\Sale\Basket::create(SITE_ID);
            $basketItem = \Bitrix\Sale\BasketItem::create($basket, "catalog", $this->arParams['ELEMENT_ID']);
            $basket->addItem($basketItem);
            $order->setBasket($basket);
            $props = $order->getPropertyCollection();
            if($loc = $props->getDeliveryLocation())
            {
                $loc->setValue($currentCode);
            }
            $shipmentCollection = $order->getShipmentCollection();
            $shipment = $shipmentCollection->createItem();
            $shipment->setField("CURRENCY", $currency);
            $shipmentItemCollection = $shipment->getShipmentItemCollection();
            foreach($order->getBasket() as $item)
            {
                $shipmentItem = $shipmentItemCollection->createItem($item);
                $shipmentItem->setQuantity($item->getQuantity());
            }
            $deliveryObg = \Bitrix\Sale\Delivery\Services\Manager::getObjectById($delivery['ID']);
            if(!$deliveryObg)
            {
                continue;
            }
            $calcResult = $deliveryObg->calculate($shipment);

            if($delivery['LOGOTIP'] > 0){
                $delivery['LOGOTIP'] = CFile::GetByID($delivery['LOGOTIP'])->Fetch();
                $delivery['LOGOTIP']['SRC'] = CFile::GetFileSRC($delivery['LOGOTIP']);
            }

            $price = $calcResult->getPrice();

            $name = isset($arParentNames[$delivery["PARENT_ID"]]) ? $arParentNames[$delivery["PARENT_ID"]] ." (".$delivery['NAME'].")" : $delivery['NAME'];

            $this->arResult['DELIVERY'][] = [
                'ID' => $delivery['ID'],
                'NAME' => $name,
                'DESCRIPTION' => $delivery['DESCRIPTION'],
                'LOGOTIP' => $delivery['LOGOTIP'],
                'PERIOD_FROM' => $calcResult->getPeriodFrom(),
                'PERIOD_TO' => $calcResult->getPeriodTo(),
                'PERIOD_TYPE' => $calcResult->getPeriodType(),
                'TIME' => $calcResult->getPeriodDescription(),
                'PRICE' => $price,
                'PRINT_PRICE' => \CCurrencyLang::CurrencyFormat($price,$currency),
            ];
        }
    }

    protected function setPayments()
    {
        $rs = \Bitrix\Sale\Internals\PaySystemActionTable::getList(
            [
                'filter' => ['ACTIVE' => 'Y','!ACTION_FILE' => 'inner'],
                'select' => ['ID','NAME','LOGOTIP']
            ]
        );
        while($payment = $rs->fetch()){
            if($payment['LOGOTIP'] > 0){
                $payment['LOGOTIP'] = CFile::GetByID($payment['LOGOTIP'])->Fetch();
                $payment['LOGOTIP']['SRC'] = CFile::GetFileSRC($payment['LOGOTIP']);
            }
            $this->arResult['PAYMENT'][] = $payment;
        }
    }
}
?>