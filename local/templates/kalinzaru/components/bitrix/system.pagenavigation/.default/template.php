<?

use core\Helper;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!$arResult["NavShowAlways"]){
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) return;
}
if($arResult['NavPageCount']<2) return '';

//echo "<pre>"; print_r($arResult);echo "</pre>";
?>
<nav class="navigation unselectable">

    <!--previous-->
    <?if ($arResult["NavPageCount"] > 2){?>
    	<?if ($arResult["NavPageNomer"] > 2){?>
    		<a class="prev" href="<?=$APPLICATION->GetCurPageParam('PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]-1), array('PAGEN_'.$arResult["NavNum"]));?>">
                <?= Helper::renderIcon('arrow-left') ?>
            </a>
    	<?}elseif($arResult["NavPageNomer"] == 2){?>
    	   <a class="prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
               <?= Helper::renderIcon('arrow-left') ?>
           </a>
    	<?}?>
    <?}?>

    <!--pages-->
    <div class="pages">
        <?while($arResult["nStartPage"] <= $arResult["nEndPage"]){?>

        	<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]){?>
                <?if($arResult["NavPageCount"] == $arResult["NavPageNomer"]){?>
                    <div class="last"><?=$arResult["nStartPage"]?></div>
                <?}else{?>
        		  <div><?=$arResult["nStartPage"]?></div>
                <?}?>
        	<?}else{
                if($arResult["nStartPage"]==$arResult["nEndPage"]){?>
                    <a class="last" href="<?=$APPLICATION->GetCurPageParam('PAGEN_'.$arResult["NavNum"].'='.$arResult["nStartPage"], array('PAGEN_'.$arResult["NavNum"]));?>"><?=$arResult["nStartPage"]?></a>
                <?}else{?>
					<?if($arResult["nStartPage"] == 1):?>
						<a href="<?=$APPLICATION->GetCurPageParam('', array('PAGEN_'.$arResult["NavNum"]));?>"><?=$arResult["nStartPage"]?></a>
					<?else:?>
                    	<a href="<?=$APPLICATION->GetCurPageParam('PAGEN_'.$arResult["NavNum"].'='.$arResult["nStartPage"], array('PAGEN_'.$arResult["NavNum"]));?>"><?=$arResult["nStartPage"]?></a>
					<?endif;?>
                <?}?>
            <?}?>
        	<?$arResult["nStartPage"]++?>
        <?}?>
    </div>

    <!--next-->
    <?if ($arResult["NavPageCount"] > 2){?>
    	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]){?>
    		<a class="next" href="<?=$APPLICATION->GetCurPageParam('PAGEN_'.$arResult["NavNum"].'='.($arResult["NavPageNomer"]+1), array('PAGEN_'.$arResult["NavNum"]));?>">
                <?= Helper::renderIcon('arrow-right') ?>
            </a>
    	<?}?>
    <?}?>

</nav>
<div class="clear"></div>
