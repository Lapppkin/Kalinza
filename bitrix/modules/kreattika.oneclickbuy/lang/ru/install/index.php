<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# File: index.php                                                                                          #
# Version: 1.0.1                                                                                           #
# (c) 2011-2017 Kreattika, Sedov S.Y.                                                                      #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?><?
$MESS ['KREATTIKA_PARTNER_NAME'] = "Интернет-агентство \"КРЕАТТИКА\"";
$MESS ['KREATTIKA_PARTNER_URI'] = "http://kreattika.ru";
$MESS ['KOCB_MODULE_NAME'] = "Купить в 1 клик, Быстрый заказ";
$MESS ['KOCB_MODULE_DESCRIPTION'] = "Оформление быстрого заказа в 1 клик";
$MESS ['KOCB_MODULE_INSTALL_TITLE'] = "Установка: Купить в 1 клик, Быстрый заказ";
$MESS ['KOCB_MODULE_UNINSTALL_TITLE'] = "Удаление: Купить в 1 клик, Быстрый заказ";
$MESS ['KOCB_ETYPE_NAME'] = "Оформление заказа в 1 клик";
$MESS ['KOCB_ETYPE_DESCRIPTION_TEXT'] = "
#EMAIL_TO# - Email получателя письма

#PROPERTY_NAME_VALUE# - значение поля формы Имя
#PROPERTY_PHONE_VALUE# - значение поля формы Телефон
#PROPERTY_EMAIL_VALUE# - значение поля формы E-mail
#PROPERTY_ADDRESS_VALUE# - значение поля формы Адрес
#PROPERTY_COMMENT_VALUE# - значение поля формы Комментарий

#ORDER_ID# - номер заказа
#ORDER_DATE_INSERT# - дата создания заказа
#ORDER_DATE_UPDATE# - дата обновления заказа
#ORDER_PRICE# - сумма заказа
#ORDER_CURRENCY# - код валюты заказа
#ORDER_PRICE_PRINT# - сумма заказа, отформатированная в соответствии с настройками валюты
#ORDER_USER_DESCRIPTION# - комментарий покупателя к заказу
#ORDER_PRICE_DELIVERY# - сумма доставки
#ORDER_DISCOUNT_VALUE# - сумма заказа с учетом скидок
#ORDER_TAX_VALUE# - сумма налогов
#ORDER_SUM_PAID# - оплаченная сумма заказа
#ORDER_PAYED# - статус оплаты заказа (оплачен, не оплачен)
#ORDER_DATE_PAYED# - дата оплаты заказа
#ORDER_STATUS_ID# - статус заказа
#ORDER_DATE_STATUS# - дата смены статуса заказа

#ORDER_COMMENT# - служебный комментарий к заказу

#ORDER_ITEMS_TEXT# - список товаров заказа (таблица в текстовом виде)

#ORDER_FULL_TEXT# - полный текст письма заказа

#REQUEST_PATH# - адрес страницы с которой отправлена форма
#REQUEST_REFERER# - referer адреса страницы формы
#REQUEST_IP# - IP адрес с которого отправлена форма
";
$MESS ['KOCB_EMESS_SUBJECT'] = "#SITE_NAME#: Оформлен #ORDER_COMMENT#";
$MESS ['KOCB_EMESS_MESSAGE'] = "Информационное сообщение сайта #SITE_NAME#
------------------------------------------

На сайте #SITE_NAME# был оформлен #ORDER_COMMENT#

#ORDER_FULL_TEXT#
";

$MESS ['KOCB_ETYPE_SIMPLE_DESCRIPTION_TEXT'] = "
#EMAIL_TO# - Email получателя письма

#PROPERTY_NAME_VALUE# - значение поля формы Имя
#PROPERTY_PHONE_VALUE# - значение поля формы Телефон
#PROPERTY_EMAIL_VALUE# - значение поля формы E-mail
#PROPERTY_ADDRESS_VALUE# - значение поля формы Адрес
#PROPERTY_COMMENT_VALUE# - значение поля формы Комментарий

#ORDER_ID# - номер заказа
#ORDER_DATE_INSERT# - дата создания заказа
#ORDER_DATE_UPDATE# - дата обновления заказа
#ORDER_PRICE# - сумма заказа
#ORDER_CURRENCY# - код валюты заказа
#ORDER_PRICE_PRINT# - сумма заказа, отформатированная в соответствии с настройками валюты
#ORDER_USER_DESCRIPTION# - комментарий покупателя к заказу

#ORDER_COMMENT# - служебный комментарий к заказу

#ORDER_ITEMS_TEXT# - список товаров заказа (таблица в текстовом виде)

#ORDER_FULL_TEXT# - полный текст письма заказа

#REQUEST_PATH# - адрес страницы с которой отправлена форма
#REQUEST_REFERER# - referer адреса страницы формы
#REQUEST_IP# - IP адрес с которого отправлена форма
";
?>