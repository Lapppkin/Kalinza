<?php

use Bitrix\Main\EventManager;
use Deadie\Helper;

\define('BX_CUSTOM_TO_UPPER_FUNC', 'mb_strtoupper');
\define('BX_CUSTOM_TO_LOWER_FUNC', 'mb_strtolower');

require \dirname(__DIR__, 2) . '/vendor/autoload.php';

\Dotenv\Dotenv::create(\dirname(__DIR__, 2), '.env')->load();

\CModule::IncludeModule('iblock');

\AddEventHandler('main', 'OnEpilog', [\core\EventHandler::class, 'Check404Error'], 1);

\define('ROOT', $_SERVER['DOCUMENT_ROOT']);
\define('ERROR_500', '500 Internal Server Error');
\define('INCLUDE_DIR', ROOT . '/local/php_interface/include/');


### CLASSES LOADER ###

/**
 * @param $classes
 * @param bool $validators
 */
function kalinzaAutoLoader($classes, $validators = false) {
    foreach ($classes as $class) {
        if (!$validators) {
            // Подключение основного класса
            try {
                if (!file_exists(INCLUDE_DIR . "$class.php")) {
                    throw new Exception();
                }
            } catch (Exception $e) {
                ShowError('One of template classes not loaded! Please contact the site administrator to resolve the error.');
                LocalRedirect('/', false, ERROR_500);
            }
            require_once(INCLUDE_DIR . "$class.php");
        } else {
            // Подключение валидатора
            include_once(INCLUDE_DIR . "$class.php");
            // Подключение событий валидатора
            $namespace = str_replace(DIRECTORY_SEPARATOR, '\\', "/Deadie/$class");
            EventManager::getInstance()->addEventHandlerCompatible(
                'form',
                'onFormValidatorBuildList',
                array($namespace, 'getDescription')
            );
        }

    }
}

// Основные классы
$classes = array(
    'Helper',
    //'EventHandler',
    // Интерфейсы
    //'Interfaces/ValidatorInterface',
    // Абстрактные классы
    //'Validators/Validator',
    // Трейты
);
kalinzaAutoLoader($classes);

// Валидаторы
$validators = array(
    //'Validators/StringEmpty',
    //'Validators/Email',
);
kalinzaAutoLoader($validators, true);


### FUNCTION WRAPPERS ###

// Глобальные обертки для необходимых функций

function dump($value, $public = false) {
    Helper::dump($value, $public);
}

function dd($value, $public = false) {
    Helper::dd($value, $public);
}

function renderIcon(string $name, string $class = '') {
    return Helper::renderIcon($name, $class);
}
