<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><br>
 <script>
$(document).ready(function(){
   $('.checkout').click(function(){
      $('.order_makers').slideDown(600);
   });
});
</script> <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket",
	"template1",
	Array(
		"ACTION_VARIABLE" => "basketAction",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ADDITIONAL_PICT_PROP_6" => "-",
		"ADDITIONAL_PICT_PROP_7" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"AUTO_CALCULATION" => "Y",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"COLUMNS_LIST" => array(0=>"NAME",1=>"QUANTITY",2=>"DELETE",3=>"DELAY",4=>"PRICE",5=>"PROPERTY_COLOR",),
		"COLUMNS_LIST_EXT" => array(0=>"PREVIEW_PICTURE",1=>"PROPS",2=>"DELETE",3=>"PROPERTY_MANUFACTURER",4=>"PROPERTY_MATERIAL",5=>"PROPERTY_COLOR",6=>"PROPERTY_Diam",7=>"PROPERTY_b_k",8=>"PROPERTY_o_s",9=>"PROPERTY_a_d",10=>"PROPERTY_sf",11=>"PROPERTY_ci",12=>"PROPERTY_os",),
		"COLUMNS_LIST_MOBILE" => array(),
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "template1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CORRECT_RATIO" => "Y",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"DEFERRED_REFRESH" => "Y",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"DISPLAY_MODE" => "extended",
		"GIFTS_BLOCK_TITLE" => "Ваш подарок",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "3",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "N",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"HIDE_COUPON" => "Y",
		"LABEL_PROP" => array(),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "",
		"OFFERS_PROPS" => "",
		"PATH_TO_ORDER" => "/personal/order/",
		"PRICE_DISPLAY_MODE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FILTER" => "Y",
		"SHOW_RESTORE" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOTAL_BLOCK_DISPLAY" => array(),
		"USE_DYNAMIC_SCROLL" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_GIFTS" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_PRICE_ANIMATION" => "Y"
	)
);?> <?
// Делаем выборку товаров из корзины
$arBasketItems = array();
$dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ),
        false,
        false,
        array("ID", "CALLBACK_FUNC", "MODULE", 
              "PRODUCT_ID", "QUANTITY", "DELAY", 
              "CAN_BUY", "PRICE", "WEIGHT")
    );
while ($arItems = $dbBasketItems->Fetch())
{
   $arBasketItems[] = $arItems;
}
?> <?
$our_tovar = count($arResult["ITEMS"]["AnDelCanBuy"]);
$our_tovar2 = count($arBasketItems);

if($our_tovar2 == 0){
   //Если корзина пустая, не подключать компонент оформления
}else{   //В противном случае выводим компонент


?>&nbsp;<?$APPLICATION->IncludeComponent("bitrix:sale.gift.basket", "vertical", array(
	"COMPONENT_TEMPLATE" => "vertical",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "21",
		"SHOW_FROM_SECTION" => "Y",
		"SECTION_ID" => "21",
		"SECTION_CODE" => "aksessuary",
		"SECTION_ELEMENT_ID" => "577",
		"SECTION_ELEMENT_CODE" => "magnitik",
		"DEPTH" => "1",
		"HIDE_NOT_AVAILABLE" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_NAME" => "Y",
		"SHOW_IMAGE" => "Y",
		"MESS_BTN_BUY" => "Выбрать",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"PAGE_ELEMENT_COUNT" => "5",
		"LINE_ELEMENT_COUNT" => "3",
		"TEMPLATE_THEME" => "site",
		"DETAIL_URL" => "#SITE_DIR#",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BLOCK_TITLE" => "Выберите один из подарков",
		"HIDE_BLOCK_TITLE" => "N",
		"TEXT_LABEL_GIFT" => "Подарок",
		"BASKET_URL" => "/personal/basket.php",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"SHOW_PRODUCTS_2" => "N",
		"PROPERTY_CODE_2" => "",
		"CART_PROPERTIES_2" => "",
		"ADDITIONAL_PICT_PROP_2" => "dopf1",
		"SHOW_PRODUCTS_3" => "N",
		"PROPERTY_CODE_3" => "",
		"CART_PROPERTIES_3" => "",
		"ADDITIONAL_PICT_PROP_3" => "MORE_PHOTO"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?><br>
<div class="order_makers">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"template2", 
	array(
		"ACTION_VARIABLE" => "soa-action",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ADDITIONAL_PICT_PROP_6" => "-",
		"ADDITIONAL_PICT_PROP_7" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"ALLOW_APPEND_ORDER" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "no_scale",
		"BASKET_POSITION" => "after",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "template2",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"DELIVERIES_PER_PAGE" => "10",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "N",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "Y",
		"DISPLAY_IMG_HEIGHT" => "90",
		"DISPLAY_IMG_WIDTH" => "90",
		"MESS_ADDITIONAL_PROPS" => "Дополнительные свойства",
		"MESS_AUTH_BLOCK_NAME" => "Авторизация",
		"MESS_AUTH_REFERENCE_1" => "Символом \"звездочка\" (*) отмечены обязательные для заполнения поля.",
		"MESS_AUTH_REFERENCE_2" => "После регистрации вы получите информационное письмо.",
		"MESS_AUTH_REFERENCE_3" => "Личные сведения, полученные в распоряжение интернет-магазина при регистрации или каким-либо иным образом, не будут без разрешения пользователей передаваться третьим организациям и лицам за исключением ситуаций, когда этого требует закон или судебное решение.",
		"MESS_BACK" => "Назад",
		"MESS_BASKET_BLOCK_NAME" => "Товары в заказе",
		"MESS_BUYER_BLOCK_NAME" => "Покупатель",
		"MESS_COUPON" => "Купон",
		"MESS_DELIVERY_BLOCK_NAME" => "Доставка",
		"MESS_DELIVERY_CALC_ERROR_TEXT" => "Вы можете продолжить оформление заказа, а чуть позже менеджер магазина свяжется с вами и уточнит информацию по доставке.",
		"MESS_DELIVERY_CALC_ERROR_TITLE" => "Не удалось рассчитать стоимость доставки.",
		"MESS_ECONOMY" => "Экономия",
		"MESS_EDIT" => "изменить",
		"MESS_FAIL_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.<br />Обратите внимание на развернутый блок с информацией о заказе. Здесь вы можете внести необходимые изменения или оставить как есть и нажать кнопку \"#ORDER_BUTTON#\".",
		"MESS_FURTHER" => "Далее",
		"MESS_INNER_PS_BALANCE" => "На вашем пользовательском счете:",
		"MESS_NAV_BACK" => "Назад",
		"MESS_NAV_FORWARD" => "Вперед",
		"MESS_NEAREST_PICKUP_LIST" => "Ближайшие пункты:",
		"MESS_ORDER" => "Оформить заказ",
		"MESS_ORDER_DESC" => "Комментарии к заказу:",
		"MESS_PAYMENT_BLOCK_NAME" => "Оплата",
		"MESS_PAY_SYSTEM_PAYABLE_ERROR" => "Вы сможете оплатить заказ после того, как менеджер проверит наличие полного комплекта товаров на складе. Сразу после проверки вы получите письмо с инструкциями по оплате. Оплатить заказ можно будет в персональном разделе сайта.",
		"MESS_PERIOD" => "Срок доставки",
		"MESS_PERSON_TYPE" => "Тип плательщика",
		"MESS_PICKUP_LIST" => "Пункты самовывоза:",
		"MESS_PRICE" => "Стоимость",
		"MESS_PRICE_FREE" => "бесплатно",
		"MESS_REGION_BLOCK_NAME" => "Регион доставки",
		"MESS_REGION_REFERENCE" => "Выберите свой город в списке. Если вы не нашли свой город, выберите \"другое местоположение\", а город впишите в поле \"Город\"",
		"MESS_REGISTRATION_REFERENCE" => "Если вы впервые на сайте, и хотите, чтобы мы вас помнили и все ваши заказы сохранялись, заполните регистрационную форму.",
		"MESS_REG_BLOCK_NAME" => "Регистрация",
		"MESS_SELECT_PICKUP" => "Выбрать",
		"MESS_SELECT_PROFILE" => "Выберите профиль",
		"MESS_SUCCESS_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.<br />Если все заполнено верно, нажмите кнопку \"#ORDER_BUTTON#\".",
		"MESS_USE_COUPON" => "Применить купон",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_PERSONAL" => "/personal/order/",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "10",
		"PICKUPS_PER_PAGE" => "10",
		"PICKUP_MAP_TYPE" => "yandex",
		"PRODUCT_COLUMNS" => "",
		"PRODUCT_COLUMNS_HIDDEN" => array(
		),
		"PRODUCT_COLUMNS_VISIBLE" => array(
		),
		"PROPS_FADE_LIST_1" => array(
		),
		"PROPS_FADE_LIST_2" => "",
		"PROP_1" => "",
		"PROP_2" => "",
		"SEND_NEW_USER_NOTIFY" => "N",
		"SERVICES_IMAGES_SCALING" => "no_scale",
		"SET_TITLE" => "N",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS_BASKET" => "N",
		"SHOW_COUPONS_DELIVERY" => "N",
		"SHOW_COUPONS_PAY_SYSTEM" => "N",
		"SHOW_DELIVERY_INFO_NAME" => "N",
		"SHOW_DELIVERY_LIST_NAMES" => "N",
		"SHOW_DELIVERY_PARENT_NAMES" => "N",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "N",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAYMENT_SERVICES_NAMES" => "N",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "N",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "N",
		"SHOW_PICKUP_MAP" => "N",
		"SHOW_STORES_IMAGES" => "N",
		"SHOW_TOTAL_ORDER_BUTTON" => "Y",
		"SHOW_VAT_PRICE" => "N",
		"SKIP_USELESS_BLOCK" => "Y",
		"SPOT_LOCATION_BY_GEOIP" => "N",
		"TEMPLATE_LOCATION" => ".default",
		"TEMPLATE_THEME" => "site",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "N",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PHONE_NORMALIZATION" => "N",
		"USE_PRELOAD" => "N",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "N"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
</div>
 <?
}
?> <script type="text/javascript">
// Прокручиваем стрницу вверхъ
$(document).ready(function(){
   $('.comtacts_scroll_to_top').click(function() {
      $('html, body').animate({
         scrollTop: $(".fool_head").offset().top
      }, 200);
   });
});
</script><br>
 <br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>