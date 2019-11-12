<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="menu">
    <?
    $previousLevel = 0;
    foreach($arResult as $arItem):
    ?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif?>

        <?if ($arItem["IS_PARENT"]):?>
                <li<?if($arItem["CHILD_SELECTED"] !== true):?><?endif?>>
                    <a href="<?=$arItem["LINK"]?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                    <ul>
            <?else:?>

            <?if ($arItem["PERMISSION"] > "D"):?>
                    <li>
                            <? if ($arItem['LINK'] == '/informаciya/'): ?>
                                <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "topbar_kalinza",
                                    array(
                                        "ROOT_MENU_TYPE"        => "bottom_info",
                                        "MENU_CACHE_TYPE"       => "A",
                                        "MENU_CACHE_TIME"       => "36000000",
                                        "MENU_CACHE_USE_GROUPS" => "N",
                                        "MENU_THEME"            => "",
                                        "CACHE_SELECTED_ITEMS"  => "N",
                                        "MENU_CACHE_GET_VARS"   => array(),
                                        "MAX_LEVEL"             => "1",
                                        "CHILD_MENU_TYPE"       => "",
                                        "USE_EXT"               => "Y",
                                        "DELAY"                 => "N",
                                        "ALLOW_MULTI_SELECT"    => "N",
                                        "COMPONENT_TEMPLATE"    => "",
                                        "COMPOSITE_FRAME_MODE"  => "A",
                                        "COMPOSITE_FRAME_TYPE"  => "AUTO",
                                    ),
                                    false
                                );
                                continue; ?>

                            <? endif; ?>

                        <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                    </li>
            <?endif?>

        <?endif?>

        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

    <?endforeach?>

    <?if ($previousLevel > 1)://close last item tags?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

</ul>
<?endif?>
