<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

?>
                <div style="height: 15px; width: 100%; clear: both;"></div>
                <div class=" ">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="hzBo">
                                    <a href="/personal/orders/?COPY_ORDER=Y&ID=1" class="hzKn">Повторить заказ</a>
                                </div>

                                    <div style="height: 15px; width: 100%; clear: both;"></div>

                                <div class="lk_href"><a href="/personal/orders/">История заказов</a></div>
                                <div class="lk_href active2"><a href="/personal/private/">Личные данные</a></div>
                            </div>

                            <div class="col-md-8 dfdf333df">
								<h1>Ваш персональный кабинет</h1>
                                    <div style="height: 5px; width: 100%; clear: both;"></div>
                                <p>В личном кабинете Вы можете повторить предыдущие заказы в один клик, узнать Вашу скидку и сумму накоплений, а также изменять информацию Вашей учетной записи.</p>

                                    <div style="height: 25px; width: 100%; clear: both;"></div>

                                <h4>Личные данные</h4>

                                <p>Обратите внимание, что для обновления личных данных вам надо ввести свой пароль.</p>

								<div class="bx_profile">
									<?
									ShowError($arResult["strProfileError"]);
								
									if ($arResult['DATA_SAVED'] == 'Y')
									{
										ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
									}
								
									?>
									<form method="post" name="form1" action="<?=$APPLICATION->GetCurUri()?>" enctype="multipart/form-data" role="form">
										<?=$arResult["BX_SESSION_CHECK"]?>
										<input type="hidden" name="lang" value="<?=LANG?>" />
										<input type="hidden" name="ID" value="<?=$arResult["ID"]?>" />
										<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />
										<div class="main-profile-block-shown" id="user_div_reg">
										<table class="fdgsfg dfdfdfdfdfdf" style="width: 600px;">
											<tr>
												<td style="vertical-align: top;">
													<label class="id10"><b>Имя</b></label>
													<br>
												</td>
												<td style="vertical-align: top;">
													<label class="id10"><b>Фамилия</b></label>
													<br>
												</td>
		
											</tr>
											<tr>
												<td>
													<input class="id3" type="text" name="NAME" style="width: 350px;" placeholder="Антон" value="<?=$arResult["arUser"]["NAME"]?>">
												</td>
												<td>
													<input class="id3" type="text" name="LAST_NAME" style="width: 350px;" placeholder="Харченко" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
												</td>
											</tr>
										</table>
                                 <div style="height: 30px; width: 100%; clear: both;"></div>
										<table class="fdgsfg dfdfdfdfdfdf" style="width: 600px;">
											<tr>
												<td style="vertical-align: top;">
													<label class="id10"><b>Отчество</b></label>
													<br>
												</td>
												<td style="vertical-align: top;">
													<label class="id10"><b>Электронная почта</b></label>
													<br>
												</td>
		
											</tr>
											<tr>
												<td>
													<input class="id3" type="text" name="SECOND_NAME" style="width: 350px;" placeholder="" value="<?=$arResult["arUser"]["SECOND_NAME"]?>">
												</td>
												<td>
													<input class="id3" type="text" name="EMAIL" style="width: 350px;" placeholder="Харченко" value="<?=$arResult["arUser"]["EMAIL"]?>">
												</td>
											</tr>
										</table>
                                 <div style="height: 30px; width: 100%; clear: both;"></div>
										<table class="fdgsfg dfdfdfdfdfdf" style="width: 600px;">
											<tr>
												<td style="vertical-align: top;" colspan="2">
													<label class="id10"><b>Телефон</b></label>
													<br>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<input class="id3" type="text" name="PERSONAL_PHONE" style="width: 350px;" placeholder="" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>">
												</td>
											</tr>
										</table>

											<?
											if (!in_array(LANGUAGE_ID,array('ru', 'ua')))
											{
												?>
												<div class="form-group">
													<label class="main-profile-form-label col-sm-12 col-md-3 text-md-right" for="main-profile-title"><?=Loc::getMessage('main_profile_title')?></label>
													<div class="col-sm-12">
														<input class="form-control" type="text" name="TITLE" maxlength="50" id="main-profile-title" value="<?=$arResult["arUser"]["TITLE"]?>" />
													</div>
												</div>
												<?
											}
											?>
											<?
											if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == '')
											{
												?>


                                 <div style="height: 30px; width: 100%; clear: both;"></div>

										<table class="fdgsfg dfdfdfdfdfdf" style="width: 600px;">
											<tr>
												<td style="vertical-align: top;">
													<label class="id10"><b>Пароль</b></label>
													<br>
												</td>
												<td style="vertical-align: top;">
													<label class="id10"><b>Подтверждение пароля</b></label>
													<br>
												</td>
		
											</tr>
											<tr>
												<td>
													<input class="id3" type="text" name="NEW_PASSWORD" id="main-profile-password" value="" autocomplete="off">
												</td>
												<td>
													<input class="id3" type="text" name="NEW_PASSWORD_CONFIRM" style="width: 350px;" id="main-profile-password-confirm" value="" autocomplete="off">
												</td>
											</tr>
										</table>

												<?
											}
											?>
										</div>
                                 <div style="height: 30px; width: 100%; clear: both;"></div>
										<p class="main-profile-form-buttons-block col-sm-9 col-md-offset-3">
											<input type="submit" name="save" class="btn btn-primary btn-lg" style="padding: 10px 150px !important;" value="<?=(($arResult["ID"]>0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD"))?>">
											&nbsp;
											<input type="submit" class="btn btn-primary btn-lg"  style="padding: 10px 30px !important;" name="reset" value="<?echo GetMessage("MAIN_RESET")?>">
										</p>
									</form>
									<div class="clearfix"></div>
								</div>
                            </div><!--
                            <div class="col-md-2">
                                <div class="gdgdgdgf">
                                    <div style="height: 15px; width: 100%; clear: both;"></div>
                                    <cc>3%</cc>
                                    <div style="height: 5px; width: 100%; clear: both;"></div>
                                    <vv>Ваша скидка</vv>
                                    <div style="height: 30px; width: 100%; clear: both;"></div>

                                    <gffg><b>3990.-</b></gffg>
                                    <div style="height: 0px; width: 100%; clear: both;"></div>
                                    <rr>Сумма накоплений.</rr>
                                    <div style="height: 5px; width: 100%; clear: both;"></div>
                                    <cddc>При сумме 30 000.- скидка вырастит до 5%</cddc>
                                </div>
                            </div>-->

                        </div>
                    </div>
                </div>