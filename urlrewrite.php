<?php
$arUrlRewrite = array (
    2 =>
        array (
            'CONDITION' => '#^/rest/#',
            'RULE' => '',
            'ID' => NULL,
            'PATH' => '/bitrix/services/rest/index.php',
            'SORT' => 100,
        ),
    4 =>
        array (
            'CONDITION' => '#^/bitrix/services/ymarket/#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/bitrix/services/ymarket/index.php',
            'SORT' => 100,
    ),
    6 =>
        array(
            "CONDITION" => "#^/blog/([^/]+?)/\\??(.*)#",
            'RULE' => 'ELEMENT_CODE=$1&$2',
            "ID" => "bitrix:news",
            "PATH" => "/blog/index.php",
            "SORT" => 100,
        ),
    7 =>
        array (
            'CONDITION' => '#^/blog/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/blog/index.php',
            'SORT' => 100,
        ),
    13 =>
        array (
            'CONDITION' => '#^/store/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog.store',
            'PATH' => '/store/index.php',
            'SORT' => 100,
        ),
    14 =>
        array (
            'CONDITION' => '#^/personal/#',
            'RULE' => '',
            'ID' => 'bitrix:sale.personal.section',
            'PATH' => '/personal/index.php',
            'SORT' => 100,
        ),
    15 =>
        array (
            'CONDITION' => '#^/personal/order/#',
            'RULE' => '',
            'ID' => 'bitrix:sale.personal.order',
            'PATH' => '/personal/order/index.php',
            'SORT' => 100,
        ),
    22 =>
        array (
            'CONDITION' => '#^/catalog/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/catalog/index.php',
            'SORT' => 100,
        ),
    23 =>
        array (
            'CONDITION' => '#^/\\??(.*)#',
            'RULE' => '&$1',
            'ID' => 'bitrix:catalog.section',
            'PATH' => '/index.php',
            'SORT' => 100,
        ),
    24 =>
        array (
            'CONDITION' => '#^\\??(.*)#',
            'RULE' => '&$1',
            'ID' => 'bitrix:catalog.section',
            'PATH' => '/besplatnaya-proverka-zreniya/index.php',
            'SORT' => 100,
        ),

);
