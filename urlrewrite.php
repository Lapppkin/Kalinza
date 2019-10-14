<?php
$arUrlRewrite=array (
    10 =>
        array (
            'CONDITION' => '#^/bitrix/services/ymarket/#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/bitrix/services/ymarket/index.php',
            'SORT' => 100,
        ),
    20 =>
        array(
            "CONDITION" => "#^/blog/([^/]+?)/\\??(.*)#",
            'RULE' => 'ELEMENT_CODE=$1&$2',
            "ID" => "bitrix:news",
            "PATH" => "/blog/index.php",
            "SORT" => 100,
        ),
    30 =>
        array (
            'CONDITION' => '#^/personal/order/#',
            'RULE' => '',
            'ID' => 'bitrix:sale.personal.order',
            'PATH' => '/personal/order/index.php',
            'SORT' => 100,
        ),
    40 =>
        array (
            'CONDITION' => '#^/personal/#',
            'RULE' => '',
            'ID' => 'bitrix:sale.personal.section',
            'PATH' => '/personal/index.php',
            'SORT' => 100,
        ),
    50 =>
        array (
            'CONDITION' => '#^/catalog/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/catalog/index.php',
            'SORT' => 100,
        ),
    60 =>
        array (
            'CONDITION' => '#^/\\??(.*)#',
            'RULE' => '&$1',
            'ID' => 'bitrix:catalog.section',
            'PATH' => '/index.php',
            'SORT' => 100,
        ),
    70 =>
        array (
            'CONDITION' => '#^/store/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog.store',
            'PATH' => '/store/index.php',
            'SORT' => 100,
        ),
    80 =>
        array (
            'CONDITION' => '#^/tovar/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/tovar/index.php',
            'SORT' => 100,
        ),
    90 =>
        array (
            'CONDITION' => '#^\\??(.*)#',
            'RULE' => '&$1',
            'ID' => 'bitrix:catalog.section',
            'PATH' => '/besplatnaya-proverka-zreniya/index.php',
            'SORT' => 100,
        ),
    100 =>
        array (
            'CONDITION' => '#^/news/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/news/index.php',
            'SORT' => 100,
        ),
    110 =>
        array (
            'CONDITION' => '#^/rest/#',
            'RULE' => '',
            'ID' => NULL,
            'PATH' => '/bitrix/services/rest/index.php',
            'SORT' => 100,
        ),
);
