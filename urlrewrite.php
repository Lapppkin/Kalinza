<?php
$arUrlRewrite=array (
  1 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
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
  2 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
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
  8 => 
  array (
    'CONDITION' => '#^/catalog3/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog3/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/catalog5/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/Каталог 4/Каталог 5/index.php',
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
  7 => 
  array (
    'CONDITION' => '#^/catalog4/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/Каталог 4/index.php',
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
  13 => 
  array (
    'CONDITION' => '#^/store/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/store/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/tovar/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/tovar/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^\\??(.*)#',
    'RULE' => '&$1',
    'ID' => 'bitrix:catalog.section',
    'PATH' => '/besplatnaya-proverka-zreniya/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
