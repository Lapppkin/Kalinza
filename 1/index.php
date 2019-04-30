<noindex>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?>

<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "template1", Array(
	"FORGOT_PASSWORD_URL" => "",	// Страница забытого пароля
		"PROFILE_URL" => "",	// Страница профиля
		"REGISTER_URL" => "",	// Страница регистрации
		"SHOW_ERRORS" => "N",	// Показывать ошибки
	),
	false
);?>

<br>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
</noindex>