<?php

use core\Helper;

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
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/svg/logo.svg' ?>" alt="kalinza">
                </div>
            </div>
            <div class="modal-body">
                <? if (!$USER->IsAuthorized()): ?>
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
                <? endif; ?>
                <?php
                $APPLICATION->IncludeComponent(
                    "ulogin:auth",
                    "kalinza",
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
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/svg/logo.svg' ?>" alt="kalinza">
                </div>
                <h5 class="modal-title">Закажите звонок</h5>
                <p>И наши менеджеры перезвонят в течение 10 минут!</p>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= SITE_DIR . 'include/mail/mail.php' ?>" id="callback-form">
                    <div class="form-field">
                        <label for="callback-form-name">* Ваше имя</label>
                        <input type="text" name="name" id="callback-form-name" required>
                    </div>
                    <div class="form-field">
                        <label for="phone-mask">* Ваш телефон</label>
                        <input type="text" name="phone" id="phone_mask" required>
                    </div>
                    <div class="form-field form-privacy">
                        <input type="checkbox" id="callback-privacy" class="box" checked required>
                        <label for="callback-privacy">Я согласен с <a href="/privacy/">политикой конфиденциальности и защиты информации</a></label>
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
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/svg/logo.svg' ?>" alt="kalinza">
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
                        <input type="text" name="phone" id="phone_mask" placeholder="Ваш телефон" required>
                    </div>
                    <div class="form-field form-privacy">
                        <input type="checkbox" id="cert-privacy" class="box" checked required>
                        <label for="cert-privacy">Я согласен с <a href="/privacy/">политикой конфиденциальности и защиты информации</a></label>
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

<!--review modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal--review">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><?= Helper::renderIcon('close', 'color-primary') ?></span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Оставьте отзыв о</h5>
                <p class="modal-product-name"></p>
            </div>
            <div class="modal-body">
                <form id="review-form">
                    <?= bitrix_sessid_post() ?>
                    <input type="hidden" name="product_id">
                    <div class="modal-body--stars">
                        <div class="stars-title">Ваша оценка</div>
                        <div class="stars-inputs">
                            <input type="radio" name="stars" id="stars-5" value="5">
                            <label class="stars-star" for="stars-5" title="5"></label>
                            <input type="radio" name="stars" id="stars-4" value="4">
                            <label class="stars-star" for="stars-4" title="4"></label>
                            <input type="radio" name="stars" id="stars-3" value="3">
                            <label class="stars-star" for="stars-3" title="3"></label>
                            <input type="radio" name="stars" id="stars-2" value="2">
                            <label class="stars-star" for="stars-2" title="2"></label>
                            <input type="radio" name="stars" id="stars-1" value="1">
                            <label class="stars-star" for="stars-1" title="1"></label>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="review-name">* Ваш отзыв</label>
                        <textarea name="message" id="review-message" rows="3" required></textarea>
                    </div>
                    <div class="form-field">
                        <label for="review-name">* Ваше имя</label>
                        <input type="text" name="name" id="review-name" required>
                    </div>
                    <div class="form-field">
                        <label for="review-email">* Ваш email</label>
                        <input type="email" name="email" id="review-email" required>
                    </div>
                    <div class="form-field">
                        <label for="review-phone">Ваш телефон</label>
                        <input type="text" name="phone" id="review-phone">
                    </div>
                    <div class="form-field form-privacy">
                        <input type="checkbox" name="privacy" id="review-privacy" class="box" checked required>
                        <label for="review-privacy">Я согласен с <a href="/privacy/" rel="nofollow" target="_blank">политикой конфиденциальности и защиты информации</a></label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-errors"></div>
                <div class="form-actions">
                    <input type="submit" id="btn-submit" class="btn btn-default" value="Отправить" form="review-form">
                </div>
            </div>
        </div>
    </div>
</div>
<!--/review modal-->

<!--preview modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal--preview">
    <div class="modal-dialog modal-lg" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><?= Helper::renderIcon('close', 'color-primary') ?></span>
        </button>
        <div class="modal-content">
            <div class="modal-body" id="preview-body"></div>
        </div>
    </div>
</div>
<!--/preview modal-->

<!--info modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modal--info">
    <div class="modal-dialog" role="document">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><?= Helper::renderIcon('close', 'color-primary') ?></span>
        </button>
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-logo">
                    <img src="<?= SITE_TEMPLATE_PATH . '/images/svg/logo.svg' ?>" alt="kalinza">
                </div>
                <h5 class="modal-title" id="modal--info-title"></h5>
            </div>
            <div class="modal-body" id="modal--info-body"></div>
            <div class="modal-footer" id="modal--info-footer"></div>
        </div>
    </div>
</div>
<!--/info modal-->
