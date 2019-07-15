<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>

<div class="bx-auth">

	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

								<table class="fdgsfg">
                                        <tbody><tr>
                                        <td style="vertical-align: top;">
                                            <label class="id10"><b>Логин</b></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="id3" type="text" name="USER_LOGIN" style="width: 350px;" placeholder="Введите логин">
                                        </td>
                                    </tr>
                                </tbody></table>
								<div style="height: 30px; width: 100%; clear: both;"></div>
								<table class="fdgsfg">
                                        <tbody><tr>
                                        <td style="vertical-align: top;">
                                            <label class="id10"><b>Пароль</b></label>
                                            <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="id3" type="text" name="USER_PASSWORD" style="width: 350px;" placeholder="Введите пароль">
											<?if($arResult["SECURE_AUTH"]):?>
															<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
																<div class="bx-auth-secure-icon"></div>
															</span>
															<noscript>
															<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
																<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
															</span>
															</noscript>
											<script type="text/javascript">
											document.getElementById('bx_auth_secure').style.display = 'inline-block';
											</script>
											<?endif?>
                                        </td>
                                    </tr>
											<?if($arResult["CAPTCHA_CODE"]):?>
												<tr>
													<td></td>
													<td><input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
													<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /></td>
												</tr>
												<tr>
													<td class="bx-auth-label"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:</td>
													<td><input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" /></td>
												</tr>
											<?endif;?>
												<tr>
													<td class="authorize-submit-cell">
														<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
																<noindex>
																	<p>
																		<a href="/auth/?forgot_password=yes" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
																	</p>
																</noindex>
														<?endif?>
														<input type="submit"class="btn btn-primary btn-lg" style="padding: 10px 150px !important;" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
													</td>
												</tr>
<tr><td>
<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
		<noindex>
			<p>
				<a href="/auth/?register=yes" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
			</p>
		</noindex>
<?endif?>
	</td></tr>
                                </tbody></table>




	</form>
</div>


 