<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Наши магазины");
?><?php
$APPLICATION->AddHeadScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
$APPLICATION->AddHeadScript('https://codd-wd.ru/wp-content/examples/ya-maps/jquery-2.2.0.min.js');
?>
	<style>
       /* .container-fix {
            width: 1256px;
        } */
    </style>
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

.accordion {
}
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
.ymaps-2-1-68-map{height:100vh !important;}
#map{height:100vh !important;}
    </style>

                <div class=" ">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-md-6" style="height:100vh; overflow:scroll;">

                                <div class="bread">
									<a href="/">Главная</a> &nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;
                                    <a href="#">Наши магазины</a>
                                </div>
                                <h1>Наши магазины</h1>

<div class="gfgfgfgfg">
<ul class="accordion">
    <li class="">
        <a class="ttt333" id="city" data-city-id="0"><b>Краснодар</b></a>
        <div class="main tryyy" style="height: 100%;">

                                <!-- <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
					    <div class="item"><img src="/2/img/kalinza_photo/krd/5/1.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krd/5/2.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krd/5/3.jpeg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Красная 176, литер 5</b><br><br><br>9:00-18:00<br>+7 (861) 292-16-40<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="0" href="#map">Показать на карте</a>
                                    </div>
                                </div> -->

                                    <div style="height: 20px; width: 100%; clear: both;"></div>
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
					   <div class="item"><img src="/2/img/kalinza_photo/Атарбекова/1.jpg" /></div>
					   <div class="item"><img src="/2/img/kalinza_photo/Атарбекова/3.jpg" /></div>
					   <div class="item"><img src="/2/img/kalinza_photo/Атарбекова/4.jpg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Атарбекова 1/1<br>ТЦ «BOSS HOUSE»</b><br><br>
                                        10:00-21:00<br>+7 (861) 292-16-40<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="1" href="#map">Показать на карте</a>
                                    </div>
                                </div>

                                    <div style="height: 20px; width: 100%; clear: both;"></div>
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/Чекистов/1.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/Чекистов/2.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/Чекистов/3.jpg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Чекистов 36,<br>ТЦ «5 Звезд»</b><br><br>10:00-21:00<br>+7 (861) 292-16-40<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="2" href="#map">Показать на карте</a>
                                    </div>
                                </div>

                                    <div style="height: 20px; width: 100%; clear: both;"></div>
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/Сбс/1.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/Сбс/2.jpg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
					<b>ул. Уральская 79/1,<br>ТЦ «АШАН СБС  Мегамолл»</b><br><br>10:00-22:00<br>+7 (918) 417-88-06<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="3" href="#map">Показать на карте</a>
                                    </div>
                                </div>

                                    <div style="height: 20px; width: 100%; clear: both;"></div>
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/krd/5/3.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krd/5/2.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krd/5/1.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krd/5/4.jpeg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
					<b>Тургеневское шоссе 27,<br>ТРЦ «МЕГА АДЫГЕЯ»</b><br><br>10:00-22:00<br>+7 (960) 478-71-80<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="4" href="#map">Показать на карте</a>
                                    </div>
                                </div>

                                    <div style="height: 20px; width: 100%; clear: both;"></div>
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/чайка/1.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/чайка/2.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/чайка/3.jpg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
					<b>ул. Лизы Чайкиной 2/1,<br>ТЦ «Магнит»</b><br><br>09:00-21:00<br>+7 (964) 900-67-74<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="5" href="#map">Показать на карте</a>
                                    </div>
                                </div>

                                    <div style="height: 20px; width: 100%; clear: both;"></div>
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/ейское/1.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/ейское/2.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/ейское/3.jpg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
					<b>ул. Ейское шоссе 40,<br>ТЦ «Магнит»</b><br><br>09:00-22:00<br>+7 (906) 433-08-29<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="6" href="#map">Показать на карте</a>
                                    </div>
                                </div>

                                    <div style="height: 20px; width: 100%; clear: both;"></div>
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/krdd/1.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krdd/2.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krdd/3.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krdd/4.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krdd/5.jpg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/krdd/6.jpg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
					<b>ул.Западный обход 29,<br>ТЦ «Гипермаркет Лента»</b><br><br>09:00-21:00<br>+7 (961) 855-13-15<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="7" href="#map">Показать на карте</a>
                                    </div>
                                </div>
        </div>
    </li>

                                    <div style="height: 5px; width: 100%; clear: both;"></div>
    <li>
        <a class="ttt333" id="city" data-city-id="1"><b>Ижевск</b></a>
        <div class="main">
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/izh/1.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/izh/4.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/izh/5.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/izh/7.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/izh/8.jpeg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Ленина 136</b><br>Ашан<br><br>10:00-22:00<br>+7 (964) 182-10-29<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="0" href="#map">Показать на карте</a>
                                    </div>
                                </div>
                                    <div style="height: 20px; width: 100%; clear: both;"></div>
        </div>
    </li>

                                    <div style="height: 5px; width: 100%; clear: both;"></div>
    <li>
        <a class="ttt333" id="city" data-city-id="2"><b>Новосибирск</b></a>
        <div class="main">
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
                                            <div class="item"><img src="/2/img/kalinza_photo/nsb/1.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/nsb/2.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/nsb/3.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/nsb/4.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/nsb/5.jpeg" /></div>
                                            <div class="item"><img src="/2/img/kalinza_photo/nsb/6.jpeg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Ватутина, 107</b><br><br>«Мега Ашан»<br>10:00-22:00<br>8 (960) 789-21-23<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="0" href="#map">Показать на карте</a>
                                    </div>
                                </div>
                                    <div style="height: 20px; width: 100%; clear: both;"></div>
        </div>
    </li>

                                    <div style="height: 5px; width: 100%; clear: both;"></div>
    <li>
        <a class="ttt333" id="city" data-city-id="3"><b>Ставрополь</b></a>
        <div class="main">
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
											<div class="item"><img src="/2/img/kalinza_photo/stav/1.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/stav/5.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/stav/6.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/stav/7.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/stav/8.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/stav/2.jpeg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Доватерцев 64</b><br><br>«ТЦ Магнит»<br>10:00-22:00<br>+7 (928) 339-24-21<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="0" href="#map">Показать на карте</a>
                                    </div>
                                </div>
                                    <div style="height: 20px; width: 100%; clear: both;"></div>
        </div>
    </li>

                                    <div style="height: 5px; width: 100%; clear: both;"></div>
    <li>
        <a class="ttt333" id="city" data-city-id="4"><b>Железногорск</b></a>
        <div class="main">
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
											<div class="item"><img src="/2/img/kalinza_photo/zhelez/1.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/zhelez/3.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/zhelez/4.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/zhelez/5.jpeg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Мира 62</b><br><br>«ТЦ Ашан»»<br>10:00-22:00<br>+7 (910 ) 271-74-10<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="0" href="#map">Показать на карте</a>
                                    </div>
                                </div>
                                    <div style="height: 20px; width: 100%; clear: both;"></div>
        </div>
    </li>

                                    <div style="height: 5px; width: 100%; clear: both;"></div>
    <li>
        <a class="ttt333" id="city" data-city-id="5"><b>Шахты</b></a>
        <div class="main">
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
											<div class="item"><img src="/2/img/kalinza_photo/shaht/1.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/shaht/2.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/shaht/3.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/shaht/4.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/shaht/5.jpeg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/shaht/6.jpeg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>пр. Победы революции 113</b><br><br>«ТЦ Семейный магнит»<br>10:00-22:00<br>+7 (928) 165-79-19<br><br>
                                        <a id="adress" data-city-id="0" data-shop-id="0" href="#map">Показать на карте</a>
                                    </div>
                                </div>
                                    <div style="height: 20px; width: 100%; clear: both;"></div>
        </div>
    </li>
                                    <div style="height: 5px; width: 100%; clear: both;"></div>
    <li>
        <a class="ttt333" id="city" data-city-id="6"><b>Курск</b></a>
        <div class="main">
                                <div class="dddddd">
                                    <div class="bb1">
                                        <div class="owl-carousel owl-theme">
											<div class="item"><img src="/2/img/kalinza_photo/kursk/1.jpg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/kursk/2.jpg" /></div>
											<div class="item"><img src="/2/img/kalinza_photo/kursk/3.jpg" /></div>
                                        </div>
                                    </div>
                                    <div class="bb2">
                                        <b>ул. Энгельса, 115 Д</b><br><br>«ТЦ Гипермаркет Лента»<br>09:00-21:00<br>+7 (906) 575-72-42<br><br>
                                        <a id="adress" data-city-id="6" data-shop-id="0" href="#map">Показать на карте</a>
                                    </div>
                                </div>
                                    <div style="height: 20px; width: 100%; clear: both;"></div>
        </div>
    </li>
</ul> 

                                    <div style="height: 5px; width: 100%; clear: both;"></div>
                            </div>
                            </div>
                            <div class="col-md-6">
								<div id="map" style="min-height:100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>



<link rel="stylesheet" href="/2/css/global.css">
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
                    'coordinates': [45.04518731810544,38.979584830688395],
                    'name': 'Красная 176, литер 5'
                },
                {
                    'coordinates': [45.06015357458218,38.94239712698355],
                    'name': 'Атарбекова, 1/1'
                },
                {
                    'coordinates': [45.031744074585845,38.91747949999999],
                    'name': 'Чекистов, 36'
                },
                {
                    'coordinates': [45.034818412807994,39.052792276071244],
                    'name': 'Уральская  79/1'
                },
                {
                    'coordinates': [45.01316017700756,38.9302619087371],
                    'name': 'Тургеневское шоссе, 27'
                },
                {
                    'coordinates': [45.0253121843544,39.05790376099971],
                    'name': 'Лизы Чайкиной 2/1'
                },
                {
                    'coordinates': [45.15817023620747,39.00027528824022],
                    'name': 'Ейское шоссе 40'
                },
                {
                    'coordinates': [45.08056757458355,38.89375499999996],
                    'name': 'Западный обход 29'
                }
            ]
        },
        {
            'city_name': 'Ижевск',
            'shops': [
                {
                    'coordinates': [56.8474685678539,53.27726499999999],
                    'name': 'ул. Ленина 136'
                }
            ]
        },
        {
            'city_name': 'Новосибирск',
            'shops': [
                {
                    'coordinates': [54.96401833971174,82.93559206679532],
                    'name': 'ул. Ватутина, 107'
                }
            ]
        },
        {
            'city_name': 'Ставрополь',
            'shops': [
                {
                    'coordinates': [44.999328410844385,41.92680837235259],
                    'name': 'ул. Доватерцев 64'
                }
            ]
        },
        {
            'city_name': 'Железногорск',
            'shops': [
                {
                    'coordinates': [52.352134478346585,35.366176381614636],
                    'name': 'ул. Мира 62'
                }
            ]
        },
        {
            'city_name': 'Шахты',
            'shops': [
                {
                    'coordinates': [47.69788404213196,40.20960751650686],
                    'name': 'пр. Победы революции 113'
                }
            ]
        },
        {
            'city_name': 'Курск',
            'shops': [
                {
                    'coordinates': [51.69959184827574,36.15715199153339],
                    'name': 'ул. Энгельса, 115 Д'
                }
            ]
        }
    ];

    ymaps.ready(init);

    /**
     * Вывод меток магазинов из указанного города на карте
     * @param cityId
     */
    function showShopListFromCity(cityId)
    {
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
        map.setBounds(placemarkCollection.getBounds(), {checkZoomRange:true});
    }


    // Переключение города
    $(document).on('click', 'a#city', function() {
        showShopListFromCity( $(this).attr('data-city-id') );

        placemarkList[cityId].events.fire('click');
    });

    // Клик на адрес
    $(document).on('click', 'a#adress', function() {
        var cityId = $(this).attr('data-city-id');
        var shopId = $(this).attr('data-shop-id');

        placemarkList[cityId][shopId].events.fire('click');
    });

    function init(){

        // Создаем карту
        map = new ymaps.Map("map", {
            center: [5.0288429539558,38.97288419679491], // координаты центра карты, при загрузке
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


<script src="/2/js/index.js"></script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>