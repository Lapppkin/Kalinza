<?

/**
 * @var $APPLICATION
 */

use core\Helper;

?>
<div class="footer--bottom">
    <div class="container">
        <div class="row">
            <div class="footer--bottom--wrapper col-12">

                <div class="footer--bottom--regions">
                    <div class="footer--bottom--regions-label">Наши салоны оптики:</div>
                    <div class="footer--bottom--regions-items">
                        <a href="#">Ижевск</a>
                        <a href="#">Нижний Новгород</a>
                        <a href="#">Новороссийск</a>
                        <a href="#">Новосибирск</a>
                        <a href="#">Ставрополь</a>
                        <a href="#">Курск</a>
                    </div>
                </div>

                <div class="footer--bottom--info">
                    <div class="footer--bottom--info-content">
                        <p>ОГРНИП 309231117000055</p>
                    </div>
                </div>

                <div class="footer--bottom--contacts">
                    <div class="footer--bottom--contacts-content">
                        <p><?php $APPLICATION->IncludeFile('/include/company_phone.php'); ?></p>
                        <p><?php $APPLICATION->IncludeFile('/include/company_email.php'); ?></p>
                    </div>
                </div>

                <div class="footer--bottom--soc">
                    <div class="footer--bottom--socials-icons social-icons">
                        <?php $APPLICATION->IncludeFile('/include/social_icons.php'); ?>
                    </div>
                    <div class="footer--bottom--socials-messengers messenger-icons">
                        <?php $APPLICATION->IncludeFile('/include/messenger_icons.php'); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="footer--bottom--copyrights">
    <div class="container">
        <div class="row">
            <div class="footer--bottom--copyrights-wrapper col-12">

                <div class="footer--bottom--copyrights-copy">
                    © <?= Helper::autoCopyright(2009) ?> «Калинза». Все права защищены.
                </div>
                <div class="footer--bottom--prices-info">Цены на сайте и в салонах оптики могут отличаться.</div>
                <div class="footer--bottom--copyrights-policy">
                    <a href="/privacy">Политика конфиденциальности</a>
                </div>
                <div class="footer--bottom--copyrights-developer">
                    <a href="https://lapkinlab.ru" target="_blank">Разработано
                        <img src="<?= SITE_TEMPLATE_PATH . '/images/lapkinlab-logo.png' ?>" alt="LapkinLab">
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
