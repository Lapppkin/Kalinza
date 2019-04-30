<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
CHTTP::SetStatus('404 Not Found');
@define('ERROR_404','Y');
$APPLICATION->SetTitle('404 Not Found');
?>
<h1>Страница не найдена</h1>
<p>Страница не найдена, перейдите, пожалуйста, на главную <a href="https://kalinza.ru/">страницу сайта</a></p>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>