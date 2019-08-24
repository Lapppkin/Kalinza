<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Deadie\Helper;

/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>

		<?if ($USER->IsAuthorized()):
			$name = trim($USER->GetFullName());
			if (! $name)
				$name = trim($USER->GetLogin());
			if (strlen($name) > 15)
				$name = substr($name, 0, 12).'...';
			?>
			<a href="<?=$arParams['PATH_TO_PROFILE']?>" style="color:#000;"><?=htmlspecialcharsbx($name)?></a>
			&nbsp;<?= Helper::renderIcon('key') ?>
			<a href="?logout=yes"><?=GetMessage('TSB1_LOGOUT')?></a>
		<?else:
			$arParamsToDelete = array(
				"login",
				"login_form",
				"logout",
				"register",
				"forgot_password",
				"change_password",
				"confirm_registration",
				"confirm_code",
				"confirm_user_id",
				"logout_butt",
				"auth_service_id",
				"clear_cache"
			);
			$currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
			if ($arParams['AJAX'] == 'N') {?>
                <script>
                    <?=$cartId?>.currentUrl = '<?=$currentUrl?>';
                </script>
            <? } else {
				$currentUrl = '#CURRENT_URL#';
			} ?>
			<?= Helper::renderIcon('key') ?>
			<a class="button_modal" data-toggle="modal" data-target="#modal--auth" href="#">
				<?=GetMessage('TSB1_LOGIN')?>
			</a>
			<? if ($arParams['SHOW_REGISTRATION'] === 'N') {?>
				<a href="<?=$arParams['PATH_TO_REGISTER']?>?register=yes&backurl=<?=$currentUrl; ?>">
					<?=GetMessage('TSB1_REGISTER')?>
				</a>
            <? } ?>
		<?endif?>
