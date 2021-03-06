<?
############################################################################################################
# Module: kreattika.oneclickbuy                                                                            #
# Link: http://marketplace.1c-bitrix.ru/solutions/kreattika.oneclickbuy/                                   #
# Component: sale.oneclickbuy                                                                              #
# File: template.php                                                                                       #
# Version: 1.0.1                                                                                           #
# (c) 2011-2018 Kreattika, Sedov S.Y. (����� �.�.)                                                         #
# Proprietary licensed                                                                                     #
# http://kreattika.ru/                                                                                     #
# mailto:info@kreattika.ru                                                                                 #
############################################################################################################
?><?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="row oneclickbuy-form">
	<?if(isset($arParams["FORM_TITLE"]) && !empty($arParams["FORM_TITLE"])):?><div class="col-sm-12"><h2><?=$arParams["FORM_TITLE"]?></h2></div><?endif;?>
<?if(!empty($arResult["ERROR_MESSAGE"])):
	foreach($arResult["ERROR_MESSAGE"] as $v):
		?><div class="col-sm-12"><?ShowError($v);?></div><?
	endforeach;
endif;

if(strlen($arResult["SUCCESS_MESSAGE"]) > 0):
	?><div class="col-sm-12 kocb-success-text"><?=$arResult["SUCCESS_MESSAGE"]?></div><?
	if( $arParams["SET_YANDEX_METRIKA_GOAL"] == "Y" && $arParams["YANDEX_METRIKA_VIEW_TYPE"] == "SUCCESS" && isset($arParams["YANDEX_METRIKA_COUNTER_ID"]) && !empty($arParams["YANDEX_METRIKA_COUNTER_ID"]) && isset($arParams["YANDEX_METRIKA_GOAL_ID"]) && !empty($arParams["YANDEX_METRIKA_GOAL_ID"]) ):
	?>
		<script type="text/javascript">
			yaCounter<?=$arParams["YANDEX_METRIKA_COUNTER_ID"]?>.reachGoal('<?=$arParams["YANDEX_METRIKA_GOAL_ID"]?>');
		</script>
	<?endif;
else:
	if($arResult["VIEW_FORM"] == "Y" ):?>
		<div class="col-sm-12">
			<form action="<?=$APPLICATION->GetCurPage()?>" <?if(isset($arParams["FORM_ID"]) && !empty($arParams["FORM_ID"])):?>id="<?=$arParams["FORM_ID"]?>"<?endif;?> method="POST"<?if( $arParams["SET_YANDEX_METRIKA_GOAL"] == "Y" && $arParams["YANDEX_METRIKA_VIEW_TYPE"] == "ONSUBMIT" && isset($arParams["YANDEX_METRIKA_COUNTER_ID"]) && !empty($arParams["YANDEX_METRIKA_COUNTER_ID"]) && isset($arParams["YANDEX_METRIKA_GOAL_ID"]) && !empty($arParams["YANDEX_METRIKA_GOAL_ID"]) ):?> onSubmit="yaCounter<?=$arParams["YANDEX_METRIKA_COUNTER_ID"]?>.reachGoal('<?=$arParams["YANDEX_METRIKA_GOAL_ID"]?>'); return true;"<?endif;?>>
				<?=bitrix_sessid_post()?>
				<?foreach ($arResult["ORDER_FIELDS"] as $keyOrderFields => $elOrderFields):?>
					<input type="hidden" id="fid-<?=strtolower($elOrderFields["NAME"])?>" name="<?=$elOrderFields["NAME"]?>" value="<?=$elOrderFields["VALUE"]?>">
				<?endforeach;?>
				<?foreach ($arResult["FIELDS"] as $keyFields => $elFields):?>
					<div class="form-group form-<?=strtolower($elFields["NAME"])?>-line">
					<?if( !empty($elFields["LABEL"]) ):?>
						<label for="fid-<?=strtolower($elFields["NAME"])?>"><?=$elFields["LABEL"]?>: <?if($elFields["CHECK"]=="Y"):?><span class="kocb-req">*</span><?endif;?></label>
					<?endif;?>
					<?if($elFields["TYPE"]=="text"):?>
						<input class="form-control" type="<?=$elFields["TYPE"]?>" id="fid-<?=strtolower($elFields["NAME"])?>" name="<?=$elFields["NAME"]?>" value="<?=$elFields["VALUE"]?>"<?if($elFields["CHECK"]=="Y"):?> required="required"<?endif;?><?if(!empty($elFields["PLACEHOLDER"])):?> placeholder="<?=$elFields["PLACEHOLDER"]?><?if($elFields["CHECK"]=="Y"):?> *<?endif;?>"<?endif;?>>
					<?elseif($elFields["TYPE"]=="textarea"):?>
						<textarea class="form-control" id="fid-<?=strtolower($elFields["NAME"])?>" name="<?=$elFields["NAME"]?>" rows="3"<?if($elFields["CHECK"]=="Y"):?> required="required"<?endif;?><?if(!empty($elFields["PLACEHOLDER"])):?> placeholder="<?=$elFields["PLACEHOLDER"]?><?if($elFields["CHECK"]=="Y"):?> *<?endif;?>"<?endif;?>><?=$elFields["VALUE"]?></textarea>
					<?endif;?>
					</div>
				<?endforeach;?>
				<?if($arParams["USE_CAPTCHA"] == "Y"):?>
					<?if($arParams["USE_RECAPTCHA"] == "Y"):?>
						<div class="form-group kocb-recaptcha">
							<div class="g-recaptcha" data-sitekey="<?=$arParams["RECAPTCHA_PUBLIC"]?>" data-theme="<?=$arParams["RECAPTCHA_THEME"]?>" data-type="<?=$arParams["RECAPTCHA_TYPE"]?>" data-size="<?=$arParams["RECAPTCHA_SIZE"]?>"></div>
						</div>
					<?else:?>
						<div class="form-group kocb-captcha">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="kocb-ctext"><?=GetMessage("KOCB_CAPTCHA")?></div>
									<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
									<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
								</div>
								<div class="col-xs-12 col-sm-6 col-md-8">
									<div class="kocb-ctext"><?=GetMessage("KOCB_CAPTCHA_CODE")?><span class="kocb-req">*</span></div>
									<input class="form-control" type="text" name="captcha_word" size="30" maxlength="50" value="">
								</div>
							</div>
						</div>
					<?endif;?>
				<?endif;?>
				<?if($arParams["USE_USER_CONSENT"] == "Y"):?>
					<div class="form-check kocb-user-consent pull-left">
						<input class="form-check-input" type="checkbox" id="fid-user-consent" name="user_consent"<?if($arParams["DEF_USER_CONSENT_IS_CHECKED"] == "Y"):?> checked="checked"<?endif;?>>
						<label class="form-check-label" for="fid-user-consent"><?=$arResult["USER_CONSENT_LABEL"]?></label>
					</div>
				<?endif;?>
				<div class="form-group kocb-submit pull-right">
					<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
					<input  class="btn btn-primary pull-right" type="submit" name="submit" value="<?=$arParams["SUBMIT_TITLE"]?>"<?if( $arParams["SET_YANDEX_METRIKA_GOAL"] == "Y" && $arParams["YANDEX_METRIKA_VIEW_TYPE"] == "ONCLICK" && isset($arParams["YANDEX_METRIKA_COUNTER_ID"]) && !empty($arParams["YANDEX_METRIKA_COUNTER_ID"]) && isset($arParams["YANDEX_METRIKA_GOAL_ID"]) && !empty($arParams["YANDEX_METRIKA_GOAL_ID"]) ):?> onClick="yaCounter<?=$arParams["YANDEX_METRIKA_COUNTER_ID"]?>.reachGoal('<?=$arParams["YANDEX_METRIKA_GOAL_ID"]?>'); return true;"<?endif;?>>
				</div>
			</form>
		</div>
		<?
	else:
		if(!empty($arResult["NOTIFY_MESSAGE"])):
			foreach($arResult["NOTIFY_MESSAGE"] as $v):
				?><div class="col-sm-12 kocb-notify-text"><?=$v?></div><?
			endforeach;
		endif;
	endif;
endif;?>
</div>