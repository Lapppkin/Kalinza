<?php

use Bitrix\Main\Page\Asset;
use Deadie\Helper;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Наши магазины");

Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU');

$cities = array(
    0 => 'Краснодар',
    1 => 'Ижевск',
    2 => 'Новосибирск',
    3 => 'Ставрополь',
    5 => 'Курск',
    6 => 'Нижний Новгород',
    7 => 'Новороссийск',
);

$shops = array(
    0 => array(
        'shop_id' => 0,
        'city_id' => 0,
        'address' => 'Тургеневское шоссе 27',
        'location' => 'ТРЦ «МЕГА АДЫГЕЯ»',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 960 478-71-80',
        ),
        'images' => array(
		    'include/images/kalinza_photo/krd/mega/3.jpeg',
		    'include/images/kalinza_photo/krd/mega/2.jpeg',
		    'include/images/kalinza_photo/krd/mega/1.jpeg',
		    'include/images/kalinza_photo/krd/mega/4.jpeg',
        ),
        'lat' => 45.01316017700756,
        'lon' => 38.9302619087371,
    ),
    1 => array(
        'shop_id' => 1,
        'city_id' => 0,
        'address' => 'ул. Чекистов 36',
        'location' => 'ТЦ «5 Звезд»',
        'worktime' => '10:00-21:00',
        'phones' => array(
            '+7 953 092-63-81',
        ),
        'images' => array(
            'include/images/kalinza_photo/krd/chekistov/1.jpg',
        ),
        'lat' => 45.031744074585845,
        'lon' => 38.91747949999999,
    ),
    2 => array(
        'shop_id' => 2,
        'city_id' => 0,
        'address' => 'ул. Уральская 79/1',
        'location' => 'ТЦ «АШАН СБС Мегамолл»',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 918 417-88-06',
        ),
        'images' => array(
            'include/images/kalinza_photo/krd/sbs/1.jpg',
            'include/images/kalinza_photo/krd/sbs/2.jpg',
        ),
        'lat' => 45.034818412807994,
        'lon' => 39.052792276071244,
    ),
    3 => array(
        'shop_id' => 3,
        'city_id' => 0,
        'address' => 'ул. Атарбекова 1/1',
        'location' => 'ТЦ «BOSS HOUSE»',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 960 478-71-80',
        ),
        'images' => array(
            'include/images/kalinza_photo/krd/atarbekova/1.jpg',
            'include/images/kalinza_photo/krd/atarbekova/3.jpg',
            'include/images/kalinza_photo/krd/atarbekova/4.jpg',
        ),
        'lat' => 45.06015357458218,
        'lon' => 38.94239712698355,
    ),
    4 => array(
        'shop_id' => 4,
        'city_id' => 0,
        'address' => 'ул. Лизы Чайкиной 2/1',
        'location' => 'ТЦ «Магнит»',
        'worktime' => '09:00-21:00',
        'phones' => array(
            '+7 964 900-67-74',
        ),
        'images' => array(
            'include/images/kalinza_photo/krd/lisa/1.jpg',
            'include/images/kalinza_photo/krd/lisa/2.jpg',
            'include/images/kalinza_photo/krd/lisa/3.jpg',
        ),
        'lat' => 45.0253121843544,
        'lon' => 39.05790376099971,
    ),
    5 => array(
        'shop_id' => 5,
        'city_id' => 0,
        'address' => 'ул. Ейское шоссе 40,',
        'location' => 'ТЦ «Магнит»',
        'worktime' => '09:00-22:00',
        'phones' => array(
            '+7 906 433-08-29',
        ),
        'images' => array(
            'include/images/kalinza_photo/krd/eiskoe/1.jpg',
            'include/images/kalinza_photo/krd/eiskoe/2.jpg',
            'include/images/kalinza_photo/krd/eiskoe/3.jpg',
        ),
        'lat' => 45.15817023620747,
        'lon' => 39.00027528824022,
    ),
    6 => array(
        'shop_id' => 6,
        'city_id' => 0,
        'address' => 'ул.Западный обход 29',
        'location' => 'ТЦ «Гипермаркет Лента»',
        'worktime' => '09:00-21:00',
        'phones' => array(
            '+7 961 855-13-15',
        ),
        'images' => array(
            'include/images/kalinza_photo/krd/lenta/1.jpg',
            'include/images/kalinza_photo/krd/lenta/2.jpg',
            'include/images/kalinza_photo/krd/lenta/3.jpg',
            'include/images/kalinza_photo/krd/lenta/4.jpg',
            'include/images/kalinza_photo/krd/lenta/5.jpg',
            'include/images/kalinza_photo/krd/lenta/6.jpg',
        ),
        'lat' => 45.08056757458355,
        'lon' => 38.89375499999996,
    ),
    7 => array(
        'shop_id' => 7,
        'city_id' => 0,
        'address' => 'ул. Крылатая 2',
        'location' => 'ТЦ «Oz Молл»',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 918 243-99-84',
        ),
        'images' => array(
            'include/images/kalinza_photo/krd/ozmall/1.jpg',
            'include/images/kalinza_photo/krd/ozmall/2.jpg',
            'include/images/kalinza_photo/krd/ozmall/3.jpg',
            'include/images/kalinza_photo/krd/ozmall/4.jpg',
        ),
        'lat' => 45.0112303,
        'lon' => 39.12264189999996,
    ),

    8 => array(
        'shop_id' => 0,
        'city_id' => 1,
        'address' => 'ул. Ленина, 136',
        'location' => '«Ашан»',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 964 182-10-29',
        ),
        'images' => array(
            'include/images/kalinza_photo/izh/1.jpeg',
            'include/images/kalinza_photo/izh/4.jpeg',
            'include/images/kalinza_photo/izh/5.jpeg',
            'include/images/kalinza_photo/izh/7.jpeg',
            'include/images/kalinza_photo/izh/8.jpeg',
        ),
        'lat' => 56.8474685678539,
        'lon' => 53.27726499999999,
    ),

    9 => array(
        'shop_id' => 0,
        'city_id' => 6,
        'address' => 'Кстовский район, с.Федяково',
        'location' => '',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 920 013-32-88',
        ),
        'images' => array(
            'include/images/kalinza_photo/nizh_nov/1.jpg',
            'include/images/kalinza_photo/nizh_nov/2.jpg',
            'include/images/kalinza_photo/nizh_nov/3.jpg',
            'include/images/kalinza_photo/nizh_nov/4.jpg',
            'include/images/kalinza_photo/nizh_nov/5.jpg',
        ),
        'lat' => 56.224094,
        'lon' => 44.07354929999997,
    ),

    10 => array(
        'shop_id' => 0,
        'city_id' => 7,
        'address' => 'ул. Мира 1',
        'location' => '«ТЦ Магнит»',
        'worktime' => '09:00-21:00',
        'phones' => array(
            '+7 962 861-30-27',
        ),
        'images' => array(
            'include/images/kalinza_photo/novoros/1.jpg',
            'include/images/kalinza_photo/novoros/2.jpg',
            'include/images/kalinza_photo/novoros/3.jpg',
        ),
        'lat' => 44.727780706,
        'lon' => 37.767314584,
    ),

    11 => array(
        'shop_id' => 0,
        'city_id' => 2,
        'address' => 'ул. Ватутина, 107',
        'location' => '«Мега Ашан»',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 960 789-21-23',
        ),
        'images' => array(
            'include/images/kalinza_photo/nsb/1.jpeg',
            'include/images/kalinza_photo/nsb/2.jpeg',
            'include/images/kalinza_photo/nsb/3.jpeg',
            'include/images/kalinza_photo/nsb/4.jpeg',
            'include/images/kalinza_photo/nsb/5.jpeg',
            'include/images/kalinza_photo/nsb/6.jpeg',
        ),
        'lat' => 54.96401833971174,
        'lon' => 82.93559206679532,
    ),
    12 => array(
        'shop_id' => 1,
        'city_id' => 2,
        'address' => 'ул. Эйхе, 2',
        'location' => '«Мега Ашан»',
        'worktime' => '09:00-21:00',
        'phones' => array(
            '+7 953 884-80-90',
        ),
        'images' => array(
            'include/images/kalinza_photo/nsb/eyhe/1.jpg',
            'include/images/kalinza_photo/nsb/eyhe/2.jpg',
            'include/images/kalinza_photo/nsb/eyhe/3.jpg',
            'include/images/kalinza_photo/nsb/eyhe/4.jpg',
            'include/images/kalinza_photo/nsb/eyhe/5.jpg',
        ),
        'lat' => 54.96966913023103,
        'lon' => 83.09994980555724,
    ),

    13 => array(
        'shop_id' => 0,
        'city_id' => 3,
        'address' => 'ул. Доватерцев 64',
        'location' => 'ТЦ «Магнит»',
        'worktime' => '10:00-22:00',
        'phones' => array(
            '+7 928 339-24-21',
        ),
        'images' => array(
            'include/images/kalinza_photo/stav/1.jpeg',
            'include/images/kalinza_photo/stav/5.jpeg',
            'include/images/kalinza_photo/stav/6.jpeg',
            'include/images/kalinza_photo/stav/7.jpeg',
            'include/images/kalinza_photo/stav/8.jpeg',
            'include/images/kalinza_photo/stav/2.jpeg',
        ),
        'lat' => 44.999328410844385,
        'lon' => 41.92680837235259,
    ),

    14 => array(
        'shop_id' => 0,
        'city_id' => 5,
        'address' => 'ул. Энгельса, 115 Д',
        'location' => '«ТЦ Гипермаркет Лента»',
        'worktime' => '09:00-21:00',
        'phones' => array(
            '+7 906 575-72-42',
        ),
        'images' => array(
            'include/images/kalinza_photo/kursk/1.jpg',
            'include/images/kalinza_photo/kursk/2.jpg',
            'include/images/kalinza_photo/kursk/3.jpg',
        ),
        'lat' => 51.69959184827574,
        'lon' => 36.15715199153339,
    ),

    15 => array(
        'shop_id' => 1,
        'city_id' => 5,
        'address' => 'ул. 50 лет Октября, 98',
        'location' => 'Гипермаркет «Линия»',
        'worktime' => '09:00-21:00',
        'phones' => array(
            '+7 961 196-07-55',
        ),
        'images' => array(
            'include/images/kalinza_photo/kursk2/1.jpeg',
            'include/images/kalinza_photo/kursk2/2.jpeg',
            'include/images/kalinza_photo/kursk2/3.jpeg',
        ),
        'lat' => 51.740011478623344,
        'lon' => 36.14607838954915,
    ),

);

?>

<div class="col-12">
    <h1>Наши магазины</h1>

    <div class="container container-fix">
		<div class="row">
            <!--города-->
            <div class="col-4 shops-citites">

                <? reset($cities); foreach ($cities as $city_id => $city): ?>
                <!--город <?= $city ?>-->
                <ul class="accordion">
                    <li>
                        <div class="city-wrapper">

                            <a id="city-<?= $city_id ?>" class="city city-dropdown" data-city-id="<?= $city_id ?>">
                                <div class="city-name"><?= $city ?></div>
                                <span class="city-name-icon"><?= Helper::renderIcon('arrow-down') ?></span>
                            </a>
                            <div class="city-shops main">
                                <? reset($shops); foreach ($shops as $shop): ?>
                                    <? if ($shop['city_id'] === $city_id): ?>
                                        <!--магазин <?= $shop['address'] ?>-->
                                        <div class="city-shop">
                                              <div class="city-shop--address"><?= $shop['address'] ?></div>
                                            <? if (!empty($shop['location'])): ?>
                                                <div class="city-shop--location"><?= $shop['location'] ?></div>
                                            <? endif; ?>
                                            <div class="city-shop--worktime">Часы работы: <?= $shop['worktime'] ?></div>
                                            <? if (!empty($shop['phones'])): ?>
                                                <div class="city-shop--phones">
                                                    <? foreach ($shop['phones'] as $phone): ?>
                                                        <?= Helper::parsePhone($phone,'link') ?><br>
                                                    <? endforeach; ?>
                                                </div>
                                            <? endif ?>
                                            <? if (!empty($shop['images'])): ?>
                                                <div class="city-shop--images">
                                                    <? foreach ($shop['images'] as $image): ?>
                                                        <img src="<?= SITE_DIR . $image ?>" alt="<?= $shop['address'] ?>">
                                                    <? endforeach; ?>
                                                </div>
                                            <? endif; ?>
                                            <div class="city-shop--onmap">
                                                <a class="show-on-map" href="#map"
                                                    data-city-id="<?= $city_id ?>"
                                                    data-shop-id="<?= $shop['shop_id'] ?>"
                                                    data-lat="<?= $shop['lat'] ?>"
                                                    data-lon="<?= $shop['lon'] ?>"
                                                ><?= Helper::renderIcon('location') ?>Показать на карте</a>
                                            </div>
                                        </div>
                                    <? endif; ?>
                                <? endforeach; ?>
                            </div>
                        </div>

                    </li>
                </ul>
                <? endforeach; ?>

            </div>

            <!--карта-->
            <div class="col-8 shops-map">
                <div class="shops-map--wrapper" id="map"></div>
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
        <? reset($cities); foreach ($cities as $city_id => $city): ?>
        {
            'city_name': '<?= $city ?>',
            'shops': [
            <? reset($shops); foreach ($shops as $shop): ?>
                <? if ($shop['city_id'] === $city_id): ?>
                {
                    'coordinates': [<?= $shop['lat'] ?>, <?= $shop['lon'] ?>],
                    'name': '<?= $shop['address'] ?>',
                },
                <? endif; ?>
            <? endforeach; ?>
            ],
        },
        <? endforeach; ?>
    ];

    ymaps.ready(init);

    /**
     * Вывод меток магазинов из указанного города на карте.
     *
     * @param cityId
     */
    function showShopListFromCity(cityId) {
        placemarkCollection.removeAll();
        for (var c in shopList) {
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

    /**
     * Yandex map init.
     */
    function init() {
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

    // Переключение города
    $(document).on('click', '.city-dropdown', function() {
        showShopListFromCity($(this).attr('data-city-id'));
        placemarkList[cityId].events.fire('click');
    });

    // Клик на адресе
    $(document).on('click', '.show-on-map', function() {
        var cityId = $(this).attr('data-city-id');
        var shopId = $(this).attr('data-shop-id');
        placemarkList[cityId][shopId].events.fire('click');
    });

    // Кастомный скроллбар
    $(document).ready(function () {
        $('.shops-citites').mCustomScrollbar({
            axis: 'y',
            theme: 'minimal-dark',
            scrollInertia: 160
        });
    });
</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
