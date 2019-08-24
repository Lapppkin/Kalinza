<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "KALINZA.ru - проверь зрение в Краснодаре");
$APPLICATION->SetPageProperty("title", "Бесплатная проверка зрения в Краснодаре");
$APPLICATION->SetTitle("Title");
?><div style="height: 0px; width: 100%; clear: both;">
</div>
<div class="container container-fix">
	<div class="row ddddffff">
		<div class="col-md-8" style="z-index: 999;">
			<h1>Бесплатная проверка зрения</h1>
			<h5>После проверки вам не обязательно ничего покупать. Мы проверим ваше зрение одинаково качественно, вне зависимости, купите вы у нас или нет.</h5>
			<div style="height: 15px; width: 100%; clear: both;">
			</div>
			<form class="rf" action="<?= SITE_DIR . 'include/mail/mail5.php' ?>" method="post">
				<table class="fdgsfg dfdfdfdfdfdf" style="width: 600px;">
				<tbody>
				<tr>
					<td style="vertical-align: top;">
 <label class="id10"><b>Дата</b></label> <br>
					</td>
					<td style="vertical-align: top;">
 <label class="id10"><b>Время</b></label> <br>
					</td>
				</tr>
				<tr>
					<td>
						<select class="seleee" name="day" required="">
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
							<option value="19">19</option>
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
							<option value="31">31</option>
						</select>
						<select class="seleee" name="mes" required="">
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
							<option value="Декабрь">Декабрь</option>
						</select>
						<select class="seleee" name="god" required="">
							<option value="2019">2019</option>
						</select>
					</td>
					<td>
						<select class="seleee" name="time" required="">
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
							<option value="20:00">20:00</option>
						</select>
					</td>
				</tr>
				</tbody>
				</table>
				<div style="height: 15px; width: 100%; clear: both;">
				</div>
				<table class="fdgsfg dfdfdfdfdfdf" style="width: 500px;">
				<tbody>
				<tr>
					<td style="vertical-align: top;">
 <label class="id10"><b>Представьтесь пожалуйста</b></label> <br>
					</td>
				</tr>
				<tr>
					<td>
 <input class="id3" type="text" name="name" style="width: 350px;" placeholder="Имя" required="">
					</td>
				</tr>
				</tbody>
				</table>
				<div style="height: 25px; width: 100%; clear: both;">
				</div>
				<table class="fdgsfg dfdfdfdfdfdf" style="width: 500px;">
				<tbody>
				<tr>
					<td style="vertical-align: top;">
 <label class="id10"><b>Телефон для связи</b></label> <br>
					</td>
				</tr>
				<tr>
					<td>
 <input class="id3" type="text" name="phone" style="width: 350px;" placeholder="Номер, например + 7 987 654-32-10" required="">
					</td>
				</tr>
				<tr>
					<td>
 <label>В ближайшее время с вами свяжется специалист и подтвердит возможность консультации в выбранное вами время</label>
					</td>
				</tr>
				</tbody>
				</table>
				<div style="height: 25px; width: 100%; clear: both;">
				</div>
				<table class="fdgsfg fdfdfdfdfd" style="width: 300px;">
				<tbody>
				<tr style="width: 300px; display: grid;">
					<td style=" vertical-align: top;">
 <label class="id10"><b>Ближайший к вам адрес</b></label> <br>
					</td>
				</tr>
				<tr>
					<td style="padding-right: 100px;">
						 <?
if(CModule::IncludeModule("altasib.geobase")) {
$arData = CAltasibGeoBase::GetDataKladr();

if ($arData['CITY']['NAME']==''){echo '
                                           <!-- <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Красная 176, литер 5" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Красная 176, литер 5</span>
                                            </label>
					
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Атарбекова 1/1, ТЦ «BOSS HOUSE»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Атарбекова 1/1, ТЦ «BOSS HOUSE»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Чекистов 36, ТЦ «5 Звезд»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Чекистов 36, ТЦ «5 Звезд»</span>
                                            </label>
					-->
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Уральская 79/1, ТЦ «АШАН СБС Мегамолл»" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Уральская 79/1, ТЦ «АШАН СБС Мегамолл»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="Тургеневское шоссе 27, ТРЦ «МЕГА АДЫГЕЯ»">
                                                <span class="radio-custom"></span>
                                                <span class="label">Тургеневское шоссе 27, ТРЦ «МЕГА АДЫГЕЯ»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Лизы Чайкиной 2/1, ТЦ «Магнит»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Лизы Чайкиной 2/1, ТЦ «Магнит»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Ейское шоссе 40, ТЦ «Магнит»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Ейское шоссе 40, ТЦ «Магнит»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Западный обход 29, ТЦ «Лента»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Западный обход 29, ТЦ «Лента»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Крылатая 2, ТЦ «Oz Молл»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Крылатая 2, ТЦ «Oz Молл»</span>
                                            </label>
                                            
                                            
                                            
                                            
';}

if ($arData['CITY']['NAME']!='' and $arData['CITY']['NAME']!='Краснодар' and $arData['CITY']['NAME']!='Ижевск' and $arData['CITY']['NAME']!='Новосибирск' and $arData['CITY']['NAME']!='Ставрополь' and $arData['CITY']['NAME']!='Железногорск' and $arData['CITY']['NAME']!='Шахты'){echo '
                                            <!--<label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Красная 176, литер 5" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Красная 176, литер 5</span>
                                            </label>
					
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Атарбекова 1/1, ТЦ «BOSS HOUSE»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Атарбекова 1/1, ТЦ «BOSS HOUSE»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Чекистов 36, ТЦ «5 Звезд»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Чекистов 36, ТЦ «5 Звезд»</span>
                                            </label>
					
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Уральская 79/1, ТЦ «АШАН СБС Мегамолл»" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Уральская 79/1, ТЦ «АШАН СБС Мегамолл»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="Тургеневское шоссе 27, ТРЦ «МЕГА АДЫГЕЯ»">
                                                <span class="radio-custom"></span>
                                                <span class="label">Тургеневское шоссе 27, ТРЦ «МЕГА АДЫГЕЯ»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Лизы Чайкиной 2/1, ТЦ «Магнит»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Лизы Чайкиной 2/1, ТЦ «Магнит»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Ейское шоссе 40, ТЦ «Магнит»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Ейское шоссе 40, ТЦ «Магнит»</span>
                                            </label>-->
';}

if ($arData['CITY']['NAME']=='Краснодар'){echo '
                                            <!--<label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Красная 176, литер 5" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Красная 176, литер 5</span>
                                            </label>
					
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Атарбекова 1/1, ТЦ «BOSS HOUSE»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Атарбекова 1/1, ТЦ «BOSS HOUSE»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Чекистов 36, ТЦ «5 Звезд»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Чекистов 36, ТЦ «5 Звезд»</span>
                                            </label>
					-->
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Уральская 79/1, ТЦ «АШАН СБС Мегамолл»" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Уральская 79/1, ТЦ «АШАН СБС Мегамолл»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="Тургеневское шоссе 27, ТРЦ «МЕГА АДЫГЕЯ»">
                                                <span class="radio-custom"></span>
                                                <span class="label">Тургеневское шоссе 27, ТРЦ «МЕГА АДЫГЕЯ»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Лизы Чайкиной 2/1, ТЦ «Магнит»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Лизы Чайкиной 2/1, ТЦ «Магнит»</span>
                                            </label>

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Ейское шоссе 40, ТЦ «Магнит»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Ейское шоссе 40, ТЦ «Магнит»</span>
                                            </label>
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Западный обход 29, ТЦ «Гипермаркет Лента»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Западный обход 29, ТЦ «Гипермаркет Лента»</span>
                                            </label>
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Крылатая 2, ТЦ «Oz Молл»">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Крылатая 2, ТЦ «Oz Молл»</span>
                                            </label>
 
';}

if ($arData['CITY']['NAME']=='Ижевск'){echo '
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Ленина 136 Мега Ашан" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Ленина 136 Мега Ашан</span>
                                            </label>
';}

if ($arData['CITY']['NAME']=='Новосибирск'){echo '

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Ватутина, 107 «Мега Ашан»" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Ватутина, 107 «Мега Ашан»</span>
                                            </label>
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Эйхе, 2">
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Эйхе, 2</span>
                                            </label>

';}


if ($arData['CITY']['NAME']=='Курск'){echo '

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Энгельса, 115Д, Гипермаркет «Лента»" checked>
                                                <span class="radio-custom"></span> 
                                                <span class="label">ул. Энгельса, 115Д Гипермаркет «Лента»</span>
                                            </label>
                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. 50 лет Октября 98, Гипермаркет «Линия»">
                                                <span class="radio-custom"></span> 
                                                <span class="label">ул. 50 лет Октября 98, Гипермаркет «Линия»</span>
                                            </label>
';}





if ($arData['CITY']['NAME']=='Ставрополь'){echo '

                                            <label style="display: flex;">
                                                <input class="radio" type="radio" name="contact" value="ул. Доватерцев 64 «ТЦ Магнит»" checked>
                                                <span class="radio-custom"></span>
                                                <span class="label">ул. Доватерцев 64 «ТЦ Магнит»</span>
                                            </label>
';}



} ?> <br>
 <b><a href="/nashi-magaziny/">Показать Kalinza</a> в других городах</b>
						<div style="padding-bottom: 20px;">
						</div>
					</td>
					<td>
						<div style="width: 310px;">
							<div class="owl-carousel owl-theme" style="box-shadow: 0px 5px 10px #c3c3c3;border-radius: 15px;">
								<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/6/1.jpeg">
								</div>
								<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/6/2.jpeg">
								</div>
								<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/6/3.jpeg">
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td style="margin:0 auto; text-align: center;">
 <input type="submit" class="btn btn-primary btn-lg" value="Записаться" style="padding: 10px 50px !important;">
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td style="margin:0 auto; text-align: left;">
						 Если Вы пользуетесь контактными линзами, то необходимо снять их за 40 минут до визита, иначе данные проверки будут не точными.
					</td>
					<td>
					</td>
				</tr>
				</tbody>
				</table>
			</form>
		</div>
		<div class="col-md-4" style="z-index: 1;">
			<div class="block_2">
				<p>
					 Нужны очки?
				</p>
				<p>
					 Получи свой сертификат<br>
					 на 500 рублей
				</p>
				<form class="contact-form" method="post" action="<?= SITE_DIR . 'include/mail/mail2.php' ?>">
					<div class="form-group">
 <input type="email" class="form-control" required="" name="email" placeholder="Адрес электронной почты" style="margin:0 auto !important; color:#fff;">
					</div>
					<div class="form-group">
 <input type="submit" class="btn btn-primary btn-send-message btn-md" value="Отправить">
					</div>
				</form>
			</div>
			<div style="height: 15px; width: 100%; clear: both;">
			</div>
			<div class="block_3">
				<h4>Наши специалисты</h4>
				<div class=" ">
 <aside id="colorlib-hero22">
					<div class="flexslider">
						<ul class="slides">
 <a href="/kalinza-v-litsakh/" style="color:#000;text-decoration:none;">
							<li> <img src="<?= SITE_DIR . 'include/images/lica.png' ?>" alt="">
							<div class="overlay">
							</div>
							<div class="container2">
								<div class="row">
									<div class="col-md-8 col-md-offset-2 col-md-pull-2 slider-text">
										<div class="slider-text-inner">
											<h4 style="margin:0px;">Артюхов Сергей</h4>
 <b style="color:#000; font-size:16px; line-height:25px;">Оптометрист</b>
										</div>
									</div>
								</div>
							</div>
 </li>
 </a>
							<!-- <li >
														<img src="<?= SITE_DIR . 'include/images/lica.png' ?>"/>
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
                                                    </li> -->
						</ul>
					</div>
 </aside>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="height: 45px; width: 100%; clear: both;">
</div>
<div class="container container-fix">
	<div class="row">
		<div class=" ">
			<div class="wrap">
				<h2>Может быть интересно</h2>
				 <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"bootstrap_v5",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "BUY",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"COMPONENT_TEMPLATE" => "bootstrap_v5",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBSection\",\"DATA\":{\"logic\":\"Equal\",\"value\":19}}]}",
		"DETAIL_URL" => "/catalog/#SECTION_CODE#/#CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_FIELD2" => "shows",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "asc",
		"ENLARGE_PRODUCT" => "STRICT",
		"ENLARGE_PROP" => "-",
		"FILTER_NAME" => "trendFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_TYPE_ID" => "catalog",
		"INCLUDE_SUBSECTIONS" => "A",
		"LABEL_PROP" => array(),
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => array(0=>"ARTNUMBER",),
		"OFFERS_FIELD_CODE" => array(0=>"NAME",1=>"",),
		"OFFERS_PROPERTY_CODE" => array(0=>"",1=>"",),
		"OFFERS_SORT_FIELD" => "shows",
		"OFFERS_SORT_FIELD2" => "shows",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "asc",
		"OFFER_ADD_PICT_PROP" => "-",
		"OFFER_TREE_PROPS" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "24",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRICE_CODE" => array(0=>"BASE",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_DISPLAY_MODE" => "N",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false},{'VARIANT':'6','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE_MOBILE" => array(),
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/#CODE#/",
		"SECTION_USER_FIELDS" => array(0=>"UF_BACKGROUND_IMAGE",1=>"",),
		"SEF_MODE" => "Y",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?>
			</div>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
