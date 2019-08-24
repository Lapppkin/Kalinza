<!--offers-->
<div class="offers">
    <div class="offers--wrapper">

        <div class="offers--certificate" style="background-image: url(<?= SITE_TEMPLATE_PATH . '/images/certificate.jpg' ?>)">
            <p>Нужны очки?</p>
            <p>Получи свой сертификат<br>на покупку</p>
            <form action="" class="offers--certificate--form">
                <label for="certificate-email" class="certificate-email">
                    <input type="email" placeholder="Адрес электронной почты *" id="certificate-email" name="email">
                </label>
                <div class="certificate-submit">
                    <input type="submit" value="Получить 500 Р">
                </div>
            </form>
        </div>

        <div class="offers--eye-test">
            <a href="/besplatnaya-proverka-zreniya/">
                <span>Пройти <strong>бесплатную проверку</strong> зрения</span>
                <span><img src="<?= SITE_TEMPLATE_PATH . '/images/eye-test.png'?>" alt="eye test"></span>
            </a>
        </div>

    </div>
</div>
<!--/offers-->
