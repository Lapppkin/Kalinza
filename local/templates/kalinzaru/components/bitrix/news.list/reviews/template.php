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

<? if (count($arResult['ITEMS']) > 0): ?>
<div class="reviews-list">

    <?if($arParams["DISPLAY_TOP_PAGER"]):?>
	    <?=$arResult["NAV_STRING"]?><br>
    <?endif;?>

    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $stars = $arItem['PROPERTIES']['STARS']['VALUE'];
        ?>
        <div class="reviews-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="reviews-item--header">
                <div class="reviews-item--name"><?=$arItem['NAME']?></div>
                <div class="reviews-item--date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
                <div class="reviews-item--rating" title="Оценка товара">
                    <? for ($s = 1; $s <= 5; $s++): ?>
                        <? if ($s > $stars): ?>
                            <img src="<?= SITE_DIR . 'include/images/star-empty.png' ?>" alt="" height="16" width="16">
                        <? else: ?>
                            <img src="<?= SITE_DIR . 'include/images/star.png' ?>" alt="" height="16" width="16">
                        <? endif; ?>
                    <? endfor; ?>
                </div>
            </div>
            <div class="reviews-item--body">
                <div class="reviews-item--message">
                    <?=$arItem['PREVIEW_TEXT']?>
                </div>
            </div>
        </div>
    <?endforeach;?>

    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	    <?=$arResult["NAV_STRING"]?>
    <?endif;?>

</div>
<? endif; ?>
