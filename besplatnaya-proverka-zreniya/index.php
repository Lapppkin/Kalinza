<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "KALINZA.ru - проверь зрение в Краснодаре");
$APPLICATION->SetPageProperty("title", "Бесплатная проверка зрения в Краснодаре");
$APPLICATION->SetTitle("Title");
?>

<div class="container container-fix">
	<div class="row">
		<div class="eyecheck col-12">
			<h1>Бесплатная проверка зрения</h1>
			<p>После проверки вам не обязательно ничего покупать. Мы проверим ваше зрение одинаково качественно, вне зависимости, купите вы у нас или нет.</p>

            <div class="clearfix"></div>

            <form class="eyecheck-form" action="<?= SITE_DIR . 'include/mail/mail5.php' ?>" method="post">
                <div class="eyecheck-form--wrapper">
                    <div class="form-item">
                        <div class="form-item--label">* Дата</div>
                        <div class="form-item--item">
                            <select class="seleee" name="day" required="">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <select class="seleee" name="mes" required="">
                                <option value="Январь">Январь</option>
                                <option value="Февраль">Февраль</option>
                                <option value="Март">Март</option>
                                <option value="Апрель">Апрель</option>
                                <option value="Май">Май</option>
                                <option value="Июнь">Июнь</option>
                                <option value="Июль">Июль</option>
                                <option value="Август">Август</option>
                                <option value="Сентябрь">Сентябрь</option>
                                <option value="Октябрь">Октябрь</option>
                                <option value="Ноябрь">Ноябрь</option>
                                <option value="Декабрь">Декабрь</option>
                            </select>
                            <select class="seleee" name="god" required="">
                                <option value="2019">2019</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-item">
                        <label for="eyecheck-select-time">* Время</label>
                        <select class="seleee" name="time" required id="eyecheck-select-time">
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                            <option value="19:00">19:00</option>
                            <option value="20:00">20:00</option>
                        </select>
                    </div>

                    <div class="form-item">
                        <label for="eyecheck-name">* Представьтесь, пожалуйста</label>
                        <input class="id3" type="text" name="name" placeholder="Ваше имя" id="eyecheck-name" required>
                    </div>

                    <div class="form-item">
                        <label for="eyecheck-phone">* Телефон для связи</label>
                        <input class="id3" type="text" name="phone" placeholder="Например, +7 987 654-32-10" id="eyecheck-phone" required>
                    </div>

                    <p>В ближайшее время с вами свяжется специалист и подтвердит возможность консультации в выбранное вами время.</p>
                    <p>Если Вы пользуетесь контактными линзами, то необходимо снять их за 40 минут до визита, иначе данные проверки будут не точными.</p>

                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary btn-lg" value="Записаться">
                    </div>

                </div>
            </form>

		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
