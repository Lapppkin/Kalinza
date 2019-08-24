<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
if (empty($arResult["ALL_ITEMS"])) {
    return;
}
CUtil::InitJSCore();
?>

<ul class="menu">
    <li class="has-dropdown">
        <a href="/catalog/kontaktnye_linzy/">Контактные линзы</a>
        <ul class="dropdown">
            <span class="dropdown-block">
                <span class="dropdown-block--title">По сроку ношения</span>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_menu",
                    array(
                        "ROOT_MENU_TYPE" => "bottom_lens",
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
            </span>
            <span class="dropdown-block">
                <span class="dropdown-block--title">Популярные бренды</span>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "bottom_menu",
                    array(
                        "ROOT_MENU_TYPE" => "bottom_brands",
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
            </span>
        </ul>
    </li>
<?php foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns): ?>
    <?php $existPictureDescColomn = ($arResult["ALL_ITEMS"][$itemID]["PARAMS"]["picture_src"] || $arResult["ALL_ITEMS"][$itemID]["PARAMS"]["description"]); ?>
    <li>
        <a href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>" <?if($arResult["ALL_ITEMS"][$itemID]["SELECTED"]):?>class="active"<?endif;?>>
            <?=$arResult["ALL_ITEMS"][$itemID]["TEXT"]?>
        </a>
    </li>
<?php endforeach;?>
</ul>
