<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо");
?>
<div class="col">
    <div class="container container-fix spasibo-container">
        <div class="row spasibo">
            <div class="col-md-12 spasibo-block" style="margin:0 auto; text-align: center;">

                <h1>Спасибо!</h1>
                <h4>Обратите внимание <br>на наши специальные предложения</h4>
                <?
                    if ($USER->GetID() == 6){
                        $USER->Logout();
                        header('Location: http://kalinza.ru/spasibo');
                    }

                ?>
                <div class="block_0">
                    <div style="height: 15px; width: 100%; clear: both;"></div>
                    <div class="block_3">
                        <p><a href="/besplatnaya-proverka-zreniya/" style="color:#000;">Бесплатная<br>проверка зрения</a></p>
                        <p><img src="<?= SITE_DIR . 'include/images/eye-test.png' ?>" alt=""></p>
                    </div>
                </div>
                <div style="height: 45px; width: 100%; clear: both;"></div>

            </div>
        </div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
