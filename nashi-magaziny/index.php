<?php

use Bitrix\Main\Application;
use Bitrix\Main\Page\Asset;
use core\Helper;
use core\Regionality;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Наши магазины");

$application = Application::getInstance();
$context = $application->getContext();
$request = $context->getRequest();

Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU');

$regions = Regionality::getAllRegions();

$cities = array();
foreach ($regions as $region) {
    $cities[$region['ID']]['ID'] = $region['ID'];
    $cities[$region['ID']]['NAME'] = $region['NAME'];
}

$shops = array();

foreach ($cities as $city) {

    $arOrder = array('SORT' => 'ASC');
    $arFilter = array(
        'IBLOCK_ID' => SHOPS_IBLOCK_ID,
        'PROPERTY_SHOP_REGION' => $city['ID'],
        'ACTIVE' => 'Y',
    );
    $arSelect = array(
        'ID',
        'NAME',
        'CODE',
        'SORT',
        'ACTIVE',
        'PROPERTY_SHOP_GEO',
        'PROPERTY_SHOP_LOCATION',
        'PROPERTY_SHOP_WORKTIME',
        'PROPERTY_SHOP_PHONES',
        'PROPERTY_SHOP_REGION',
        'PROPERTY_SHOP_PHOTO',
    );
    $arShops = \CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
    while($shop = $arShops->GetNext()) {
        $geo = explode(',', $shop['PROPERTY_SHOP_GEO_VALUE']);
        $images = $shop['PROPERTY_SHOP_PHOTO_VALUE'];
        $paths = array();
        foreach ($images as $image) {
            $paths[] = \CFile::GetPath($image);
        }
        $shops[] = array(
            'shop_id' => $shop['ID'],
            'city_id' => $shop['PROPERTY_SHOP_REGION_VALUE'],
            'address' => $shop['NAME'],
            'location' => $shop['PROPERTY_SHOP_LOCATION_VALUE'],
            'worktime' => $shop['PROPERTY_SHOP_WORKTIME_VALUE'],
            'phones' => $shop['PROPERTY_SHOP_PHONES_VALUE'],
            'images' => $paths,
            'lat' => $geo[0],
            'lon' => $geo[1],
        );
    }
}

$cities = array(REGION_ID => $cities[REGION_ID]) + $cities; // перемещение текущего региона наверх массива
?>

<div class="col-12">
    <h1>Наши магазины</h1>

    <div class="container container-fix">
		<div class="row">
            <!--города-->
            <div class="col-md-4 col-sm-12 shops-citites">

                <? reset($cities); foreach ($cities as $city): ?>
                <!--город <?= $city['NAME'] ?>-->
                <ul class="accordion">
                    <li>
                        <div class="city-wrapper">

                            <a id="city-<?= $city['ID'] ?>"
                                class="city city-dropdown <?= $city['ID'] == REGION_ID ? 'active' : '' ?>"
                                data-city-id="<?= $city['ID'] ?>">
                                <div class="city-name"><?= $city['NAME'] ?></div>
                                <span class="city-name-icon"><?= Helper::renderIcon('arrow-down') ?></span>
                            </a>
                            <div class="city-shops main" style="display: <?= $city['ID'] == REGION_ID ? 'block' : 'none' ?>">
                                <? reset($shops); foreach ($shops as $shop): ?>
                                    <? if ($shop['city_id'] === $city['ID']): ?>
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
                                                        <img src="<?= $image ?>" alt="<?= $shop['address'] ?>">
                                                    <? endforeach; ?>
                                                </div>
                                            <? endif; ?>
                                            <div class="city-shop--onmap">
                                                <a class="show-on-map" href="#map"
                                                    data-city-id="<?= $city['ID'] ?>"
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
            <div class="col-md-8 col-sm-12 shops-map">
                <div class="shops-map--wrapper" id="map"></div>
            </div>

		</div>
	</div>
</div>

<script>

    var contactsMaps = {

        cityId: 0,
        placemarkList: {},
        placemarkCollection: null,
        map: null,

        shopList: [
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
        ],

        bindEvents: function () {
            $(document)

            // Переключение города
                .on('click', '.city-dropdown', function() {
                    var cityId = $(this).data('city-id');
                    contactsMaps.showShopListFromCity(cityId);
                    contactsMaps.placemarkList[cityId][0].events.fire('click');
                })

                // Клик на адресе
                .on('click', '.show-on-map', function() {
                    var cityId = $(this).data('city-id');
                    var shopId = $(this).data('shop-id');
                    contactsMaps.placemarkList[cityId][shopId].events.fire('click');
                })

                // Кастомный скроллбар
                .ready(function () {
                    $('.shops-citites').mCustomScrollbar({
                        axis: 'y',
                        theme: 'minimal-dark',
                        scrollInertia: 160
                    });
                });

        },

        /**
         * Вывод меток магазинов из указанного города на карте.
         *
         * @param cityId
         */
        showShopListFromCity: function (cityId) {
            contactsMaps.placemarkCollection.removeAll();
            for (var c in contactsMaps.shopList) {
                if (contactsMaps.placemarkList[cityId] === undefined) contactsMaps.placemarkList[cityId] = {};

                if (contactsMaps.shopList[cityId] === undefined) {
                    contactsMaps.placemarkList[cityId][c] = new ymaps.Placemark(
                        contactsMaps.shopList[cityId].shops[c].coordinates,
                        {
                            hintContent: contactsMaps.shopList[cityId].shops[c].name,
                            balloonContent: contactsMaps.shopList[cityId].shops[c].name
                        }
                    );
                    contactsMaps.placemarkCollection.add(contactsMaps.placemarkList[cityId][c]);
                }

            }
            contactsMaps.map.geoObjects.add(contactsMaps.placemarkCollection);
            contactsMaps.map.setBounds(contactsMaps.placemarkCollection.getBounds(), {checkZoomRange: true});
        },

        init: function () {
            contactsMaps.bindEvents();

            contactsMaps.map = new ymaps.Map('map', {
                center: [5.0288429539558, 38.97288419679491], // координаты центра карты, при загрузке
                zoom: 15,
                controls: [
                    'zoomControl'
                ]
            });

            contactsMaps.placemarkCollection = new ymaps.GeoObjectCollection();
            contactsMaps.showShopListFromCity(0);
            contactsMaps.placemarkList[contactsMaps.cityId][0].events.fire('click');
        },

    };

    ymaps.ready(contactsMaps.init);

</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
