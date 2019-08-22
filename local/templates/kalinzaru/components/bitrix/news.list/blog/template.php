<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

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

<?php if($arParams["DISPLAY_TOP_PAGER"]): ?>
	<?=$arResult["NAV_STRING"]?><br>
<?php endif;?>

<?php foreach($arResult["ITEMS"] as $arItem):

	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="blog--item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

        <?php if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <div class="blog--item--image">
			<?php if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
                </a>
			<?php else: ?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
			<?php endif; ?>
            </div>
		<?php endif; ?>

		<?php if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="blog--item--date"><?= $arItem["DISPLAY_ACTIVE_FROM"]?></div>
		<?php endif; ?>

        <?php if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
            <div class="blog--item--title"><h3>
                <?php if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                    <a href="<?= $arItem["DETAIL_PAGE_URL"]?>"><?= $arItem["NAME"]?></a>
                <?php else: ?>
                    <?= $arItem["NAME"]?>
                <?php endif;?>
            </h3></div>
		<?php endif;?>

		<?php if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
            <div class="blog--item--summary"><?= $arItem["PREVIEW_TEXT"]; ?></div>
		<?php endif;?>

        <div class="blog--item--readmore">
            <a class="btn" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Читать полностью</a>
        </div>

	</div>
<?php endforeach;?>

<?php if($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
	<br><?=$arResult["NAV_STRING"]?>
<?php endif; ?>
