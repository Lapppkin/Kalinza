<?

/**
 * Добавление отзыва (из формы в карточке товара)
 *
 * @author deadie
 *
 * @var $DB
 */

use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $DB;

if (\CModule::IncludeModule("sale") && \CModule::IncludeModule("catalog") && \CModule::IncludeModule("iblock")) {

    $messages = [
        0 => 'Спасибо! Ваш отзыв успешно добавлен.',
        1 => 'Товар не найден.',
        2 => 'Выставьте оценку товару.',
        3 => 'Неверное имя.',
        4 => 'E-mail в неверном формате.',
        5 => 'Отзыв пуст. Заполните, пожалуйста, поле «Ваш отзыв».',
        6 => 'Ошибка добавления отзыва.',
        7 => 'Ошибка сессии. Перезагрузите страницу и попробуйте снова.',
        8 => 'Вы не согласились с политикой конфиденциальности.'
    ];
    $codes = [];
    $error = false;

    $application = Application::getInstance();
    $context = $application->getContext();
    $request = $context->getRequest();

    // Валидация полей

    if (bitrix_sessid() !== $request->getPost('sessid')) {
        $error = true;
        $codes[] = $messages[7];
        goto ex;
    }
    if (strtolower($request->getPost('privacy')) !== 'on') {
        $error = true;
        $codes[] = $messages[8];
    }
    $stars = (int) trim(htmlspecialchars($request->getPost('stars')));
    if ($stars <= 0 || $stars > 5) {
        $error = true;
        $codes[] = $messages[2];
    }
    $name = trim(htmlspecialchars($request->getPost('name')));
    if (empty($name)) {
        $error = true;
        $codes[] = $messages[3];
    }
    $email = trim(htmlspecialchars($request->getPost('email')));
    if (empty($email) || !check_email($email)) {
        $error = true;
        $codes[] = $messages[4];
    }
    $phone = trim(htmlspecialchars($request->getPost('phone')));

    $comment = trim(htmlentities($request->getPost('message')));
    if (empty($comment)) {
        $error = true;
        $codes[] = $messages[5];
    }

    $PRODUCT_ID = (int) trim(htmlspecialchars($request->getPost('product_id')));

    // Есть ли товар с таким ID?
    $res = \CIBlockElement::GetByID($PRODUCT_ID)->Fetch();
    if (!$res) {
        $error = true;
        $codes[] = $messages[1];
    }

    ex: // выход

    if ($error) {
        // Выход при ошибке
        print json_encode(array(
            'error' => ($error ? 'Y' : 'N'),
            'message' => implode('<br>', $codes),
        ));
        die();
    }

    // Инициализируем новый элемент
    $el = new \CIBlockElement;
    // Формируем поля элемента инфоблока отзыва
    $prop = [];
    $prop[105] = $stars;
    $prop[102] = $email;
    $prop[103] = $phone;
    $prop[104] = $PRODUCT_ID;
    $IBLOCK_ID = REVIEWS_IBLOCK_ID;

    $arLoadProductArray = [
        "MODIFIED_BY"       => 1, // admin
        "ACTIVE_FROM"       => date('d.m.Y H:i:s'),
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID"         => $IBLOCK_ID,
        "CODE"              => 'review-' . $PRODUCT_ID . '-' . time(),
        "ACTIVE"            => "N",
        "NAME"              => $name,
        "PREVIEW_TEXT"      => $comment,
        "PROPERTY_VALUES"   => $prop,
    ];

    // Добавляем элемент
    if ($id = $el->Add($arLoadProductArray)) {
        // Отправка служебного сообщения на административный email
        $arEventFields = array(
            'URL' => "/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=$iblock_id&type=site&ID=$id&lang=ru",
        );
        $error = \CEvent::SendImmediate('ADD_REVIEW', SITE_ID, $arEventFields, 'N', 86);

        print json_encode(array(
            'error' => 'N',
            'id' => $id,
            'message' => $messages[0],
        ));
    } else {
        print json_encode(array(
            'error' => 'Y',
            'message' => $el->LAST_ERROR,
        ));
    }
    die();
}
