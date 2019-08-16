<?
namespace sb;

IncludeModuleLangFile(__FILE__);

class CPresents {
	
	
	const IBLOCK_CODE = 'sebekon_presents';
	const PROVIDER_CLASS = 'SebekonPresentProvider';
	const BASKET_PROP_CODE = 'SEBEKON_PRESENT';
	static $instance;
	private $alreadyUpdated = false;
	private $basket = array();
	private $canDelete = false;
	private $isOrder = false;

    /**
	 * Cтатический метод для получения экземпляра класса
	 *
	 * @return mixed
	 */
	public static function getInstance() {
		if (!static::$instance) {
			static::$instance = new static();
		}

		return static::$instance;
	}

    
    public function d($data, $die = false) {
        return false;

		
		echo '<pre>';
        print_r($data);
        echo '</pre>';
		
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/sebekon_presents.log', var_export($data, true) . "\n", FILE_APPEND);
        if($die) {
            die();
        }
    }
    
	/**
 	 * Declination words
	 *
	 * @param int $number
	 * @param string $nominative
	 * @param string $accusative
	 * @param string $genitive
	 * @return string
	 */
	public function wordDeclension($number, $nominative, $accusative, $genitive) {
		$returnString = NULL;
		$realNumber = $number;
		if($number > 20) {
			$number = $number%10;
		}
		switch($number) {
			case 1: 
			
				$returnString = $nominative;
				break;
				
			case 2:
			case 3:
			case 4:
			
				$returnString = $accusative;
				break;
				
			default:
				$returnString = $genitive;
		}
		
		return self::getTextPrice($realNumber) . ' ' . $returnString;
	}
	
	/**
	 * Get property array code to basket product
	 *
	 * @param int $sum
	 * @return array
	 */
	public function getPresentPropArray($sum) {
		return array(
			'NAME' 	=> GetMessage('PRESENT_PROP_NAME'),
			'CODE' 	=> self::BASKET_PROP_CODE,
			'VALUE' => GetMessage('PRESENT_PROP_VALUE', array('#PRICE#' => self::getTextPrice($sum)))
		);
	}
	
	/**
	 * Get text price
	 *
	 * @param int $price
	 * @return string
	 */
	public function getTextPrice($price) {
		return number_format($price, 0, '.', ' ');
	}
	
	/**
	 * Calculate basket sum
	 * 
	 * @param array $items
	 * @return int
	 */
	public function getBasketSum($items) {
        
        if(!\CModule::IncludeModule('sale')) {
			return;
		}
        
		$allSum = 0;
		$allWeight = 0;
		foreach($items as $item) {
		
			if($item['DELAY'] !== 'N' || $item['CAN_BUY'] !== 'Y') {
				continue;
			}
		
			$allSum += ($item['PRICE'] * $item['QUANTITY']);
            $allWeight += ($item['WEIGHT'] * $item['QUANTITY']);
		}
        
        $arOrder = array(
            'SITE_ID' => SITE_ID,
            'USER_ID' => $GLOBALS["USER"]->GetID(),
            'ORDER_PRICE' => $allSum,
            'ORDER_WEIGHT' => $allWeight,
            'BASKET_ITEMS' => $items
        );

        $arOptions = array();
        $arErrors = array();

        \CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);
        
        $allSum = 0;
        foreach($arOrder['BASKET_ITEMS'] as $basketFields) {
            
            if($basketFields['DELAY'] !== 'N' || $basketFields['CAN_BUY'] !== 'Y') {
				continue;
			}
            
            $allSum += floatval($basketFields["PRICE"]) * $basketFields["QUANTITY"];
        }
		
		return $allSum;
	}
	
	
	/**
	 * Get basket item(s) by current user
	 * 
	 * @param int $id
	 * @return array
	 */
	public function getBasket($id = null, $orderId = null) {
		
		if(!\CModule::IncludeModule('sale')) {
			return;
		}
        
        $id = intval($id);
        $orderId = intval($orderId);
        
        if(empty($id) && $this->basket[$orderId]) {
            //return $this->basket[$orderId];
        }
		
		$arItems = array();
		
		$arSort = array(
			'NAME' 	=> 'ASC',
			'ID' 	=> 'ASC'
		);
		
		$arFilter =  array(
			'FUSER_ID' 	=> \CSaleBasket::GetBasketUserID(),
			'ORDER_ID' 	=> (empty($orderId) ? 'NULL' : $orderId)
		);
		
		if(empty($orderId)) {
			$arFilter['LID'] = SITE_ID;
		}
		
		if(!empty($id)) {
			$arFilter['ID'] = $id;
		}
		
		$arSelect = array(
			'ID', 
			'PRODUCT_PROVIDER_CLASS',
			'PROPS',
			'MODULE', 
            'PRODUCT_ID', 
			'QUANTITY', 
			'DELAY', 
            'CAN_BUY', 
			'PRICE', 
			'WEIGHT',
			'DISCOUNT_VALUE',
			'DISCOUNT_PRICE',
		);
		
		$rsBasketItems = \CSaleBasket::GetList($arSort, $arFilter, false, false, $arSelect);
		while($arItem = $rsBasketItems->Fetch()) {
			$arItems[] = $arItem;
    	}
		
		if(!empty($id) && count($arItems) == 1) {
			$arItems = $arItems[0];
		}
        
        if(empty($id)) {
            $this->basket[$orderId] = $arItems;
        }
		
		return $arItems;
	}
	
	
	/**
	 * Get current or next present for user by sum
	 *
	 * @param int $sum
	 * @param bool $nextPresent - true for next present, false for current
	 * @return array
	 */
	public function getPresent($sum, $nextPresent = false, $siteId = false) {
		
		if(!\CModule::IncludeModule('iblock')) {
			return;
		}
		
		$arFilter = array(
			'CODE' => self::IBLOCK_CODE, 
			'IBLOCK_TYPE_ID' => self::IBLOCK_CODE
		);
		
		if(!$siteId && !strpos($GLOBALS['APPLICATION']->GetCurDir(), 'bitrix/admin')) {
			$siteId = SITE_ID;
		}
		
		$arFilter['SITE_ID'] = $siteId;
		
		
		if(!$arIBlock = \CIBlock::GetList(array('ID'), $arFilter)->Fetch()) {
			return;
		}
		
		$arGroupPropValueIds = array();
		$arUserGroup = $GLOBALS['USER']->GetUserGroupArray();
		$rsPropGroupValues = \CIBlockProperty::GetPropertyEnum('USER_GROUP', array(), array('IBLOCK_ID' => $arIBlock['ID']));
		while($arPropGroupValue = $rsPropGroupValues->fetch()) {
			if(!in_array($arPropGroupValue['XML_ID'], $arUserGroup)) {
				continue;
			}
			$arGroupPropValueIds[] = $arPropGroupValue['ID'];
		}
		
		$arSort = array(
			//'PROPERTY_MIN_SUM' => !$nextPresent ? 'ASC' : 'DESC'
			'PROPERTY_MIN_SUM' 	=> 'ASC',
			'ID' 				=> 'ASC'
		);
		
		$arFilter = array(
			'IBLOCK_ID' 			=> $arIBlock['ID'],
			'ACTIVE' 				=> 'Y',
			'ACTIVE_DATE' 			=> 'Y',
			'!PROPERTY_PRODUCT_ID' 	=> false,		
			($nextPresent ? '>' : '<=') . 'PROPERTY_MIN_SUM' 	=> $sum,
			array(
				'LOGIC' => 'OR',
				array('PROPERTY_USER_GROUP'	=> $arGroupPropValueIds),
				array('PROPERTY_USER_GROUP'	=> false)
			)
			
		);

		$arSelect = array(
			'ID',
			'NAME',
			'DATE_ACTIVE_FROM',
			'DATE_ACTIVE_TO',
			'PREVIEW_TEXT',
			'DETAIL_TEXT',
			'PROPERTY_PRODUCT_ID',
			'PROPERTY_QUANTITY',
			'PROPERTY_MIN_SUM',
			'PROPERTY_COOKIE_PARAM_NAME',
			'PROPERTY_COOKIE_PARAM_VALUE',
			'PROPERTY_ADD_TO_CURRENT_PRESENT',
		);

		$arPresents = array();
		//$emptyPresent = true;
		$rsPresents = \CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
		while($arPresent = $rsPresents->Fetch()) {
			if(!empty($arPresent['PROPERTY_COOKIE_PARAM_NAME_VALUE']) && (!isset($_COOKIE[$arPresent['PROPERTY_COOKIE_PARAM_NAME_VALUE']]) || $_COOKIE[$arPresent['PROPERTY_COOKIE_PARAM_NAME_VALUE']] != $arPresent['PROPERTY_COOKIE_PARAM_VALUE_VALUE'])) {
				continue;
			}
			//$emptyPresent = false;
			//break;
			
			/*
			echo '<pre>';
			print_r($arPresent);
			echo '</pre>';
			*/
			
			if(!$nextPresent && !$arPresent['PROPERTY_ADD_TO_CURRENT_PRESENT_VALUE'] && !isset($arPresents[$arPresent['PROPERTY_MIN_SUM_VALUE']])) {
				$arPresents = array();
			}
			
			if(!isset($arPresents[$arPresent['PROPERTY_MIN_SUM_VALUE']][$arPresent['PROPERTY_PRODUCT_ID_VALUE']])) {
				$arPresents[$arPresent['PROPERTY_MIN_SUM_VALUE']][$arPresent['PROPERTY_PRODUCT_ID_VALUE']] = $arPresent;
			} else {
				$arPresents[$arPresent['PROPERTY_MIN_SUM_VALUE']][$arPresent['PROPERTY_PRODUCT_ID_VALUE']]['PROPERTY_QUANTITY_VALUE'] += $arPresent['PROPERTY_QUANTITY_VALUE'];
			}
		}
		
		if($nextPresent) {
			$sumKeys = array_keys($arPresents);
			$arPresents = array($sumKeys[0] => $arPresents[$sumKeys[0]]);
		}
		
		return $arPresents;
	}
	
	/**
	 * Add present to basket by items
	 * 
	 * @param array $item - basket items
	 * @param string $siteId - site id
	 */
	public function addPresentToBasket($items, $siteId = false, $orderId = null) {
        self::d('addPresentToBasket');
		if(!\CModule::IncludeModule('sale')) {
			return;
		}
		
		if(!\CModule::IncludeModule('iblock')) {
			return;
		}
		
		$sum = $this->getBasketSum($items);
        self::d('sum');
        self::d($sum);
	
		$arPresents = $this->getPresent($sum, false, $siteId);
		
		if(empty($arPresents)) {
			return;
		}
		
		$arFieldsPresents = array();
		
		foreach($arPresents as $price => $presents) {
			foreach($presents as $productId => $arPresent) {
				
				if(empty($arPresent['PROPERTY_PRODUCT_ID_VALUE'])) {
					continue;
				}

				$arProduct = \CIBlockElement::GetList(array('ID' => 'DESC'), array('ID' => $arPresent['PROPERTY_PRODUCT_ID_VALUE']), false, false, array('ID', 'NAME', 'CATALOG_WEIGHT'))->Fetch();
				$arFieldsPresent = array(
					'PRODUCT_ID' 				=> $arPresent['PROPERTY_PRODUCT_ID_VALUE'],
					//'PRODUCT_PRICE_ID' 			=> 0,
					'PRICE' 					=> 0.01,
					'CURRENCY' 					=> 'RUB',
					'WEIGHT' 					=> ($arProduct['CATALOG_WEIGHT'] > 0 ? $arProduct['CATALOG_WEIGHT'] : 0),
					'QUANTITY' 					=> !empty($arPresent['PROPERTY_QUANTITY_VALUE']) ? $arPresent['PROPERTY_QUANTITY_VALUE'] : 1,
					//'AVAILABLE_QUANTITY' 		=> !empty($arPresent['PROPERTY_QUANTITY_VALUE']) ? $arPresent['PROPERTY_QUANTITY_VALUE'] : 1,
					'LID' 						=> $siteId ? $siteId : SITE_ID,
					'DELAY' 					=> 'N',
					'CAN_BUY' 					=> 'Y',
					'NAME' 						=> $arProduct['NAME'],
					'MODULE' 					=> 'catalog',
					//'PRODUCT_PROVIDER_CLASS' 	=> 'CCatalogProductProvider',
					'PRODUCT_PROVIDER_CLASS' 	=> self::PROVIDER_CLASS,
					'NOTES' 					=> $arPresent['NAME'],
					'SORT' 						=> 99999,
					'PROPS' => array(
						self::getPresentPropArray($arPresent['PROPERTY_MIN_SUM_VALUE'])
					),
				);
				
				if(!$siteId || !empty($orderId)) {
					global $APPLICATION;
					
					if(!empty($orderId)) {
						$arFieldsPresent['ORDER_ID'] = $orderId;
					}
					$res = \CSaleBasket::Add($arFieldsPresent);
					
				} else {
                    
					$arFieldsPresent['NEW_PRODUCT'] = 'NEW_PRODUCT';
					$arFieldsPresents[] = $arFieldsPresent;
				}
			}
		}

		return $arFieldsPresents;
		
	}
	
	/**
	 * Recalculate basket
	 *
	 * @param int $id - basket item id
	 * @param array $arFields - more data
	 */
	public function recalculationBasket($id, $arFields = array(), $orderId = null) {
		self::d('recalculationBasket');
        
		$items = $this->getBasket(null, $orderId);	
		
		$itemKey = null;
		$emptyBasket = true;

		foreach($items as $key => $item) {
			
			if($item['PRODUCT_PROVIDER_CLASS'] !== self::PROVIDER_CLASS && $item['CAN_BUY'] == 'Y' && $item['DELAY'] == 'N') {
				$emptyBasket = false;
			}

			if($item['ID'] != $id) {
				continue;
			}
			
			$itemKey = $key;
			//break;
		}
		
		if(
			!$this->alreadyUpdated &&
			(!is_null($itemKey) && $items[$itemKey]['PRODUCT_PROVIDER_CLASS'] !== self::PROVIDER_CLASS || $emptyBasket)
		) {

			$this->alreadyUpdated = true;

			foreach($items as $item) {
				if($item['PRODUCT_PROVIDER_CLASS'] === self::PROVIDER_CLASS) {
					$this->canDelete = true;
					\CSaleBasket::Delete($item['ID']);
					$this->canDelete = false;
				}
			}

			$siteId = false;
			if(!empty($orderId)) {
				$arOrder = \CSaleOrder::getByID($orderId);
				$siteId = $arOrder['LID'];
			}


			$this->addPresentToBasket($items, $siteId, $orderId);

		}

	}
	

	
	/** 
	 * Basket handlers
	 */
	public function OnBasketAddHandler($id, $arFields) {
        self::d('OnBasketAddHandler');
        $sebekonPresents = self::getInstance();
        if(!$sebekonPresents->alreadyUpdated && !$sebekonPresents->isOrder) {
            $sebekonPresents->recalculationBasket($id, $arFields);
        }
		
	}
	
	public function OnBasketUpdateHandler($id, $arFields) {
        self::d('OnBasketUpdateHandler');
		$sebekonPresents = self::getInstance();
        if(!$sebekonPresents->alreadyUpdated && !$sebekonPresents->isOrder) {
            $sebekonPresents->recalculationBasket($id, $arFields);
        }

	}
    
    public function OnBeforeBasketDeleteHandler($id) {
        self::d('OnBeforeBasketDeleteHandler');
        /*$sebekonPresents = self::getInstance();
		$item = $sebekonPresents->getBasket($id);
		if($item['PRODUCT_PROVIDER_CLASS'] === self::PROVIDER_CLASS) { 
			//return false;
		}*/
	}
    
	public function OnBasketDeleteHandler($id) {
        self::d('OnBasketDeleteHandler');
		/*$sebekonPresents = self::getInstance();
        if(!$sebekonPresents->alreadyUpdated && !$sebekonPresents->isOrder) {
            //$sebekonPresents->recalculationBasket($id, $arFields);
        }*/
	}
    

	public function OnBeforeBasketUpdateHandler($id, $arFields) {
        self::d('OnBeforeBasketUpdateHandler');
        $sebekonPresents = self::getInstance();

		if(empty($arFields['ORDER_ID'])) {
			$item = $sebekonPresents->getBasket($id);

			if($item['PRODUCT_PROVIDER_CLASS'] === self::PROVIDER_CLASS) { 
				return false;
			}	
		}
	}
	
	public function OnSaleCalculateOrderShoppingCartHandler($arOrder) {
		self::d('OnSaleCalculateOrderShoppingCartHandler');
		if(strpos($GLOBALS['APPLICATION']->GetCurDir(), 'bitrix/admin')) {
			$sebekonPresents = self::getInstance();
			$sebekonPresents->isOrder = true;
			$currentPresents = array();
			
			foreach($arOrder['BASKET_ITEMS'] as $k => $v) {
				$arOrder['BASKET_ITEMS'][$k]['DELAY'] = 'N';
				$arOrder['BASKET_ITEMS'][$k]['CAN_BUY'] = 'Y';
				
				if($v['PRODUCT_PROVIDER_CLASS'] == self::PROVIDER_CLASS) {
					unset($arOrder['BASKET_ITEMS'][$k]);
				}
			}
			$sebekonPresents = self::getInstance();
			$presents = $sebekonPresents->addPresentToBasket($arOrder['BASKET_ITEMS'], $arOrder['LID']);

			if($presents) {
				$arOrder['BASKET_ITEMS'] = array_merge($arOrder['BASKET_ITEMS'], $presents);
			}
		}
		

	}

	public function OnSaleComponentOrderOneStepPersonTypeHandler(){
		self::d('OnSaleComponentOrderOneStepPersonTypeHandler');
		$sebekonPresents = self::getInstance();
		$sebekonPresents->isOrder = true;
	}

	/* d7 handlers */

	public function OnSaleOrderBeforeSavedHandler($entity, $arValues) {
		self::d('OnSaleOrderBeforeSavedHandler');
		$sebekonPresents = self::getInstance();
		$sebekonPresents->isOrder = true;
	}

	public function OnSaleOrderSavedHandler($entity, $isNew, $isChanged, $arValues) {
		self::d('OnSaleOrderBeforeSavedHandler');
		$sebekonPresents = self::getInstance();
		$sebekonPresents->isOrder = false;
	}



    public function onBeforeBasketTableDeleteHandler($arEvent, $id) {
        self::d('onBeforeBasketTableDeleteHandler');
    }
    
	public function OnBeforeSaleBasketItemSetFieldsHandler($arEvent, $arValues, $arOldValues) {
        self::d('OnBeforeSaleBasketItemSetFieldsHandler');
		//$arItem = $arEvent->getFields();
        
        //$sebekonPresents = self::getInstance();
        //$arBasket = $sebekonPresents->getBasket();
	}
    
    public function OnSaleBasketItemRefreshDataHandler($basketItem, $arValues) {
        self::d('OnSaleBasketItemRefreshDataHandler');
        if(!strpos($GLOBALS['APPLICATION']->GetCurDir(), 'bitrix/admin')) {
			$sebekonPresents = self::getInstance();
            if(!$sebekonPresents->alreadyUpdated && !$sebekonPresents->isOrder) {
                $sebekonPresents->recalculationBasket($basketItem->getFields()->get('ID'), $arValues);
            }
            

        }
	}
    
    public function OnBeforeCollectionDeleteItemHandler($items, $basketItem) {
        self::d('OnBeforeCollectionDeleteItemHandler');
		$sebekonPresents = self::getInstance();
		if(
			$basketItem->getField('MODULE') == 'catalog' &&
			$basketItem->getField('PRODUCT_PROVIDER_CLASS') === self::PROVIDER_CLASS &&
			!$sebekonPresents->canDelete)
		{
			$result = new \Bitrix\Main\Entity\EventResult;
			$result->addError(new \Bitrix\Main\Entity\FieldError(new \Bitrix\Main\Entity\StringField('PRODUCT_PROVIDER_CLASS'), ''));
			return $result;
		}
    }
	
	public function OnSaleBasketSavedHandler($arEvent) {
        self::d('OnSaleBasketSavedHandler');
	}
	
	public function OnSaleBasketItemEntitySavedHandler($arEvent, $arValues) {
        self::d('OnSaleBasketItemEntitySavedHandler');
		//$arItem = $arEvent->getFields();
		/*if(empty($arItem['ORDER_ID']) || strpos($GLOBALS['APPLICATION']->GetCurDir(), 'bitrix/admin')) {
		
			$sebekonPresents = self::getInstance();
            if(!$sebekonPresents->alreadyUpdated) {
				$sebekonPresents->recalculationBasket($arItem['ID'], $arItem, intval($arItem['ORDER_ID']));
			}
		
		}*/
	}

	public function BasketPropertyOnBeforeDeleteHandler($propertyId) {
		self::d('BasketPropertyOnBeforeDeleteHandler');
	}

	public function BasketOnBeforeDeleteHandler($id) {
		self::d('BasketOnBeforeDeleteHandler');

		if(is_array($id)) {
			$id = $id['ID'];
		}

		$sebekonPresents = self::getInstance();
		$arItem = \Bitrix\Sale\Basket::getList(array(
			'filter' => array(
				'=ID' => $id
			),
			'select' => array(
				'ID',
				'PRODUCT_PROVIDER_CLASS',
			)))->fetch();

		if($arItem['PRODUCT_PROVIDER_CLASS'] === self::PROVIDER_CLASS && !$sebekonPresents->canDelete) {
			$result = new \Bitrix\Main\Entity\EventResult;
			$result->addError(new \Bitrix\Main\Entity\FieldError(new \Bitrix\Main\Entity\StringField('PRODUCT_PROVIDER_CLASS'), ''));
			return $result;
		}
	}
	
}
?>