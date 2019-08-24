<?php

use Deadie\Helper;

?>

<div id="modal_1" class="modal-overlay">
    <div class="modal">

        <a class="close-modal">
            <svg viewBox="0 0 20 20">
                <path fill="#4ab8e6"
                    d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
            </svg>
        </a><!-- close modal -->

        <div class="modal-contents TOLKO_MAIN">
            <table style="width: 100%; text-align: center;">
                <tr>
                    <td><img src="/2/images/Logo.svg" width="80%"/></td>
                </tr>
            </table>
            <div style="height: 50px; width: 100%; clear: both;"></div>

            <? $APPLICATION->IncludeComponent(
                "bitrix:system.auth.authorize",
                "template1",
                array(
                    "AUTH_RESULT"        => $APPLICATION->arAuthResult,
                    "COMPONENT_TEMPLATE" => "template1",
                ),
                false
            ); ?>

            <div style="height: 5px; width: 100%; clear: both;"></div>
            <div class="dr_set">
                <h3>Вход или регистрация<br>через соцсети</h3>
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
                <div style="height: 15px; width: 100%; clear: both;"></div>
            </div>

        </div>

    </div>
</div>

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
