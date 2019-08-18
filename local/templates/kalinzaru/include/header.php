<?

use Deadie\Helper;

?>
<div class="header--header--logo">
    <a href="/">
        <img src="<?= SITE_TEMPLATE_PATH . '/images/logo.png' ?>" alt="kalinza.ru" title="На главную">
    </a>
</div>

<div class="header--header--search"></div>

<div class="header--header--contacts">
    <div class="header--header--contacts-phone">
        <a href="tel:88001234567">8-800-123-45-67</a>
    </div>
    <div class="header--header--contacts-callback">
        <a href="#">Заказать звонок</a>
    </div>
    <div class="header--header--contacts-messengers">
        <a href="http://t-do.ru/kalinza" class="messenger-icon messenger-icon-telegram" rel="nofollow" target="_blank">
            <?= Helper::renderIcon('telegram') ?>
        </a>
        <a href="https://api.whatsapp.com/send?phone=79182447228" class="messenger-icon messenger-icon-whatsapp" rel="nofollow" target="_blank">
            <?= Helper::renderIcon('whatsapp') ?>
        </a>
        <a href="viber://chat?number=79182447228" class="messenger-icon messenger-icon-viber" rel="nofollow" target="_blank">
            <?= Helper::renderIcon('viber') ?>
        </a>
    </div>
</div>
