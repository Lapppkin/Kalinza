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
$MESS ['KREATTIKA_PARTNER_NAME'] = "KREATTIKA";
$MESS ['KREATTIKA_PARTNER_URI'] = "http://kreattika.ru";
$MESS ['KFF_MODULE_NAME'] = "Buy in 1 click, Fast order";
$MESS ['KFF_MODULE_DESCRIPTION'] = "Making a quick order in 1 click";
$MESS ['KFF_ETYPE_NAME'] = "Ordering in 1 click";
$MESS ['KFF_ETYPE_DESCRIPTION_TEXT'] = "
#EMAIL_TO# - Email of the recipient

#PROPERTY_NAME_VALUE# - the value of a form field Name
#PROPERTY_PHONE_VALUE# - the value of a form field Phone
#PROPERTY_EMAIL_VALUE# - the value of a form field E-mail
#PROPERTY_ADDRESS_VALUE# - the value of a form field Address
#PROPERTY_COMMENT_VALUE# - the value of a form field Comment

#ORDER_ID# - order number
#ORDER_DATE_INSERT# - creation date of the order
#ORDER_DATE_UPDATE# - order renewal date
#ORDER_PRICE# - order amount
#ORDER_CURRENCY# - the currency code of the order
#ORDER_PRICE_PRINT# - the amount of the order, formatted according to currency settings
#ORDER_USER_DESCRIPTION# - order comment
#ORDER_PRICE_DELIVERY# - the delivery amount
#ORDER_DISCOUNT_VALUE# - the order amount after discounts
#ORDER_TAX_VALUE# - amount of taxes
#ORDER_SUM_PAID# - the amount paid order
#ORDER_PAYED# - order payment status (paid, not paid)
#ORDER_DATE_PAYED# - date of payment
#ORDER_STATUS_ID# - order status
#ORDER_DATE_STATUS# - date of the change of order status

#ORDER_COMMENT# - order system comment

#ORDER_ITEMS_TEXT# - order goods list (table in text form)

#ORDER_FULL_TEXT# - full text of the order letter

#REQUEST_PATH# - request path
#REQUEST_REFERER# - request referer
#REQUEST_IP# - IP address
";
$MESS ['KFF_EMESS_SUBJECT'] = "#SITE_NAME#: #ORDER_COMMENT# is issued";
$MESS ['KFF_EMESS_MESSAGE'] = "Information message of a site #SITE_NAME#
------------------------------------------

On the website #SITE_NAME# there was an #ORDER_COMMENT#

#ORDER_FULL_TEXT#
";

$MESS ['KOCB_ETYPE_SIMPLE_DESCRIPTION_TEXT'] = "
#EMAIL_TO# - Email of the recipient

#PROPERTY_NAME_VALUE# - the value of a form field Name
#PROPERTY_PHONE_VALUE# - the value of a form field Phone
#PROPERTY_EMAIL_VALUE# - the value of a form field E-mail
#PROPERTY_ADDRESS_VALUE# - the value of a form field Address
#PROPERTY_COMMENT_VALUE# - the value of a form field Comment

#ORDER_ID# - order number
#ORDER_DATE_INSERT# - creation date of the order
#ORDER_DATE_UPDATE# - order renewal date
#ORDER_PRICE# - order amount
#ORDER_CURRENCY# - the currency code of the order
#ORDER_PRICE_PRINT# - the amount of the order, formatted according to currency settings
#ORDER_USER_DESCRIPTION# - order comment

#ORDER_COMMENT# - order system comment

#ORDER_ITEMS_TEXT# - order goods list (table in text form)

#ORDER_FULL_TEXT# - full text of the order letter

#REQUEST_PATH# - request path
#REQUEST_REFERER# - request referer
#REQUEST_IP# - IP address
";
?>