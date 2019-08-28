<?php

use Deadie\Helper;

?>
<!--auth modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal--auth">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><?= Helper::renderIcon('close', 'color-primary') ?></span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-logo">
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/logo.png' ?>" alt="kalinza">
                </div>
            </div>
            <div class="modal-body">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:system.auth.authorize",
                    "template1",
                    array(
                        "AUTH_RESULT"        => $APPLICATION->arAuthResult,
                        "COMPONENT_TEMPLATE" => "template1",
                        "SHOW_ERRORS" => "Y",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_SHADOW" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N"
                    ),
                    false
                ); ?>
                <p>Вход или регистрация через соцсети</p>
                <?php
                $APPLICATION->IncludeComponent(
                    "ulogin:auth",
                    "",
                    Array(
                        "SEND_MAIL"   => "N",
                        "SOCIAL_LINK" => "Y",
                        "GROUP_ID"    => array("5"),
                        "ULOGINID1"   => "",
                        "ULOGINID2"   => "",
                    )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<!--/auth modal-->

<!--callback modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal--callback">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><?= Helper::renderIcon('close', 'color-primary') ?></span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-logo">
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/logo.png' ?>" alt="kalinza">
                </div>
                <h5 class="modal-title">Закажите звонок</h5>
                <p>И наши менеджеры перезвонят в течение 10 минут!</p>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= SITE_DIR . 'include/mail/mail.php' ?>" id="callback-form">
                    <div class="form-field">
                        <input type="text" name="name" placeholder="Ваше имя" required>
                    </div>
                    <div class="form-field">
                        <input type="text" name="phone" id="phone_mask" placeholder="Ваше телефон" required>
                    </div>
                    <div class="form-field form-privacy">
                        <input type="checkbox" id="box-2" class="box" required>
                        <label for="box-2">Я согласен с политикой конфиденциальности и защиты информации</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-actions">
                    <input type="submit" id="btn-submit" class="btn btn-default" value="Отправить" form="callback-form">
                </div>
            </div>
        </div>
    </div>
</div>
<!--/callback modal-->

<!--certificate modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal--certificate">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><?= Helper::renderIcon('close', 'color-primary') ?></span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-logo">
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/logo.png' ?>" alt="kalinza">
                </div>
                <h5 class="modal-title">Нужны очки?</h5>
                <p>Получи свой сертификат на <strong>500 рублей</strong></p>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= SITE_DIR . 'include/mail/mail2.php' ?>" id="certificate-form">
                    <div class="form-field">
                        <input type="email" id="name" required name="email" placeholder="Адрес электронной почты">
                    </div>
                    <div class="form-field">
                        <input type="text" name="phone" id="phone_mask" placeholder="Ваше телефон" required>
                    </div>
                    <div class="form-field form-privacy">
                        <input type="checkbox" id="box-2" class="box" required>
                        <label for="box-2">Я согласен с политикой конфиденциальности и защиты информации</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-actions">
                    <input type="submit" id="btn-submit" class="btn btn-default" value="Отправить" form="certificate-form">
                </div>
            </div>
        </div>
    </div>
</div>
<!--/certificate modal-->
