<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "KALINZA.ru - проверь зрение в Краснодаре");
$APPLICATION->SetPageProperty("keywords", "проверка зрения, бесплатная проверка зрения");
$APPLICATION->SetPageProperty("title", "Бесплатная проверка зрения в Краснодаре");
$APPLICATION->SetTitle("Title");
?>
                <div style="height: 0px; width: 100%; clear: both;"></div>

                <div class="container container-fix">
                    <div class="row ddddffff">
                        <div class="col-md-8">
                                <h1>Бесплатная проверка зрения</h1>

                                <h5>После проверки вам не обязательно ничего покупать. Мы проверим ваше зрение одинаково качественно, вне зависимости, купите вы у нас или нет.</h3>

                                 <div style="height: 15px; width: 100%; clear: both;"></div>
                                <form class="rf" action="/2/mail5.php" method="post">
                                <table class="fdgsfg dfdfdfdfdfdf" style="width: 600px;">
                                    <tr>
                                        <td style="vertical-align: top;">
                                            <label class="id10"><b>Дата</b></label>
                                            <br>
                                        </td>
                                        <td style="vertical-align: top;">
                                            <label class="id10"><b>Время</b></label>
                                            <br>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="seleee" required>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="20">20</option>
                                            <option value="21">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option></select>

                                            <select class="seleee" required>
                                            <option value="Январь">Январь</option>
                                            <option value="Февраль">Февраль</option>
                                            <option value="Март">Март</option>
                                            <option value="Апрель">Апрель</option>
                                            <option value="Май">Май</option>
                                            <option value="Июнь">Июнь</option>
                                            <option value="Июль">Июль</option>
                                            <option value="Август">Август</option>
                                            <option value="Сентябрь">Сентябрь</option>
                                            <option value="Октябрь">Октябрь</option>
                                            <option value="Ноябрь">Ноябрь</option>
                                            <option value="Декабрь">Декабрь</option></select>

                                            <select class="seleee" required>
                                            <option value="2018">2018</option></select>
                                        </td>
                                        <td>
                                            <select class="seleee" required>
                                            <option value="09:00">09:00</option>
                                            <option value="10:00">10:00</option>
                                            <option value="11:00">11:00</option>
											<option value="12:00">12:00</option>
                                            <option value="13:00">13:00</option>
                                            <option value="14:00">14:00</option>
                                            <option value="15:00">15:00</option>
                                            <option value="16:00">16:00</option>
                                            <option value="17:00">17:00</option>
                                            <option value="18:00">18:00</option>
                                            <option value="19:00">19:00</option>
                                            <option value="20:00">20:00</option></select>
                                        </td>
                                    </tr>
                                </table>

                                 <div style="height: 15px; width: 100%; clear: both;"></div>
                                
                                <table class="fdgsfg dfdfdfdfdfdf" style="width: 500px;">
                                        <tr>
                                        <td style="vertical-align: top;">
                                            <label class="id10"><b>Представьтесь пожалуйста</b></label>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="id3" type="text" name="" style="width: 350px;" placeholder="Имя" required>
                                        </td>
                                    </tr>
                                </table>

                                 <div style="height: 25px; width: 100%; clear: both;"></div>
                                
                                <table class="fdgsfg dfdfdfdfdfdf" style="width: 500px;">
                                        <tr>
                                        <td style="vertical-align: top;">
                                            <label class="id10"><b>Телефон для связи</b></label>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="id3" type="text" name="" style="width: 350px;" placeholder="Номер, например + 7 987 654-32-10" required>
                                        </td>
                                    </tr>
                                    <tr><td><label>В ближайшее время с вами свяжется специалист и подтвердит возможность консультации в выбранное вами время</label></td></tr>
                                </table>

                                 <div style="height: 25px; width: 100%; clear: both;"></div>

                                <table class="fdgsfg" style="width: 300px;">
                                    <tr style="width: 300px; display: gridd;">
                                        <td style=" vertical-align: top;">
                                            <label class="id10"><b>Ближайший к вам адрес</b></label>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%; padding-right: 100px;">
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="email" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">галерея «Ашан», СБС Мегамолл</span>
                                            </label>
                                            <div style="padding-bottom: 20px;"></div>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="email">
                                                <span class="radio-custom"></span>
                                                <span class="label">галерея «Ашан», Мега Адыгея</span>
                                            </label>
                                            <br>
                                            <b><a href="/nashi-magaziny/">Показать Kalinza</a> в других городах</b>
                                            <div style="padding-bottom: 20px;"></div>
                                        </td>
                                        <td>
                                            <div style="width: 310px;">
                                            <div class="owl-carousel owl-theme" style="box-shadow: 0px 5px 10px #c3c3c3;border-radius: 15px;">
		<div class="item"><img src="/2/img/kalinza_photo/krd/6/1.jpeg" /></div>
		<div class="item"><img src="/2/img/kalinza_photo/krd/6/2.jpeg" /></div>
		<div class="item"><img src="/2/img/kalinza_photo/krd/6/3.jpeg" /></div>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="margin:0 auto; text-align: center;">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Записаться" style="padding: 10px 50px !important;">
                                        </td><td></td>
                                    </tr>

                                    <tr>
                                        <td style="margin:0 auto; text-align: left;">
                                         <font>Если Вы пользуетесь контактными линзами, то необходимо снять  их за 40 минут до визита, иначе данные проверки будут не точными.</font>
                                        </td><td></td>
                                    </tr>
                                </form>
                                </table>
                        </div>
                        <div class="col-md-4">
                            <div class="block_2">
                                <p>Нужны очки?</p>
                                <p>Получи свой сертификат<br>на 500 рублей</p>
                                <form class="contact-form" method="post" action="/2/mail2.php">
                                    <div class="form-group">
										<input type="email" class="form-control" required name="email" placeholder="Адрес электронной почты" style="margin:0 auto !important; color:#fff;">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-send-message btn-md" value="Отправить">
                                    </div>
                                </form>
                            </div>

                            <div style="height: 15px; width: 100%; clear: both;"></div>

                            <div class="block_3">
                                <h4>Наши специалисты</h4>
                                    <div class=" ">
                                        <aside id="colorlib-hero22">
                                            <div class="flexslider">
                                                <ul class="slides">
                                                    <li >
														<img src="/2/images/1/lica.png"/>
                                                        <div class="overlay"></div>
                                                        <div class="container2">
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
                                                                    <div class="slider-text-inner">
                                                                        <h4 style="margin:0px;">Александр Арутюнян</b></h4>
                                                                        <p style="color:#ccc; font-size:14px;">Оптометрист</a></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li >
														<img src="/2/images/1/lica.png"/>
                                                        <div class="overlay"></div>
                                                        <div class="container2">
                                                            <div class="row">
                                                                <div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
                                                                     <div class="slider-text-inner">
                                                                        <h4 style="margin:0px;">Александр Арутюнян</b></h4>
                                                                        <p style="color:#ccc; font-size:14px;">Оптометрист</a></p>
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
                    </div>
                </div>

                <div style="height: 45px; width: 100%; clear: both;"></div>


        <div class="container container-fix">
                    <div class="row">
                        <div class=" ">
                            <div class="wrap">
                                <h2>Может быть интересно</h2>
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
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":19}}]}",
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
		"SEF_RULE" => "",
		"SECTION_CODE_PATH" => ""
	),
	false
);?>


                            </div>
                        </div>
                    </div>
                </div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>