<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Купить контактные и цветные линзы в Краснодаре с доставкой. KALINZA.ru - первый в Краснодаре интернет-магазин цветных и контактных линз.");

 
?>

			<div class="container container-fix">
                    <div class="row">
                        <div class=" ">
                            <aside id="colorlib-hero">
                                <div class="flexslider">
                                    <ul class="slides">
<?


 if(CModule::IncludeModule("iblock"))
    {
        $id_block=11;
        $section_id = 0;
        $items = GetIBlockElementList($id_block, $section_id, Array("SORT"=>"ASC"), 3);
        $items->NavPrint("пользователи");
        while($arItem = $items->GetNext())
        {
			//echo $arItem["ID"]."<br>";
			//echo $arItem["PREVIEW_PICTURE"]."<br>";
			//echo "<pre>";
			//print_r($arItem);
			//echo "</pre>";
			$PREVIEW_TEXT = $arItem["PREVIEW_TEXT"];
			$DETAIL_TEXT = $arItem["DETAIL_TEXT"];
			$URL = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
			if (!empty($URL)){
			echo '
										<li style="background-image: url('.$URL.');">
                                            <div class="overlay"></div>
                                            <div class="container container-fix1">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
                                                        <div class="slider-text-inner">
															<h4 style="display:none;">'.$PREVIEW_TEXT.'</h4>
                                                            <p><a class="btn btn-primary btn-lg" href="'.$DETAIL_TEXT.'" style="z-index: 9999;position: relative;display: block; background: #fff; color: #15a0dc; font-weight: bold;">Купить сейчас</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
			';
			}


        }


    }


?>
<!-- 
										<li style="background-image: url(https://kalinza.ru/2/img/846_final.jpg);">
                                            <div class="overlay"></div>
                                            <div class="container container-fix1">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
                                                        <div class="slider-text-inner">
															<h4 style="display:none;">Купи 2 упаковки любых линз Acuvue<b> и получи подарок!</b></h4>
                                                            <p><a class="btn btn-primary btn-lg" href="/catalog/johnson_johnson/" style="z-index: 9999;position: relative;display: block; background: #fff; color: #15a0dc; font-weight: bold;">Купить сейчас</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
										<li style="background-image: url(/2/images/Bitmap.png);">
                                            <div class="overlay"></div>
                                            <div class="container container-fix1">
                                                <div class="row">
                                                    <div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
                                                        <div class="slider-text-inner">
                                                            <h4>Купи 2 упаковки любых линз Ocuvue <b>и получи еще одну в подарок!</b></h4>
                                                            <p><a class="btn btn-primary btn-lg" href="#">Купить сейчас</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li> -->
                                    </ul>
                                </div>
                            </aside>
                        </div>
                        <div class="block_0">
                            <div class="block_2">
                                <p>Нужны очки?</p>
                                <p>Получи свой сертификат<br>на 500 рублей</p>
								<form class="contact-form" method="post" action="/2/mail2.php">
									<div class="form-group">
										<input type="email" class="form-control" id="name" required name="email" placeholder="Адрес электронной почты" style="margin:0 auto !important; color:#fff;">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" id="btn-submit" class="btn btn-primary btn-send-message btn-md" value="Отправить">
                                    </div>
                                </form>
                            </div>

                            <div style="height: 15px; width: 100%; clear: both;"></div>

                            <div class="block_3">
								<a href="/besplatnaya-proverka-zreniya/" style="color:#000;">
                                <p>Бесплатная<br>проверка зрения</p>
								<img src="/2/images/1/Bitmap3.png" />
								</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="height: 45px; width: 100%; clear: both;"></div>

                <div class="container container-fix">
                    <div class="row">
                        <div class=" ">
                            <div class="wrap">
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"bootstrap_v5", 
	array(
		"IBLOCK_TYPE_ID" => "catalog",
		"IBLOCK_ID" => "2",
		"BASKET_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"COMPONENT_TEMPLATE" => "bootstrap_v5",
		"IBLOCK_TYPE" => "catalog",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_BACKGROUND_IMAGE",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "shows",
		"ELEMENT_SORT_ORDER2" => "asc",
		"FILTER_NAME" => "trendFilter",
		"INCLUDE_SUBSECTIONS" => "A",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "24",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "shows",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "shows",
		"OFFERS_SORT_ORDER2" => "asc",
		"TEMPLATE_THEME" => "",
		"PRODUCT_DISPLAY_MODE" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => array(
		),
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/#CODE#/",
		"DETAIL_URL" => "/catalog/#SECTION_CODE#/#CODE#/",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"OFFERS_CART_PROPERTIES" => array(
			0 => "ARTNUMBER",
		),
		"ADD_TO_BASKET_ACTION" => "BUY",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "Y",
		"COMPATIBLE_MODE" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":126}}]}",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"BACKGROUND_IMAGE" => "-",
		"DISPLAY_COMPARE" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"PROPERTY_CODE_MOBILE" => array(
		),
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"ENLARGE_PROP" => "-",
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"SHOW_MAX_QUANTITY" => "N",
		"RCM_TYPE" => "personal",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"SHOW_FROM_SECTION" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"LAZY_LOAD" => "N",
		"LOAD_ON_SCROLL" => "N",
		"SEF_RULE" => "/",
		"SECTION_CODE_PATH" => ""
	),
	false
);?>


                            </div>
                        </div>
                    </div>
                </div>



                <div style="height: 34px; width: 100%; clear: both;"></div>
                <div class="lica">
                    <div class="container container-fix1">
                        <div class="row">
                            <div class="col-md-4 b1"><a href="/nashi-magaziny/">
								<img src="/2/images/1/nadi.png" /></a>
                            </div>
							<div class="col-md-4 b2"><a href="/kalinza-v-litsakh/">
								<img src="/2/images/1/lica.png" /></a>
                            </div>
							<div class="col-md-4 b3"><a href="/dostavka-i-oplata/">
								<div class="img"><p>Бесплатная доставка от 1300 ₽</p></div></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="height: 10px; width: 100%; clear: both;"></div>

                <div class="otziv">
                    <div class="container container-fix">
                        <div class="row">
                            <aside id="colorlib-hero3">
                                <div class="flexslider">
                                    <ul class="slides">
                                        <li>
                                            <div class="overlay"></div>
                                            <div class="container container-fix1">
                                                <div class="row">
                                                    <div class="col-md-12 col-md-offset-12 col-md-pull-12 slider-text">
														<div class="img">
														<iframe width="100%" height="100%" src="https://www.youtube.com/embed/kdZeppOeQ2Q" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
														</div>
														<div class="slider-text-inner">
                                                            <h4>Самый правдивый отзыв о Калинза<br><br><b>первый отзыв смотри дальше</b></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="overlay"></div>
                                            <div class="container container-fix1">
                                                <div class="row">
                                                    <div class="col-md-12 col-md-offset-12 col-md-pull-12 slider-text">
														<div class="img">
														<iframe width="100%" height="100%" src="https://www.youtube.com/embed/TCIFcWBBOmM?ecver=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
														</div>
                                                        <div class="slider-text-inner">
                                                            <h4>Наши клиенты лучше нас<br> расскажут о своем опыте покупок<br> в Kalinza<br><br><b></b></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="overlay"></div>
                                            <div class="container container-fix1">
                                                <div class="row">
                                                    <div class="col-md-12 col-md-offset-12 col-md-pull-12 slider-text">
														<div class="img">
														<iframe width="100%" height="100%" src="https://www.youtube.com/embed/YBc6mSPycuI?ecver=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
														</div>
                                                        <div class="slider-text-inner">
                                                            <h4>Наши клиенты лучше нас<br> расскажут о своем опыте покупок<br> в Kalinza<br><br><b></b></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>

                <div style="height: 25px; width: 100%; clear: both;"></div>
                <div class="fish">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-md-6 bb1">
                                <h3>7 вещей, которые нужно знать при выборе очков</h3>
                                <p>
									Немного профессиональной терминологии. Главным параметром очковых
									линз является коэффициент преломления (или индекс). Чем выше индекс,
									тем линза тоньше, искривление – меньше...
                                </p>
                                <div style="text-align: left;width: 100px;}">
									<a class="btn btn-primary" href="/7-veshchey-kotorye-nuzhno-znat-pri-vybore-ochkov/">Читать полностью</a>
                                </div>
                            </div>
                            <div class="col-md-6 bb2">
								<img src="/2/images/1/im1.png" />
                            </div>
                        </div>
                    </div>
                </div>


                <div style="height: 5px; width: 100%; clear: both;"></div>
                <div class="fish">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-md-6 bb2">
								<img src="/2/images/1/im2.png" />
                            </div>
                            <div class="col-md-6 bb1">
                                <h3>Что нужно знать о контактных линзах!</h3>
                                <p>
                                    Контактные линзы - это безопасная форма коррекции зрения, относящаяся к средствам ухода за глазами...
                                </p>
                                <div style="text-align: left;width: 100px;}">
                                    <a class="btn btn-primary" href="/chto-nuzhno-znat-o-kontaktnykh-linzakh/">Читать полностью</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div style="height: 25px; width: 100%; clear: both;"></div>
                <div class="fish1">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-md-6 bb2">
								<img src="/2/images/1/im1.png" />
                            </div>
                            <div class="col-md-6 bb1">
                                <h3>7 вещей, которые нужно знать при выборе очков</h3>
                                <p>
									Немного профессиональной терминологии. Главным параметром очковых
									линз является коэффициент преломления (или индекс). Чем выше индекс,
									тем линза тоньше, искривление – меньше...
                                </p>
                                <div style="text-align: left;width: 100px;}">
									<a class="btn btn-primary" href="/7-veshchey-kotorye-nuzhno-znat-pri-vybore-ochkov/">Читать полностью</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="height: 5px; width: 100%; clear: both;"></div>
                <div class="fish1">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-md-6 bb2">
								<img src="/2/images/1/im2.png" />
                            </div>
                            <div class="col-md-6 bb1">
                                <h3>Что нужно знать о контактных линзах!</h3>
                                <p>
                                    Контактные линзы - это безопасная форма коррекции зрения, относящаяся к средствам ухода за глазами...
                                </p>
                                <div style="text-align: left;width: 100px;}">
                                    <a class="btn btn-primary" href="/chto-nuzhno-znat-o-kontaktnykh-linzakh/">Читать полньстью</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>