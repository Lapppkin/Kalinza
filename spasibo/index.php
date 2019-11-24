<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо");
?>
 <div class="col">
    <div class="container container-fix spasibo-container">
        <div class="row spasibo">
            <div class="col-md-12 spasibo-block" style="margin:0 auto; text-align: center;">

                <h1>Спасибо за покупку!<br>Ваш заказ принят в доставку</h1>
                <h4>Обратите внимание <br>на наши специальные предложения</h4>

                <?php if ($USER->GetID() == 6) {
                    $USER->Logout();
                    header('Location: http://kalinza.ru/spasibo');
                } ?>
                <div class="block_0">
                    <div class="block_2">
                        <p>Нужны очки?</p>
                        <p>Получи свой сертификат<br>на 500 рублей</p>
                        <form class="contact-form">
                            <div class="form-group">
                                <input type="name" class="form-control" id="name" placeholder="Адрес электронной почты" style="text-align:center !important;
margin:0 auto !important; color: #fff;">
                            </div>
                            <div class="form-group">
                                <input type="submit" id="btn-submit" class="btn btn-primary btn-send-message btn-md" value="Отправить">
                            </div>
                        </form>
                    </div>

                    <div style="height: 15px; width: 100%; clear: both;"></div>

                    <div class="block_3">
                        <a href="/besplatnaya-proverka-zreniya/" style="color:#000;">
                            <p>Бесплатная<br>проверка зрения</p>
                        </a>
                        <img src="<?= SITE_DIR . 'include/images/eye-test.png' ?>" alt="">
                    </div>
                </div>

                <div style="height: 45px; width: 100%; clear: both;"></div>

            </div>
        </div>
    </div>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
