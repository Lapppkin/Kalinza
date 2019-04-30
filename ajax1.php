<?php
	$msg_box .= "123";
    $errors = array(); // контейнер для ошибок
    // проверяем корректность полей
    if($_POST['user_name'] == "")    $errors[] = "Поле 'Ваше имя' не заполнено!";
    if($_POST['user_email'] == "")   $errors[] = "Поле 'Ваш e-mail' не заполнено!";
 
    // если форма без ошибок
    if(empty($errors)){     
        // собираем данные из формы
        $msg_box  = "Имя пользователя: " . $_POST['user_name'] . "<br/>";
        $msg_box .= "E-mail пользователя: " . $_POST['user_email'] . "<br/>"; 
    }else{
        // если были ошибки, то выводим их
        foreach($errors as $one_error){
            $msg_box .= "<span style='color: red;'>$one_error</span><br/>";
        }
    }
 
    // делаем ответ на клиентскую часть в формате JSON
    echo json_encode(array(
        'result' => $msg_box
    ));

$productId = $_POST['user_name'];

if (!\Bitrix\Main\Loader::includeModule('catalog')) {
    throw new \Bitrix\Main\SystemException('Ошибка подключения модуля "catalog"');
}

$addResult = Add2BasketByProductID(
    $productId, 
    1, 
    [
        'LID' => 's1',
    ], 
    []
);

if (!$addResult) {

    $strError = '';

    /** @global $APPLICATION $ex */
    if ($ex = $APPLICATION->GetException()) {
        $strError = $ex->GetString();
    }

    echo sprintf('Ошибка добавления товара %s в корзину: %s', $productId, $strError);

} else {

    echo sprintf('Товар %s успешно добавлен в корзину', $productId);
	//LocalRedirect("/personal/cart/");

}
?>