<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<style>
.bx_catalog_tile {
    margin-bottom: 0px;
}
.bx-breadcrumb {
    margin: 10px 0;
    margin-left: 320px;
}
	.bx-inclinksfooter-item a{
		color:#000;
	}
.bx_catalog_list_home.col5 .bx_catalog_item {
    padding: 0px 10px;
    margin: 0 0% 00px;
    width: 19%;
}
.bx-no-touch .bx_catalog_list_home .bx_catalog_item:hover .bx_catalog_item_container {
    padding: 0px 10px;
    margin: 0 0% 00px;
}
.bx-no-touch .bx_catalog_list_home .bx_catalog_item:hover .bx_catalog_item_container {
    position: absolute;
    z-index: 990;
    top: 0;
    left: 0;
    right: 0;
    box-shadow: none;
    border-radius: 3px;
    border:  none;
    background: none;
    -webkit-animation: borderview 0s;
    animation: borderview 0s;
}
.tovvaa .tovar {
    height: 400px;
    width: 180px;
}
.bx_catalog_list_home {
    margin-bottom: 20px;
    border-bottom: 0px solid #e5e5e5;
}
</style>
<?
if (!empty($arResult['ITEMS']))
{

	$templateLibrary = array('popup');
	$currencyList = '';
	if (!empty($arResult['CURRENCIES']))
	{
		$templateLibrary[] = 'currency';
		$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
	}
	$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
		'TEMPLATE_LIBRARY' => $templateLibrary,
		'CURRENCIES' => $currencyList
	);
	unset($currencyList, $templateLibrary);
?>

<?
	if ($arParams["DISPLAY_TOP_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

	//echo $arResult['ID'];

	$curr = '';
	$coount = count($APPLICATION->arAdditionalChain);
	if ($coount > 0){$curr = $APPLICATION->arAdditionalChain[$coount-2]['LINK'];}else{$curr = $APPLICATION->arAdditionalChain['0']['LINK'];}
	$APPLICATION->AddHeadString('<link rel="canonical" href="http://' . $_SERVER['HTTP_HOST'] .  $curr . '" />');

	//echo "<pre>";
	//print_r($APPLICATION);
	//echo "</pre>";
?>


                <div style="height: 5px; width: 100%; clear: both;"></div>

                <div class=" ">
                    <div class="container container-fix">
                        <div class="row style_tabl">
                            <div class="col-md-3 style_tabl_foo">
                                <div class="hzBo">
                                    <a href="/personal/orders/" class="hzKn">Повторить заказ</a>
                                </div>

								<? if($arResult['ID'] == 18 or $arResult['ID'] == 8 or $arResult['ID'] == 9 or $arResult['ID'] == 10 or $arResult['ID'] == 11 or $arResult['ID'] == 12 or $arResult['ID'] == 13 or $arResult['ID'] == 27 or $arResult['ID'] == 28 or $arResult['ID'] == 29 or $arResult['ID'] == 30 or $arResult['ID'] == 31 or $arResult['ID'] == 32 or $arResult['ID'] == 33 or $arResult['ID'] == 34 or $arResult['ID'] == 35 or $arResult['ID'] == 40 or $arResult['ID'] == 41 or $arResult['ID'] == 42 or $arResult['ID'] == 43 or $arResult['ID'] == 44 or $arResult['ID'] == 45 or $arResult['ID'] == 46 or $arResult['ID'] == 47 or $arResult['ID'] == 48 or $arResult['ID'] == 49 or $arResult['ID'] == 50 or $arResult['ID'] == 51 or $arResult['ID'] == 52 or $arResult['ID'] == 53 or $arResult['ID'] == 54 or $arResult['ID'] == 55 or $arResult['ID'] == 56 or $arResult['ID'] == 57 or $arResult['ID'] == 58 or $arResult['ID'] == 59 or $arResult['ID'] == 60 or $arResult['ID'] == 61 or $arResult['ID'] == 62 or $arResult['ID'] == 63 or $arResult['ID'] == 64){ ?>
                                <section class="ac-container">
                                    <div>
                                        <input id="ac-1" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-1">По сроку ношения <span></span></label>
                                        <article id="ac_1">
											<ul style="color:#000 !important;">
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "bot2",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                    <div>
                                        <input id="ac-2" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-2">По производителю <span></span></label>
                                        <article>
                                            <ul>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "bot1",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                    <div>
                                        <input id="ac-3" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-3">По материалу <span></span></label>
                                        <article>
                                            <ul>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "kl_3",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                </section>
								<? } ?>


				<? if($arResult['ID'] == 20 or $arResult['ID'] == 36 or $arResult['ID'] == 115 or $arResult['ID'] == 116 or $arResult['ID'] == 117 or $arResult['ID'] == 118 or $arResult['ID'] == 119 or $arResult['ID'] == 120 or $arResult['ID'] == 121 or $arResult['ID'] == 122 or $arResult['ID'] == 123 or $arResult['ID'] == 124 or $arResult['ID'] == 125 or $arResult['ID'] == 37 or $arResult['ID'] == 38 or $arResult['ID'] == 39 or $arResult['ID'] == 65 or $arResult['ID'] == 103 or $arResult['ID'] == 104 or $arResult['ID'] == 105 or $arResult['ID'] == 106 or $arResult['ID'] == 107 or $arResult['ID'] == 108 or $arResult['ID'] == 109 or $arResult['ID'] == 110 or $arResult['ID'] == 66 or $arResult['ID'] == 111 or $arResult['ID'] == 112 or $arResult['ID'] == 113 or $arResult['ID'] == 114 or $arResult['ID'] == 67){ ?>
                                <section class="ac-container">
                                    <div>
                                        <input id="ac-1" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-1">По цвету линзы <span></span></label>
                                        <article>
											<ul style="color:#000 !important;">
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "cvl1",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                    <div>
                                        <input id="ac-2" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-2">По сроку ношения <span></span></label>
                                        <article>
                                            <ul>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "cvl4",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                    <div>
                                        <input id="ac-3" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-3">Подходят для <span></span></label>
                                        <article>
                                            <ul>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "cvl3",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                    <div>
                                        <input id="ac-4" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-4">По производителю<span></span></label>
                                        <article>
                                            <ul>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "cvl2",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
				<hr>
 									<div>
										<a href="/catalog/karnavalnye_linzy/">Карнавальные линзы</a>
									</div>
				<hr>
                                </section>
								<? } ?>

				<? if($arResult['ID'] == 22 or $arResult['ID'] == 71 or $arResult['ID'] == 68 or $arResult['ID'] == 91 or $arResult['ID'] == 92 or $arResult['ID'] == 93 or $arResult['ID'] == 94 or $arResult['ID'] == 95 or $arResult['ID'] == 96 or $arResult['ID'] == 97 or $arResult['ID'] == 98 or $arResult['ID'] == 99 or $arResult['ID'] == 100 or $arResult['ID'] == 101 or $arResult['ID'] == 69 or $arResult['ID'] == 83 or $arResult['ID'] == 84 or $arResult['ID'] == 85 or $arResult['ID'] == 86 or $arResult['ID'] == 87 or $arResult['ID'] == 88 or $arResult['ID'] == 70 or $arResult['ID'] == 89 or $arResult['ID'] == 90){ ?>
                                <section class="ac-container">
                                    <div>
                                        <input id="ac-1" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-1">По объему<span></span></label>
                                        <article>
											<ul style="color:#000 !important;">
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "ras1",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                    <div>
                                        <input id="ac-2" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-2">По производителю<span></span></label>
                                        <article>
                                            <ul>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "ras2",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
                                    <div>
                                        <input id="ac-2" name="accordion-1" type="checkbox" checked />
                                        <label for="ac-2">Наличие контейнера<span></span></label>
                                        <article>
                                            <ul>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"bottom_menu",
									array(
										"ROOT_MENU_TYPE" => "ras3",
										"MENU_CACHE_TYPE" => "A",
										"MENU_CACHE_TIME" => "36000000",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"MENU_CACHE_GET_VARS" => array(
										),
										"CACHE_SELECTED_ITEMS" => "N",
										"MAX_LEVEL" => "1",
										"USE_EXT" => "Y",
										"DELAY" => "N",
										"ALLOW_MULTI_SELECT" => "N",
										"COMPONENT_TEMPLATE" => "bottom_menu",
										"CHILD_MENU_TYPE" => "left"
									),
									false
								);?>
                                            </ul>
                                        </article>
                                    </div>
				<hr>

 									<div>
										<a href="/catalog/rastvory_dlya_poezdk/">Растворы для поездки</a>
									</div>
				<hr>
                                </section>
								<? } ?>

				<? if($arResult['ID'] == 19){ ?>
                                <section class="ac-container">
				<hr>
 									<div>
										<a href="/catalog/kapli/">Все капли</a>
									</div>
				<hr>
                                </section>
								<? } ?>

				<? if($arResult['ID'] == 21 or $arResult['ID'] == 72 or $arResult['ID'] == 73 or $arResult['ID'] == 74){ ?>
                                <section class="ac-container">
				<hr>
 									<div>
										<a href="/catalog/futlyary/">Футляры</a>
									</div>
				<hr>
 									<div>
										<a href="/catalog/salfetki_iz_mikrofibry/">Салфетки из микрофибры</a>
									</div>
				<hr>
 									<div>
										<a href="/catalog/dorozhnye_nabory/">Дорожные наборы</a>
									</div>
				<hr>
                                </section>
								<? } ?>


                            </div>

<div class="col-md-9 bx_catalog_list_home col5 <? echo $templateData['TEMPLATE_CLASS']; ?> tovvaa ">
	<!-- <h1><? echo $arResult["NAME"]; ?></h1> -->
<?
$k=0;
foreach ($arResult['ITEMS'] as $key => $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$arItemIDs = array(
		'ID' => $strMainID,
		'PICT' => $strMainID.'_pict',
		'SECOND_PICT' => $strMainID.'_secondpict',
		'STICKER_ID' => $strMainID.'_sticker',
		'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
		'QUANTITY' => $strMainID.'_quantity',
		'QUANTITY_DOWN' => $strMainID.'_quant_down',
		'QUANTITY_UP' => $strMainID.'_quant_up',
		'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
		'BUY_LINK' => $strMainID.'_buy_link',
		'BASKET_ACTIONS' => $strMainID.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
		'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
		'COMPARE_LINK' => $strMainID.'_compare_link',

		'PRICE' => $strMainID.'_price',
		'DSC_PERC' => $strMainID.'_dsc_perc',
		'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
		'PROP_DIV' => $strMainID.'_sku_tree',
		'PROP' => $strMainID.'_prop_',
		'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
		'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
	);

	$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

	$productTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
		: $arItem['NAME']
	);
	$imgTitle = (
		isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
		? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
		: $arItem['NAME']
	);

	$minPrice = false;
	if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
		$minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
$k++;
	?>
	    <? if ($k==4){
			echo'
				<div class="tovar33" style="margin: 5px 0px; float: left;">
					<a href="/besplatnaya-proverka-zreniya/index.php/"><img src="/2/images/slice.png"></a>
				</div>
			';
		}?>
	    <? if ($k==12){
			echo'
											<div class="block_0" style="width: 340px;">
                                                <div class="block_2" style="width: 325px; margin-top: 25px; margin-left: 10px;">
                                                    <p>Нужны очки?</p>
                                                    <p>Получи свой сертификат<br>на 500 рублей</p>
														<form class="contact-form" action="/2/mail2.php" method="post">
                                                        <div class="form-group">
<input type="email" required class="form-control" name="email" id="name" placeholder="Адрес электронной почты" style="margin: 0 auto !important;text-align:  center; color:#fff;">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" id="btn-submit" class="btn btn-primary btn-send-message btn-md" value="Отправить">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
			';
		}?>
<div class="tovar <? echo ($arItem['SECOND_PICT'] ? 'bx_catalog_item  ' : 'bx_catalog_item'); ?>">
<div class="bx_catalog_item_container" id="<? echo $strMainID; ?>">
    <?php $resizeImg = \CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], ['width' => 200, 'height' => 9999], BX_RESIZE_IMAGE_PROPORTIONAL_ALT); ?>
		<a id="<? echo $arItemIDs['PICT']; ?>" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="bx_catalog_item_images" style="background-image: url('<? echo $resizeImg['src']; ?>')" title="<? echo $imgTitle; ?>"><?
	if ('Y' == $arParams['SHOW_DISCOUNT_PERCENT'])
	{
	?>
			<div id="<? echo $arItemIDs['DSC_PERC']; ?>" class="bx_stick_disc right bottom" style="display:<? echo (0 < $minPrice['DISCOUNT_DIFF_PERCENT'] ? '' : 'none'); ?>;">-<? echo $minPrice['DISCOUNT_DIFF_PERCENT']; ?>%</div>
	<?
	}
	?>
		</a>
<p><? echo $productTitle; ?></p>
<div class="price">
    <div class="price_new"><? echo $minPrice['PRINT_VALUE']; ?></div>
</div>

	 <?
	if (!empty($minPrice))
	{
		if ('N' == $arParams['PRODUCT_DISPLAY_MODE'] && isset($arItem['OFFERS']) && !empty($arItem['OFFERS']))
		{
			echo GetMessage(
				'CT_BCS_TPL_MESS_PRICE_SIMPLE_MODE',
				array(
					'#PRICE#' => $minPrice['PRINT_DISCOUNT_VALUE'],
					'#MEASURE#' => GetMessage(
						'CT_BCS_TPL_MESS_MEASURE_SIMPLE_MODE',
						array(
							'#VALUE#' => $minPrice['CATALOG_MEASURE_RATIO'],
							'#UNIT#' => $minPrice['CATALOG_MEASURE_NAME']
						)
					)
				)
			);
		}
		else
		{

		}
		if ('Y' == $arParams['SHOW_OLD_PRICE'] && $minPrice['DISCOUNT_VALUE'] < $minPrice['VALUE'])
		{
			?>  <?
		}
	}
	unset($minPrice);
	?> <?
	$showSubscribeBtn = false;
	$compareBtnMessage = ($arParams['MESS_BTN_COMPARE'] != '' ? $arParams['MESS_BTN_COMPARE'] : GetMessage('CT_BCS_TPL_MESS_BTN_COMPARE'));
	if (!isset($arItem['OFFERS']) || empty($arItem['OFFERS']))
	{
		?><div class="bx_catalog_item_controls"><?
		if ($arItem['CAN_BUY'])
		{
			if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
			{
			?>
		<div class="bx_catalog_item_controls_blockone"><div style="display: inline-block;position: relative;">
			<a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
			<input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
			<a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
			<span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"><? echo $arItem['CATALOG_MEASURE_NAME']; ?></span>
		</div></div>
			<?
			}
			?>
		<div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="bbb" style="margin: 0 auto;text-align: center;width: 100px;">
			<a id="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="btn btn-primary btn-lg" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" rel="nofollow" style="margin: unset;"><?
			if ($arParams['ADD_TO_BASKET_ACTION'] == 'BUY')
			{
				echo 'Купить';
			}
			else
			{
				echo 'Купить';
			}
			?></a>
		</div>
			<?
			if ($arParams['DISPLAY_COMPARE'])
			{
				?>
				<div class="bx_catalog_item_controls_blocktwo">
					<a id="<? echo $arItemIDs['COMPARE_LINK']; ?>" class="bx_bt_button_type_2 bx_medium" href="javascript:void(0)"><? echo $compareBtnMessage; ?></a>
				</div><?
			}
		}
		else
		{
			?><div id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_catalog_item_controls_blockone"><span class="bx_notavailable"><?
			echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'));
			?></span></div><?
			if ($arParams['DISPLAY_COMPARE'] || $showSubscribeBtn)
			{
			?>
				<div class="bx_catalog_item_controls_blocktwo"><?
				if ($arParams['DISPLAY_COMPARE'])
				{
					?><a id="<? echo $arItemIDs['COMPARE_LINK']; ?>" class="bx_bt_button_type_2 bx_medium" href="javascript:void(0)"><? echo $compareBtnMessage; ?></a><?
				}
				if ($showSubscribeBtn)
				{
				?>
				<a id="<? echo $arItemIDs['SUBSCRIBE_LINK']; ?>" class="bx_bt_button_type_2 bx_medium" href="javascript:void(0)"><?
					echo ('' != $arParams['MESS_BTN_SUBSCRIBE'] ? $arParams['MESS_BTN_SUBSCRIBE'] : GetMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE'));
					?>2</a><?
				}
				?>
			</div><?
			}
		}
		?><div style="clear: both;"></div></div><?
		if (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']))
		{
?>

<?
		}
		$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
		if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
		{
?>
		<div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none1;">
<?
			if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
			{
				foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
				{
?>
					<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
<?
					if (isset($arItem['PRODUCT_PROPERTIES'][$propID]))
						unset($arItem['PRODUCT_PROPERTIES'][$propID]);
				}
			}
			$emptyProductProperties = empty($arItem['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties)
			{
?>
				<table>
<?
					foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo)
					{
?>
						<tr><td><? echo $arItem['PROPERTIES'][$propID]['NAME']; ?></td>
							<td>
<?
								if(
									'L' == $arItem['PROPERTIES'][$propID]['PROPERTY_TYPE']
									&& 'C' == $arItem['PROPERTIES'][$propID]['LIST_TYPE']
								)
								{
									foreach($propInfo['VALUES'] as $valueID => $value)
									{
										?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><br><?
									}
								}
								else
								{
									?><select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]"><?
									foreach($propInfo['VALUES'] as $valueID => $value)
									{
										?><option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? 'selected' : ''); ?>><? echo $value; ?></option><?
									}
									?></select><?
								}
?>
							</td></tr>
<?
					}
?>
				</table>
<?
			}
?>
		</div>
<?
		}
		$arJSParams = array(
			'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
			'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
			'SHOW_ADD_BASKET_BTN' => false,
			'SHOW_BUY_BTN' => true,
			'SHOW_ABSENT' => true,
			'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
			'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'PRODUCT' => array(
				'ID' => $arItem['ID'],
				'NAME' => $productTitle,
				'PICT' => ('Y' == $arItem['SECOND_PICT'] ? $arItem['PREVIEW_PICTURE_SECOND'] : $arItem['PREVIEW_PICTURE']),
				'CAN_BUY' => $arItem["CAN_BUY"],
				'SUBSCRIPTION' => ('Y' == $arItem['CATALOG_SUBSCRIPTION']),
				'CHECK_QUANTITY' => $arItem['CHECK_QUANTITY'],
				'MAX_QUANTITY' => $arItem['CATALOG_QUANTITY'],
				'STEP_QUANTITY' => $arItem['CATALOG_MEASURE_RATIO'],
				'QUANTITY_FLOAT' => is_double($arItem['CATALOG_MEASURE_RATIO']),
				'SUBSCRIBE_URL' => $arItem['~SUBSCRIBE_URL'],
				'BASIS_PRICE' => $arItem['MIN_BASIS_PRICE']
			),
			'BASKET' => array(
				'ADD_PROPS' => ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET']),
				'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
				'EMPTY_PROPS' => $emptyProductProperties,
				'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
				'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
			),
			'VISUAL' => array(
				'ID' => $arItemIDs['ID'],
				'PICT_ID' => ('Y' == $arItem['SECOND_PICT'] ? $arItemIDs['SECOND_PICT'] : $arItemIDs['PICT']),
				'QUANTITY_ID' => $arItemIDs['QUANTITY'],
				'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
				'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
				'PRICE_ID' => $arItemIDs['PRICE'],
				'BUY_ID' => $arItemIDs['BUY_LINK'],
				'BASKET_PROP_DIV' => $arItemIDs['BASKET_PROP_DIV'],
				'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
				'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
				'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
			),
			'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
		);
		if ($arParams['DISPLAY_COMPARE'])
		{
			$arJSParams['COMPARE'] = array(
				'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
				'COMPARE_PATH' => $arParams['COMPARE_PATH']
			);
		}
		unset($emptyProductProperties);
?>
<?foreach($arElement["PRODUCT_PROPERTIES"] as $pid => $product_property):?>
						<tr valign="top">
							<td><?echo $arElement["PROPERTIES"][$pid]["NAME"]?>:</td>
							<td>
							<?if(
								$arElement["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
								&& $arElement["PROPERTIES"][$pid]["LIST_TYPE"] == "L"
							):?>
								<?foreach($product_property["VALUES"] as $k => $v):?>
									<label><input type="radio" name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]" value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"checked"'?>><?echo $v?></label><br>
								<?endforeach;?>
							<?else:?>
								<select name="<?echo $arParams["PRODUCT_PROPS_VARIABLE"]?>[<?echo $pid?>]">
									<?foreach($product_property["VALUES"] as $k => $v):?>
										<option value="<?echo $k?>" <?if($k == $product_property["SELECTED"]) echo '"selected"'?>><?echo $v?></option>
									<?endforeach;?>
								</select>
							<?endif;?>
							</td>
						</tr>
					<?endforeach;?>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script><?
	}
	else
	{
		if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
		{
			$canBuy = $arItem['JS_OFFERS'][$arItem['OFFERS_SELECTED']]['CAN_BUY'];
			?>
		<div class="bx_catalog_item_controls no_touch">
			<?
			if ('Y' == $arParams['USE_PRODUCT_QUANTITY'])
			{
			?>
		<div class="bx_catalog_item_controls_blockone">
			<a id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">-</a>
			<input type="text" class="bx_col_input" id="<? echo $arItemIDs['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<? echo $arItem['CATALOG_MEASURE_RATIO']; ?>">
			<a id="<? echo $arItemIDs['QUANTITY_UP']; ?>" href="javascript:void(0)" class="bx_bt_button_type_2 bx_small" rel="nofollow">+</a>
			<span id="<? echo $arItemIDs['QUANTITY_MEASURE']; ?>"></span>
		</div>
			<?
			}
			?>
		<div id="<? echo $arItemIDs['NOT_AVAILABLE_MESS']; ?>" class="bx_catalog_item_controls_blockone" style="display: <? echo ($canBuy ? 'none' : ''); ?>;"><span class="bx_notavailable"><?
			echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? $arParams['MESS_NOT_AVAILABLE'] : GetMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE'));
		?></span></div>
		<div id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>" class="bx_catalog_item_controls_blocktwo" style="display: <? echo ($canBuy ? '' : 'none'); ?>;">
			<a id="<? echo $arItemIDs['BUY_LINK']; ?>" class="bx_bt_button bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" rel="nofollow"><?
			if ($arParams['ADD_TO_BASKET_ACTION'] == 'BUY')
			{
				echo ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCS_TPL_MESS_BTN_BUY'));
			}
			else
			{
				echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? $arParams['MESS_BTN_ADD_TO_BASKET'] : GetMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET'));
			}
			?></a>
		</div>
		<?
	if ($arParams['DISPLAY_COMPARE'])
	{
	?>
<div class="bx_catalog_item_controls_blocktwo">
	<a id="<? echo $arItemIDs['COMPARE_LINK']; ?>" class="bx_bt_button_type_2 bx_medium" href="javascript:void(0)"><? echo $compareBtnMessage; ?></a>
</div><?
	}
	?>
				<div style="clear: both;"></div>
			</div>
			<?
			unset($canBuy);
		}
		else
		{
			?>
		<div class="bx_catalog_item_controls no_touch">
			<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
			echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
			?></a>
		</div>
			<?
		}
		?>
		<div class="bx_catalog_item_controls touch">
			<a class="bx_bt_button_type_2 bx_medium" href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?
			echo ('' != $arParams['MESS_BTN_DETAIL'] ? $arParams['MESS_BTN_DETAIL'] : GetMessage('CT_BCS_TPL_MESS_BTN_DETAIL'));
			?></a>
		</div>
		<?
		$boolShowOfferProps = ('Y' == $arParams['PRODUCT_DISPLAY_MODE'] && $arItem['OFFERS_PROPS_DISPLAY']);
		$boolShowProductProps = (isset($arItem['DISPLAY_PROPERTIES']) && !empty($arItem['DISPLAY_PROPERTIES']));
		if ($boolShowProductProps || $boolShowOfferProps)
		{
?>
			<div class="bx_catalog_item_articul">
<?
			if ($boolShowProductProps)
			{
				foreach ($arItem['DISPLAY_PROPERTIES'] as $arOneProp)
				{
				?><br><strong><? echo $arOneProp['NAME']; ?></strong> <?
					echo (
						is_array($arOneProp['DISPLAY_VALUE'])
						? implode(' / ', $arOneProp['DISPLAY_VALUE'])
						: $arOneProp['DISPLAY_VALUE']
					);
				}
			}
			if ($boolShowOfferProps)
			{
?>
				<span id="<? echo $arItemIDs['DISPLAY_PROP_DIV']; ?>" style="display: none;"></span>
<?
			}
?>
			</div>
<?
		}
		if ('Y' == $arParams['PRODUCT_DISPLAY_MODE'])
		{
			if (!empty($arItem['OFFERS_PROP']))
			{
				$arSkuProps = array();
				?><div class="bx_catalog_item_scu" id="<? echo $arItemIDs['PROP_DIV']; ?>"><?
				foreach ($arSkuTemplate as $code => $strTemplate)
				{
					if (!isset($arItem['OFFERS_PROP'][$code]))
						continue;
					echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs['PROP'], $strTemplate), '</div>';
				}
				foreach ($arResult['SKU_PROPS'] as $arOneProp)
				{
					if (!isset($arItem['OFFERS_PROP'][$arOneProp['CODE']]))
						continue;
					$arSkuProps[] = array(
						'ID' => $arOneProp['ID'],
						'SHOW_MODE' => $arOneProp['SHOW_MODE'],
						'VALUES_COUNT' => $arOneProp['VALUES_COUNT']
					);
				}
				foreach ($arItem['JS_OFFERS'] as &$arOneJs)
				{
					if (0 < $arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'])
					{
						$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
						$arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = '-'.$arOneJs['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'].'%';
					}
				}
				unset($arOneJs);
				?></div><?
				if ($arItem['OFFERS_PROPS_DISPLAY'])
				{
					foreach ($arItem['JS_OFFERS'] as $keyOffer => $arJSOffer)
					{
						$strProps = '';
						if (!empty($arJSOffer['DISPLAY_PROPERTIES']))
						{
							foreach ($arJSOffer['DISPLAY_PROPERTIES'] as $arOneProp)
							{
								$strProps .= '<br>'.$arOneProp['NAME'].' <strong>'.(
									is_array($arOneProp['VALUE'])
									? implode(' / ', $arOneProp['VALUE'])
									: $arOneProp['VALUE']
								).'</strong>';
							}
						}
						$arItem['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
					}
				}
				$arJSParams = array(
					'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
					'SHOW_QUANTITY' => ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'),
					'SHOW_ADD_BASKET_BTN' => false,
					'SHOW_BUY_BTN' => true,
					'SHOW_ABSENT' => true,
					'SHOW_SKU_PROPS' => $arItem['OFFERS_PROPS_DISPLAY'],
					'SECOND_PICT' => $arItem['SECOND_PICT'],
					'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
					'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
					'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
					'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
					'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
					'DEFAULT_PICTURE' => array(
						'PICTURE' => $arItem['PRODUCT_PREVIEW'],
						'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
					),
					'VISUAL' => array(
						'ID' => $arItemIDs['ID'],
						'PICT_ID' => $arItemIDs['PICT'],
						'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
						'QUANTITY_ID' => $arItemIDs['QUANTITY'],
						'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
						'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
						'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
						'PRICE_ID' => $arItemIDs['PRICE'],
						'TREE_ID' => $arItemIDs['PROP_DIV'],
						'TREE_ITEM_ID' => $arItemIDs['PROP'],
						'BUY_ID' => $arItemIDs['BUY_LINK'],
						'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
						'DSC_PERC' => $arItemIDs['DSC_PERC'],
						'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
						'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
						'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
						'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
						'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
					),
					'BASKET' => array(
						'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
						'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
						'SKU_PROPS' => $arItem['OFFERS_PROP_CODES'],
						'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
						'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
					),
					'PRODUCT' => array(
						'ID' => $arItem['ID'],
						'NAME' => $productTitle
					),
					'OFFERS' => $arItem['JS_OFFERS'],
					'OFFER_SELECTED' => $arItem['OFFERS_SELECTED'],
					'TREE_PROPS' => $arSkuProps,
					'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
				);
				if ($arParams['DISPLAY_COMPARE'])
				{
					$arJSParams['COMPARE'] = array(
						'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
						'COMPARE_PATH' => $arParams['COMPARE_PATH']
					);
				}
				?>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script>
				<?
			}
		}
		else
		{
			$arJSParams = array(
				'PRODUCT_TYPE' => $arItem['CATALOG_TYPE'],
				'SHOW_QUANTITY' => false,
				'SHOW_ADD_BASKET_BTN' => false,
				'SHOW_BUY_BTN' => false,
				'SHOW_ABSENT' => false,
				'SHOW_SKU_PROPS' => false,
				'SECOND_PICT' => $arItem['SECOND_PICT'],
				'SHOW_OLD_PRICE' => ('Y' == $arParams['SHOW_OLD_PRICE']),
				'SHOW_DISCOUNT_PERCENT' => ('Y' == $arParams['SHOW_DISCOUNT_PERCENT']),
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'DEFAULT_PICTURE' => array(
					'PICTURE' => $arItem['PRODUCT_PREVIEW'],
					'PICTURE_SECOND' => $arItem['PRODUCT_PREVIEW_SECOND']
				),
				'VISUAL' => array(
					'ID' => $arItemIDs['ID'],
					'PICT_ID' => $arItemIDs['PICT'],
					'SECOND_PICT_ID' => $arItemIDs['SECOND_PICT'],
					'QUANTITY_ID' => $arItemIDs['QUANTITY'],
					'QUANTITY_UP_ID' => $arItemIDs['QUANTITY_UP'],
					'QUANTITY_DOWN_ID' => $arItemIDs['QUANTITY_DOWN'],
					'QUANTITY_MEASURE' => $arItemIDs['QUANTITY_MEASURE'],
					'PRICE_ID' => $arItemIDs['PRICE'],
					'TREE_ID' => $arItemIDs['PROP_DIV'],
					'TREE_ITEM_ID' => $arItemIDs['PROP'],
					'BUY_ID' => $arItemIDs['BUY_LINK'],
					'ADD_BASKET_ID' => $arItemIDs['ADD_BASKET_ID'],
					'DSC_PERC' => $arItemIDs['DSC_PERC'],
					'SECOND_DSC_PERC' => $arItemIDs['SECOND_DSC_PERC'],
					'DISPLAY_PROP_DIV' => $arItemIDs['DISPLAY_PROP_DIV'],
					'BASKET_ACTIONS_ID' => $arItemIDs['BASKET_ACTIONS'],
					'NOT_AVAILABLE_MESS' => $arItemIDs['NOT_AVAILABLE_MESS'],
					'COMPARE_LINK_ID' => $arItemIDs['COMPARE_LINK']
				),
				'BASKET' => array(
					'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'SKU_PROPS' => $arItem['OFFERS_PROP_CODES'],
					'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
					'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
				),
				'PRODUCT' => array(
					'ID' => $arItem['ID'],
					'NAME' => $productTitle
				),
				'OFFERS' => array(),
				'OFFER_SELECTED' => 0,
				'TREE_PROPS' => array(),
				'LAST_ELEMENT' => $arItem['LAST_ELEMENT']
			);
			if ($arParams['DISPLAY_COMPARE'])
			{
				$arJSParams['COMPARE'] = array(
					'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
					'COMPARE_PATH' => $arParams['COMPARE_PATH']
				);
			}
?>
<script type="text/javascript">
var <? echo $strObName; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
</script>
<?
		}
	}
?></div></div><?
}
?><div style="clear: both;"></div>
</div>
<script type="text/javascript">
BX.message({
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
	BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
	ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
	BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
	COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
	COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
	COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
	BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
	SITE_ID: '<? echo SITE_ID; ?>'
});
</script>
<?
	if ($arParams["DISPLAY_BOTTOM_PAGER"])
	{
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
}
?>

<? //echo "<pre>"; print_r($arResult); echo "</pre>"; ?>
