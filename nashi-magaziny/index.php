<?php

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Наши магазины");

Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
Asset::getInstance()->addJs('https://codd-wd.ru/wp-content/examples/ya-maps/jquery-2.2.0.min.js');
?>
<style>
    #cityShop {
        margin-bottom: 10px;
    }
    #shops {
        height: 50px;
    }
    #shops li {
        cursor: pointer;
    }
    #shops li:hover {
        text-decoration: underline;
    }
    .accordion {}
    .accordion li {
        border-bottom: 1px solid #d9e5e8;
        position: relative;
        cursor: pointer;
        clear: both;
    }
    .accordion li div.main {
        display: none;
    }
    .accordion a.ttt333 {
        width: 100%;
        display: block;
        padding: 20px;
        cursor: pointer;
        user-select: none;
        text-decoration: none;
        color: #333;
    }
    .accordion a {
        cursor: pointer;
    }
    .accordion div.main {
        padding: 0px;
    }
    .accordion a.ttt333:after {
        width: 8px;
        height: 8px;
        border-right: 2px solid #333;
        border-bottom: 2px solid #333;
        position: absolute;
        right: 20px;
        content: " ";
        top: 25px;
        transform: rotate(45deg);
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }
    a.active.ttt333:after {
        transform: rotate(-135deg);
        -webkit-transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
    }
    .ymaps-2-1-68-map {
        height: 100vh !important;
    }
    #map {
        height: 100vh !important;
    }
</style>

<div>
	<div class="container container-fix">
		<div class="row">
			<div class="col-md-6" style="height:100vh; overflow:scroll;">
				<div class="bread">
 <a href="/">Главная</a> &nbsp;&nbsp;&nbsp;&gt;&nbsp;&nbsp;&nbsp; <a href="#">Наши магазины</a>
				</div>
				<h1>Наши магазины</h1>
				<div class="gfgfgfgfg">
					<ul class="accordion">
						<li>
						<a class="ttt333" id="city" data-city-id="0" ><b>Краснодар</b></a>
						<div class="main tryyy" style="height: 100%;">
							 <!-- <div class="dddddd">
                                        <div class="bb1">
                                            <div class="owl-carousel owl-theme">
                                                <div class="item"><img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/mega/1.jpeg"></div>
                                                <div class="item"><img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/mega/2.jpeg"></div>
                                                <div class="item"><img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/mega/3.jpeg"></div>
                                            </div>
                                        </div>
                                        <div class="bb2">
                                            <b>ул. Красная 176, литер 5</b><br><br><br>9:00-18:00<br>+7 (861) 292-16-40<br><br>
                                            <a id="adress" data-city-id="0" data-shop-id="0" href="#map">Показать на карте</a>
                                        </div>
                                    </div> -->
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/mega/3.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/mega/2.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/mega/1.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/mega/4.jpeg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>Тургеневское шоссе 27,<br>
									 ТРЦ «МЕГА АДЫГЕЯ»</b><br>
 <br>
									 10:00-22:00<br>
									 <a href="tel:+79604787180">+7 (960) 478-71-80</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="4" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/chekistov/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/chekistov/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/chekistov/3.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Чекистов 36,<br>
									 ТЦ «5 Звезд»</b><br>
 <br>
									 10:00-21:00<br>
									  <a href="tel:+79530926381">+7 (953) 092-63-81</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="2" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/sbs/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/sbs/2.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Уральская 79/1,<br>
									 ТЦ «АШАН СБС Мегамолл»</b><br>
 <br>
									 10:00-22:00<br>
									 <a href="tel:+79184178806">+7 (918) 417-88-06</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="3" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/atarbekova/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/atarbekova/3.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/atarbekova/4.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Атарбекова 1/1<br>
									 ТЦ «BOSS HOUSE»</b><br>
 <br>
									 10:00-21:00<br>
									<a href="tel:+79530916844">+7 (953) 091-68-44</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="1" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lisa/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lisa/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lisa/3.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Лизы Чайкиной 2/1,<br>
									 ТЦ «Магнит»</b><br>
 <br>
									 09:00-21:00<br>
									 <a href="tel:+79649006774">+7 (964) 900-67-74</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="5" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/eiskoe/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/eiskoe/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/eiskoe/3.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Ейское шоссе 40,<br>
									 ТЦ «Магнит»</b><br>
 <br>
									 09:00-22:00<br>
									 <a href="tel:+79064330829">+7 (906) 433-08-29</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="6" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lenta/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lenta/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lenta/3.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lenta/4.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lenta/5.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/lenta/6.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул.Западный обход 29,<br>
									 ТЦ «Гипермаркет Лента»</b><br>
 <br>
									 09:00-21:00<br>
									 <a href="tel:+79618551315">+7 (961) 855-13-15</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="7" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/ozmall/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/ozmall/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/ozmall/3.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/krd/ozmall/4.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Крылатая 2,<br>
									 ТЦ «Oz Молл»</b><br>
 <br>
									 10:00-22:00<br>
									 <a href="tel:+79182439984">+7 (918) 243-99-84</a><br>
 <br>
 <a id="adress" data-city-id="0" data-shop-id="8" href="#map">Показать на карте</a>
								</div>
							</div>
						</div>
 </li>
						<div style="height: 5px; width: 100%; clear: both;">
						</div>
						<li>
						<a class="ttt333" id="city" data-city-id="1" ><b>Ижевск</b></a>
						<div class="main">
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/izh/1.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/izh/4.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/izh/5.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/izh/7.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/izh/8.jpeg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Ленина, 136</b><br>
									 Ашан<br>
 <br>
									 10:00-22:00<br>
									 +7 (964) 182-10-29<br>
 <br>
 <a id="adress" data-city-id="1" data-shop-id="0" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
						</div>
 </li>
						<div style="height: 5px; width: 100%; clear: both;">
						</div>
						<li>
						<a class="ttt333" id="city" data-city-id="6" ><b>Нижний Новгород</b></a>
						<div class="main">
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nizh_nov/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nizh_nov/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nizh_nov/3.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nizh_nov/4.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nizh_nov/5.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>Кстовский район, с.Федяково</b><br>
 <br>
									 ТЦ «МЕГА»<br>
									 10:00-22:00<br>
									 +7 (920) 013-32-88<br>
 <br>
 <a id="adress" data-city-id="6" data-shop-id="0" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
						</div>
 </li>
						<div style="height: 5px; width: 100%; clear: both;">
						</div>
						<li>
						<a class="ttt333" id="city" data-city-id="7" ><b>Новороссийск</b></a>
						<div class="main">
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/novoros/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/novoros/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/novoros/3.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/novoros/1.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Мира 1</b><br>
 <br>
									 «ТЦ Магнит»<br>
									 09:00-21:00<br>
									 +7 (962) 861-30-27<br>
 <br>
 <a id="adress" data-city-id="7" data-shop-id="0" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
						</div>
 </li>
						<div style="height: 5px; width: 100%; clear: both;">
						</div>
						<li>
						<a class="ttt333" id="city" data-city-id="2" ><b>Новосибирск</b></a>
						<div class="main">
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/1.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/2.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/3.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/4.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/5.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/6.jpeg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Ватутина, 107</b><br>
 <br>
									 «Мега Ашан»<br>
									 10:00-22:00<br>
									 8 (960) 789-21-23<br>
 <br>
 <a id="adress" data-city-id="2" data-shop-id="0" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/eyhe/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/eyhe/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/eyhe/3.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/eyhe/4.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/nsb/eyhe/5.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Эйхе, 2<br>
 </b><br>
 <br>
									 09:00-21:00<br>
									 +7 (953) 884-80-90<br>
 <br>
 <a id="adress" data-city-id="2" data-shop-id="1" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
						</div>
 </li>
						<div style="height: 5px; width: 100%; clear: both;">
						</div>
						<li>
						<a class="ttt333" id="city" data-city-id="3" ><b>Ставрополь</b></a>
						<div class="main">
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/stav/1.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/stav/5.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/stav/6.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/stav/7.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/stav/8.jpeg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/stav/2.jpeg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Доватерцев 64</b><br>
 <br>
									 ТЦ «Магнит»<br>
									 10:00-22:00<br>
									 +7 (928) 339-24-21<br>
 <br>
 <a id="adress" data-city-id="3" data-shop-id="0" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
						</div>
 </li>
						<div style="height: 5px; width: 100%; clear: both;">
						</div>
						<li>
						<a class="ttt333" id="city" data-city-id="5" ><b>Курск</b></a>
						<div class="main">
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/kursk/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/kursk/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/kursk/3.jpg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. Энгельса, 115 Д</b><br>
 <br>
									 «ТЦ Гипермаркет Лента»<br>
									 09:00-21:00<br>
									 +7 (906) 575-72-42<br>
 <br>
 <a id="adress" data-city-id="5" data-shop-id="0" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
							<div class="dddddd">
								<div class="bb1">
									<div class="owl-carousel owl-theme">
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/kursk2/1.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/kursk2/2.jpg">
										</div>
										<div class="item">
 <img src="<?= SITE_DIR . 'include/images/' ?>kalinza_photo/kursk2/3.jpeg">
										</div>
									</div>
								</div>
								<div class="bb2">
 <b>ул. 50 лет Октября, 98,<br>
									 Гипермаркет «Линия»</b><br>
 <br>
									 09:00-21:00<br>
									 +7 (961)196-07-55<br>
 <br>
 <a id="adress" data-city-id="5" data-shop-id="1" href="#map">Показать на карте</a>
								</div>
							</div>
							<div style="height: 20px; width: 100%; clear: both;">
							</div>
						</div>
 </li>
					</ul>
					<div style="height: 5px; width: 100%; clear: both;">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div id="map" style="min-height:100%;">
				</div>
			</div>
		</div>
	</div>
</div>
 <script>
        var map;
        var placemarkCollection;
        var placemarkList = {};

        // Список городов и магазинов в них
        var shopList = [
            {
                'city_name': 'Краснодар',
                'shops': [
                    {
                        'coordinates': [45.04518731810544, 38.979584830688395],
                        'name': 'Красная 176, литер 5',
                    },
                    {
                        'coordinates': [45.06015357458218, 38.94239712698355],
                        'name': 'Атарбекова, 1/1',
                    },
                    {
                        'coordinates': [45.031744074585845, 38.91747949999999],
                        'name': 'Чекистов, 36',
                    },
                    {
                        'coordinates': [45.034818412807994, 39.052792276071244],
                        'name': 'Уральская  79/1',
                    },
                    {
                        'coordinates': [45.01316017700756, 38.9302619087371],
                        'name': 'Тургеневское шоссе, 27',
                    },
                    {
                        'coordinates': [45.0253121843544, 39.05790376099971],
                        'name': 'Лизы Чайкиной 2/1',
                    },
                    {
                        'coordinates': [45.15817023620747, 39.00027528824022],
                        'name': 'Ейское шоссе 40',
                    },
                    {
                        'coordinates': [45.08056757458355, 38.89375499999996],
                        'name': 'Западный обход 29',
                    },
                    {
                        'coordinates': [45.0112303, 39.12264189999996],
                        'name': 'ул. Крылатая 2',
                    },
                ],
            },

            {
                'city_name': 'Ижевск',
                'shops': [
                    {
                        'coordinates': [56.8474685678539, 53.27726499999999],
                        'name': 'ул. Ленина, 136',
                    },
                ],
            },

            {
                'city_name': 'Новосибирск',
                'shops': [
                    {
                        'coordinates': [54.96401833971174, 82.93559206679532],
                        'name': 'ул. Ватутина, 107',
                    },
                    {
                        'coordinates': [54.96966913023103, 83.09994980555724],
                        'name': 'ул. Эйхе, 2',
                    },
                ],
            },

            {
                'city_name': 'Ставрополь',
                'shops': [
                    {
                        'coordinates': [44.999328410844385, 41.92680837235259],
                        'name': 'ул. Доватерцев, 64',
                    },
                ],
            },

            {
                'city_name': 'Железногорск',
                'shops': [
                    {
                        'coordinates': [52.352134478346585, 35.366176381614636],
                        'name': 'ул. Мира, 62',
                    },
                ],
            },

            {
                'city_name': 'Курск',
                'shops': [
                    {
                        'coordinates': [51.69959184827574, 36.15715199153339],
                        'name': 'ул. Энгельса, 115Д',
                    },
                    {
                        'coordinates': [51.740011478623344, 36.14607838954915],
                        'name': 'ул. 50 лет Октября, 98',
                    },

                ],
            },

            {
                'city_name': 'Нижний Новгород',
                'shops': [
                    {
                        'coordinates': [56.224094, 44.07354929999997],
                        'name': 'Кстовский район, с.Федяково',
                    },
                ],
            },

            {
                'city_name': 'Новороссийск',
                'shops': [
                    {
                        'coordinates': [44.727780706, 37.767314584],
                        'name': 'ул. Мира, 1',
                    },
                ],
            },
        ];

        ymaps.ready(init);

        /**
         * Вывод меток магазинов из указанного города на карте
         * @param cityId
         */
        function showShopListFromCity(cityId) {
            placemarkCollection.removeAll();

            for (var c = 0; c < shopList[cityId].shops.length; c++) {

                if (placemarkList[cityId] === undefined) placemarkList[cityId] = {};

                placemarkList[cityId][c] = new ymaps.Placemark(
                    shopList[cityId].shops[c].coordinates,
                    {
                        hintContent: shopList[cityId].shops[c].name,
                        balloonContent: shopList[cityId].shops[c].name
                    }
                );

                placemarkCollection.add(placemarkList[cityId][c]);
            }

            map.geoObjects.add(placemarkCollection);
            map.setBounds(placemarkCollection.getBounds(), {checkZoomRange: true});
        }


        // Переключение города
        $(document).on('click', 'a#city', function() {
            showShopListFromCity($(this).attr('data-city-id'));
            //console.log($(this).attr('data-city-id'));
            placemarkList[cityId].events.fire('click');
        });

        // Клик на адрес
        $(document).on('click', 'a#adress', function() {
            var cityId = $(this).attr('data-city-id');
            var shopId = $(this).attr('data-shop-id');
            //console.log($(this).attr('data-city-id'));
            //console.log($(this).attr('data-shop-id'));
            placemarkList[cityId][shopId].events.fire('click');
        });

        function init() {
            // Создаем карту
            map = new ymaps.Map('map', {
                center: [5.0288429539558, 38.97288419679491], // координаты центра карты, при загрузке
                zoom: 15,
                controls: [
                    'zoomControl'
                ]
            });

            placemarkCollection = new ymaps.GeoObjectCollection();
            showShopListFromCity(0);
            placemarkList[cityId].events.fire('click');
        }
    </script>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
