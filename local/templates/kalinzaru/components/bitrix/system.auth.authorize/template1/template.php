<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>
<div class="bx-auth">
	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="AUTH">
		<?php if (strlen($arResult["BACKURL"]) > 0): ?>
    		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>">
		<?php endif?>
		<?php foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>">
		<?php endforeach?>

        <div class="form-field">
            <label class="id10">Логин:</label>
            <input class="id3" type="text" name="USER_LOGIN" placeholder="Введите логин">
        </div>
        <div class="form-field">
            <label class="id10">Пароль:</label>
            <input class="id3" type="password" name="USER_PASSWORD" placeholder="Введите пароль">
            <?php if($arResult["SECURE_AUTH"]): ?>
                <span class="bx-auth-secure" id="bx_auth_secure" title="<?= GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
                    <div class="bx-auth-secure-icon"></div>
                </span>
                <noscript>
                    <span class="bx-auth-secure" title="<?= GetMessage("AUTH_NONSECURE_NOTE")?>">
                        <div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
                    </span>
                </noscript>
                <script>document.getElementById('bx_auth_secure').style.display = 'inline-block';</script>
            <?php endif?>
        </div>
        <div class="form-field">
            <?php if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
                <noindex>
                    <p class="text-center">
                        <a href="/auth/?forgot_password=yes" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
                    </p>
                </noindex>
            <?php endif?>
        </div>
        <div class="form-actions">
            <input type="submit"class="btn btn-default" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>">
        </div>

        <div class="form-field">
            <?php if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
                <noindex>
                    <p class="text-center">
                        <a href="/auth/?register=yes" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>
                    </p>
                </noindex>
            <?php endif?>
        </div>

	</form>
</div>


