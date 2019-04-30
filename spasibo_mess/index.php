<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо");
?>         <div class=" ">
                    <div class="container container-fix">
                        <div class="row">
                            <div class="col-md-12 ddfdf" style="margin:0 auto; text-align: center;">

                                <h1>Спасибо!<br> </h1>
                                <h4>Обратите внимание <br>на наши специальные предложения</h4>

<?
	if ($USER->GetID() == 6){
		$USER->Logout();
		header('Location: http://kalinza.ru/spasibo/');
	}

?>
                                <div class="block_0">

                                    <div style="height: 15px; width: 100%; clear: both;"></div>

                                    <div class="block_3">
<a href="/besplatnaya-proverka-zreniya/" style="color:#000;">
                                        <p>Бесплатная<br>проверка зрения</p>
	</a>						<img src="/2/images/1/Bitmap3.png">
                                    </div>
                                </div>
<div style="height: 45px; width: 100%; clear: both;"></div>
                            </div>
                        </div>
                    </div>
                </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>