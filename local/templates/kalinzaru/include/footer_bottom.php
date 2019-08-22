<?

use Deadie\Helper;

?>
<div class="footer--bottom">
    <div class="container">
        <div class="row">
            <div class="footer--bottom--wrapper">

                <div class="footer--bottom--socials col-9">
                    <div class="footer--bottom--socials-label">Мы в соцсетях:</div>
                    <div class="footer--bottom--socials-items">
                        <a href="#" class="social-icon social-icon-vk" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('vk') ?>
                        </a>
                        <a href="https://www.instagram.com/optika_kalinza/" class="social-icon social-icon-instagram" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('instagram') ?>
                        </a>
                        <a href="#" class="social-icon social-icon-ok" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('ok') ?>
                        </a>
                        <a href="#" class="social-icon social-icon-youtube" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('youtube') ?>
                        </a>
                        <a href="#" class="social-icon social-icon-facebook" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('facebook') ?>
                        </a>
                    </div>
                </div>
                <div class="footer--bottom--messengers col-3">
                    <div class="footer--bottom--messengers-label">Мы на связи в мессенджерах:</div>
                    <div class="footer--bottom--messengers-items">
                        <a href="http://t-do.ru/kalinza" class="messenger-icon messenger-icon-telegram" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('telegram') ?>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=79182447228" class="messenger-icon messenger-icon-whatsapp" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('whatsapp') ?>
                        </a>
                        <a href="viber://chat?number=79182447228" class="messenger-icon messenger-icon-viber" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('viber') ?>
                        </a>
                        <a href="#" class="messenger-icon messenger-icon-skype" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('skype') ?>
                        </a>
                        <a href="#" class="messenger-icon messenger-icon-vk" rel="nofollow" target="_blank">
                            <?= Helper::renderIcon('vk') ?>
                        </a>
                    </div>
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