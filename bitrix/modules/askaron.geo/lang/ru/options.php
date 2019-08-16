<?

$MESS["ASKARON_GEO_GROUP1"] = "Общие настройки";
$MESS["ASKARON_GEO_GROUP_SITE"] = "Настройки для сайта";

$MESS["ASKARON_GET_SET_DEFAULT_LOCATION_ID"] = "Возвращать город по умолчанию,<br>если местоположение не может быть определено";
$MESS["ASKARON_GET_SET_DEFAULT_LOCATION_ID_HELP"] = "Опция для метода <em>\\Askaron\\Geo\\Location::getLocation();</em>.";

$MESS["ASKARON_GET_DEFAULT_LOCATION_ID"] = "Город по умолчанию";
$MESS["ASKARON_GET_DEFAULT_LOCATION_ID_HELP"] = "Например, «Москва». Или создайте город «Другой город», если хотите, чтобы пользователь получал какое-то определенное местоположение.";


$MESS["ASKARON_GET_SET_LOCATION"] = "Устанавливать местоположение в форме оформления заказа<br>(cтандартный компонент bitrix:sale.order.ajax)";



$MESS["ASKARON_GEO_CHECK"] = "Проверка";
$MESS["ASKARON_GEO_USE_SITE_SETTINGS"] = "Использовать настройки для сайта";
$MESS["ASKARON_GEO_YOUR_IP"] = "Ваш IP";



$MESS["ASKARON_GEO_RESULT"] = "Результат";
$MESS["ASKARON_GEO_SPECIAL_INFO"] = "Служебная информация";
$MESS["ASKARON_GEO_LOCATION"] = "Местоположение";


$MESS["ASKARON_GEO_IP"] = "Проверить IP";
$MESS["ASKARON_GEO_IP_CHECK"] = "Получить местоположение";
$MESS["ASKARON_GEO_IP_CLEAR"] = "Обновить данные моего местоположения в моей сессии и куках ";

$MESS["ASKARON_GEO_CITY"] = "Информация из базы городов";
$MESS["ASKARON_GEO_CITY_NOT_FOUND"] = "Город не найден";
$MESS["ASKARON_GEO_LOCATION"] = "Местоположение";
$MESS["ASKARON_GEO_LOCATION_NOT_FOUND"] = "Местоположение не найдено. На сайте будет возвращен город по умолчанию, если задан.";

$MESS["ASKARON_GEO_INFO"] = "Модуль находит город по IP и устанавливает местоположение на странице оформления заказа. База городов хранится на сайте. Запросы к удаленным сервисам не делаются.
<br><br>Для правильной работы модуля необходимы Местоположения 2.0. В местоположениях должны быть заполнены названия городов на русском языке. В форме заказа должно быть свойство типа «Местоположение».
<br><br><a href='http://askaron.ru/api_help/course1/lesson151/' target='_blank'>Документация по модулю</a>.
";
?>