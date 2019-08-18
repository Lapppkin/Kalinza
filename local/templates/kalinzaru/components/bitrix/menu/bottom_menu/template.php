<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (empty($arResult))
	return;
?>
		<?foreach($arResult as $itemIdex => $arItem):?>
            <?if ($arItem["DEPTH_LEVEL"] == "1"):?>
				<li class="bx-inclinksfooter-item">
                    <a href="<?=htmlspecialcharsbx($arItem["LINK"])?>" <?if($arItem["SELECTED"]):?>class="active"<?endif?>><?=htmlspecialcharsbx($arItem["TEXT"])?></a>
                </li>
			<?endif?>
		<?endforeach;?>
