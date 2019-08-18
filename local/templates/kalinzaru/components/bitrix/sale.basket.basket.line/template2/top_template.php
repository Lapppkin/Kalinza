<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
		<?
		if (!$arResult["DISABLE_USE_BASKET"]  && $arResult['NUM_PRODUCTS'] == 0)
		{
		?>

			<p class="btn-cta"><a href="<?= $arParams['PATH_TO_BASKET'] ?>">
			<img src="/2/images/basket-icon.svg"/>Подарок уже в <u>корзине</u>
			</a></p>
		<?
		}
		if (!$compositeStub)
		{
			if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'))
			{

			echo '<p class="btn-cta"><a href="'.$arParams['PATH_TO_BASKET'].'"><img src="/2/images/basket-icon.svg"/>В <u>корзине</u> - '.$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)'].'</a></p>';
			}
			if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>
								<br <? if ($arParams['POSITION_FIXED'] == 'Y'): ?>class="hidden-xs"<?endif ?>/>
								<span>
									<?= GetMessage('TSB1_TOTAL_PRICE') ?>
									<? if ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'):?>
										<strong><?= $arResult['TOTAL_PRICE'] ?></strong>
									<?endif ?>
								</span>
								<?endif;?>
		<?
		}
		if ($arParams['SHOW_PERSONAL_LINK'] == 'Y'):?>
			<div style="padding-top: 4px;">
			<span class="icon_info"></span>
			<a href="<?=$arParams['PATH_TO_PERSONAL']?>"><?=GetMessage('TSB1_PERSONAL')?></a>
			</div>
		<?endif?>
