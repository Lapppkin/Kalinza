<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!$USER->IsAuthorized()): ?>

    <p>Вход или регистрация через соцсети</p>
    <?= $arResult['ULOGIN_CODE'] ?>

<? else: ?>

    <?= GetMessage("ULOGIN_PRIVET") ?><strong><?= $USER->GetLogin() ?></strong>!
    <br>
    <br>
    <a href="<?= $APPLICATION->GetCurPageParam("logout=yes", array("logout")) ?>" style="font-size:14px;"><?= GetMessage("ULOGIN_VYYTI") ?></a>

<?endif; ?>
