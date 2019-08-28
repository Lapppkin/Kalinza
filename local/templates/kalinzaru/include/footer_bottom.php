<?

/**
 * @var $APPLICATION
 */

use Deadie\Helper;

?>
<div class="footer--bottom">
    <div class="container">
        <div class="row">
            <div class="footer--bottom--wrapper">

                <div class="footer--bottom--socials social-icons col-9">
                    <?php $APPLICATION->IncludeFile('/include/social_icons.php'); ?>
                </div>
                <div class="footer--bottom--messengers messenger-icons col-3">
                    <?php $APPLICATION->IncludeFile('/include/messenger_icons.php'); ?>
                </div>

                <div class="footer--bottom--regions col-12">
                    <div class="footer--bottom--regions-label">Наши салоны оптики:</div>
                    <div class="footer--bottom--regions-items">
                        <a href="#">Ижевск</a>,
                        <a href="#">Нижний Новгород</a>,
                        <a href="#">Новороссийск</a>,
                        <a href="#">Новосибирск</a>,
                        <a href="#">Ставрополь</a>,
                        <a href="#">Курск</a>
                    </div>
                </div>

                <div class="footer--bottom--contacts col-12">
                    <div class="footer--bottom--contacts-label">Контакты:</div>
                    <div class="footer--bottom--contacts-content">
                        <p>Телефоны: <a href="tel:88001234567">8-800-123-45-67</a>, <a href="tel:+78612921640">+7 861 292-16-40</a></p>
                        <p>E-mail: <a href="mailto:info@kalinza.ru">info@kalinza.ru</a></p>
                        <p>350020, г.Краснодар, ул.Красная, 176, оф.68</p>
                        <p>ИНН 2312932732106, ОГРН 309231117000055</p>
                    </div>
                </div>

                <div class="footer--bottom--copyrights col-12">
                    © <?= Helper::autoCopyright(2009) ?> «Калинза». Все права защищены. <a href="/privacy">Политика конфиденциальности</a>
                </div>

                <div class="footer--bottom--info col-12">Есть противопоказания. Проконсультируйтесь с врачем.</div>

            </div>
        </div>
    </div>
</div>
