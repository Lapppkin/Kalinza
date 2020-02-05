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

Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=f2640983-d6a7-4d20-9240-1688a548c07e');

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
                <div class="shops-map--wrapper" id="js-contact-map"></div>
            </div>

		</div>
	</div>
</div>

<?php

$points = array();
foreach ($shops as $shop) {
    $points[] = array(
        'lat' => $shop['lat'],
        'lon' => $shop['lon']
    );
}

//dump($points);

?>

<script>
    ymaps.ready(function () {
        var coords,
            myMap,
            points = [
                <? foreach ($points as $point): ?>
                [<?= $point['lat'] ?>, <?= $point['lon'] ?>],
                <? endforeach; ?>
            ];
        geoObjects = [];
        geoObjects__search = [];

        ymaps.geocode('<?= $cities[REGION_ID]['NAME'] ?>', {results: 1}).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            coords = firstGeoObject.geometry.getCoordinates();
            myMap = new ymaps.Map('js-contact-map', {
                center: coords,
                zoom: 9,
                behaviors: ['default', 'scrollZoom']
            }, {
                searchControlProvider: 'yandex#search'
            });

            myMap.behaviors.disable('scrollZoom');

            /**
             * Данные передаются вторым параметром в конструктор метки, опции - третьим.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark.xml#constructor-summary
             */
            for (var i = 0, len = points.length; i < len; i++) {
                geoObjects[i] = new ymaps.Placemark(points[i], getPointData(infoClients[i]), getPointOptions());
                geoObjects__search[infoClients[i].id_city] = i;

            }

            /**
             * Можно менять опции кластеризатора после создания.
             */
            clusterer.options.set({
                minClusterSize: 2,
                gridSize: 80,
                clusterDisableClickZoom: false
            });

            /**
             * В кластеризатор можно добавить javascript-массив меток (не геоколлекцию) или одну метку.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#add
             */
            clusterer.add(geoObjects);
            myMap.geoObjects.add(clusterer);

            /**
             * Спозиционируем карту так, чтобы на ней были видны все объекты.
             */

            myMap.setBounds(clusterer.getBounds(), {
                checkZoomRange: true
            });

        });

        /**
         * Создадим кластеризатор, вызвав функцию-конструктор.
         * Список всех опций доступен в документации.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Clusterer.xml#constructor-summary
         */
        clusterer = new ymaps.Clusterer({
            /**
             * Через кластеризатор можно указать только стили кластеров,
             * стили для меток нужно назначать каждой метке отдельно.
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/option.presetStorage.xml
             */
            preset: 'islands#blueClusterIcons',
            clusterIcons: [
                {
                    href: '<?= SITE_TEMPLATE_PATH ?>/images/map-cluster.png',
                    size: [40, 40],
                    offset: [-20, -20]
                }],
            //clusterIconContentLayout: null,
            /**
             * Ставим true, если хотим кластеризовать только точки с одинаковыми координатами.
             */
            groupByCoordinates: false,
            /**
             * Опции кластеров указываем в кластеризаторе с префиксом "cluster".
             * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/ClusterPlacemark.xml
             */
            clusterDisableClickZoom: true,
            clusterHideIconOnBalloonOpen: false,
            geoObjectHideIconOnBalloonOpen: false
        });

        /**
         * Функция возвращает объект, содержащий данные метки.
         * Поле данных clusterCaption будет отображено в списке геообъектов в балуне кластера.
         * Поле balloonContentBody - источник данных для контента балуна.
         * Оба поля поддерживают HTML-разметку.
         * Список полей данных, которые используют стандартные макеты содержимого иконки метки
         * и балуна геообъектов, можно посмотреть в документации.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
         */
        getPointData = function (infoClient) {
            return {
                balloonContentHeader: '<font size=3><b>г. ' + infoClient.city.name + '</b></font>',
                balloonContentBody: '<p>' + infoClient.name + '</p>',
                balloonContentFooter: '<div class="span-block"><a href="tel:' + infoClient.phone + '">' + infoClient.phone + '</a><br>' + infoClient.worktime + '</div>',
            };
        };

        /**
         * Функция возвращает объект, содержащий опции метки.
         * Все опции, которые поддерживают геообъекты, можно посмотреть в документации.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/GeoObject.xml
         */
        getPointOptions = function () {
            return {
                preset: 'islands#darkBlueClusterIcons',
                iconLayout: 'default#image',
                iconImageHref: '<?= SITE_TEMPLATE_PATH ?>/images/placemark-icon.png',
                iconImageSize: [23, 31]
            };
        };

        infoClients = [
            <? foreach($shops as $shop): ?>
            {
                name: '<?= $shop['address'] ?>',
                phone: '<?= $shop['phones'][0] ?>',
                city: {
                    id: <?= $cities[$shop['city_id']]['ID'] ?>,
                    name: '<?= $cities[$shop['city_id']]['NAME'] ?>'
                },
                worktime: '<?= $shop['worktime'] ?>',
            },
            <? endforeach; ?>
        ];

    });

    $(document).on('click', '.js')

</script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
