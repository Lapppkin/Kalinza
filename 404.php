<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

CHTTP::SetStatus('404 Not Found');
@define('ERROR_404','Y');
$APPLICATION->SetTitle('Ошибка 404');

$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>

<div class="col">
    <h1 class="text-error text-uppercase text-bold">Ошибка 404</h1>
    <h2>Данная страница не найдена!</h2>
    <h4>Почему?</h4>
    <p>Такой страницы не существует – возможно вы неправильно ввели адрес в адресной строке браузера.</p>
    <h4>Что можно сделать?</h4>
    <p>Вы можете посетить <a href="/">главную страницу</a> или другие разделы сайта.</p>
    <p>&nbsp;</p>
</div>

<? require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php'); ?>
