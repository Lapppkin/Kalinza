<?

namespace core;

/**
 * Class Helper
 * @package core
 */
final class Helper
{

    // запрет создания и копирования статического объекта класса
    private function __construct() {}
    private function __clone() {}

    /**
     * Beautify Var Dumper.
     *
     * @param $arr
     */
    protected static function varDumper($arr): void {
        echo '<pre style="font-size:13px;text-align:left;">';
        var_dump($arr);
        echo '</pre>';
    }


    /**
     * Dumper.
     *
     * @param $arr
     * @param bool $public
     */
    public static function dump($arr, $public = FALSE): void {
        if ($public) {
            self::varDumper($arr);
        } else {
            global $USER;
            if ($USER->IsAdmin()) {
                self::varDumper($arr);
            }
        }
    }

    /**
     * Dump & die.
     *
     * @param $arr
     * @param bool $public
     */
    public static function dd($arr, $public = FALSE): void {
        self::dump($arr, $public);
        die();
    }


    /**
     * Обрезка строки (мультибайтовая).
     *
     * @param $str
     * @param $length
     * @param string $postfix
     * @param string $encoding
     *
     * @return string
     */
    public static function mbCutString(
        string $str,
        int $length,
        $postfix = '...',
        $encoding = 'UTF-8'
    ) {
        if (mb_strlen($str, $encoding) <= $length) {
            return $str;
        }
        $tmp = mb_substr($str, 0, $length, $encoding);

        return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding),
                $encoding) . $postfix;
    }


    /**
     * Словоформы для различных языков.
     *
     * @param $n
     * @param bool $returnFalseForUnknown
     *
     * @return bool|int
     */
    public static function getPluralForm(int $n, $returnFalseForUnknown = FALSE) {
        $n = abs($n);
        if ( ! defined('LANGUAGE_ID')) {
            return (FALSE);
        }
        // info at http://docs.translatehouse.org/projects/localization-guide/en/latest/l10n/pluralforms.html?id=l10n/pluralforms
        switch (LANGUAGE_ID) {
            case 'de':
            case 'en':
                $plural = (int)($n !== 1);
                break;
            case 'ru':
            case 'ua':
                $plural = (($n % 10 === 1) && ($n % 100 !== 11))
                    ? 0
                    : ($n % 10 >= 2) && ($n % 10 <= 4) && (($n % 100 < 10) || ($n % 100 >= 20)) ? 1 : 2;
                break;
            default:
                if ($returnFalseForUnknown) {
                    $plural = FALSE;
                } else {
                    $plural = (int)($n !== 1);
                }
                break;
        }

        return $plural;
    }

    /**
     * Auto copyrights.
     *
     * @param int $year
     *
     * @return false|string
     */
    public static function autoCopyright(int $year) {
        $years = $year;
        $current_year = date('Y');
        if ($year === $current_year) {
            $years = $year;
        }
        if ($year < $current_year) {
            $years = $year . '–' . $current_year;
        }
        if ($year > $current_year) {
            $years = $current_year;
        }
        return $years;
    }

    /**
     * Парсинг телефонного номера и вывод в различных форматах.
     *
     * @param string $number
     * @param string $format
     * @param string $class
     * @return array|mixed|string
     */
    public static function parsePhone(string $number, string $format = 'default', string $class = '') {
        $number = trim($number);
        $result = explode(' ', $number, 3);

        $full = str_replace(['-', '(', ')', ' ', '&nbsp;'], '', $result[0] . $result[1] . $result[2]);
        $left_bracket = ((int) $result[1] === 800) ? '' : '(';
        $right_bracket = ((int) $result[1] === 800) ? '' : ')';

        $html = "<span class='country'>{$result[0]}</span>&nbsp;<span class='code'>{$left_bracket}{$result[1]}{$right_bracket}</span>&nbsp;<span class='number'>{$result[2]}</span>";

        switch ($format) {
            case 'formatted':
                return $result[0] . '&nbsp;' . $result[1] . '&nbsp;' . $result[2];
            case 'full':
                return $full;
            case 'html':
                return $html;
            case 'link':
                $link_class = $class ? " class='$class'" : '';
                return "<a $link_class href='tel:$full'>$html</a>";
            default:
                return array(
                    'country' => $result[0],
                    'code' => $result[1],
                    'number' => $result[2],
                );
        }
    }


    /**
     * Рендер иконки.
     *
     * @param string $name Icon name
     * @param string $class
     * @return string
     */
    public static function renderIcon(string $name, string $class = ''): string {
        return self::checkIE()
            ? "<span class=\"kalinza-i kalinza-i-{$name} {$class}\"></span>"
            : "<svg class=\"kalinza-icon kalinza-{$name} {$class}\"><use xlink:href=\"#{$name}\"></use></svg>";
    }

    /**
     * Ресайз изображений.
     *
     * @param $image
     * @param bool $noimage
     * @param int $width
     * @param int $height
     * @param int $method
     * @param int $quality
     *
     * @return mixed|string
     */
    public static function resizeProductImage($image, $noimage = true, int $width = 333, int $height = 348, $method = BX_RESIZE_IMAGE_EXACT, int $quality = 90) {
        global $config;
        return ($image) ?? $image['SRC'] ? CFile::ResizeImageGet($image['ID'], ['width' => $width, 'height' => $height], $method, true, false, false, $quality) : (($noimage) ? array('src' => SITE_TEMPLATE_PATH . '/images/noimage_preview.jpg', 'alt' => $config->site()->site_name, 'noimage' => true) : false);
    }

    /**
     * Транслитерация названия в символьный код.
     * @deprecated Перенесен в класс EventHandler
     *
     * @param $arFields
     */
    public static function slugTranslit(&$arFields): void {
        // If name is filled and machine_name is empty
        if (strlen($arFields['NAME']) > 0 && strlen($arFields['CODE']) <= 0) {
            $arParams = array(
                "max_len" => 100,
                "change_case" => 'L', // 'L' - toLower, 'U' - toUpper, false - do not change
                "replace_space" => '_',
                "replace_other" => '_',
                "delete_repeat_replace" => true
            );
            if (isset($arFields['PROPERTY_VALUES'][9])) {
                $arFields["CODE"] = array_shift($arFields['PROPERTY_VALUES'][9])['VALUE'] . '_' . \CUtil::translit($arFields["NAME"], "ru", $arParams);
            }
        }
    }

    /**
     * Check Internet Explorer 8 (IE8) and below user browser.
     *
     * @return bool
     */
    public static function checkIE(): bool {
        return (
            (preg_match('/MSIE\s(?P<v>\d+)/i', @$_SERVER['HTTP_USER_AGENT'], $B)
             && $B['v'] <= 8)
            || strpos(@$_SERVER['HTTP_USER_AGENT'], 'Trident')
        );
    }

    /**
     * Parse, check and return matched Youtube link.
     *
     * @param string $link
     * @return object
     */
    public static function parseYoutubeLink(string $link) {
        preg_match('#(?:[hH][tT]{2}[pP][sS]{0,1}:\/\/)?[wW]{0,3}\.{0,1}[yY][oO][uU][tT][uU](?:\.[bB][eE]|[bB][eE]\.[cC][oO][mM])?\/(?:(?:[wW][aA][tT][cC][hH])?(?:\/)?\?(?:.*)?[vV]=([a-zA-Z0-9--]+).*|([A-Za-z0-9--]+))#', $link, $matches);
        return (object) array(
            'link' => $matches[0],
            'id' => $matches[1],
        );
    }

    /**
     * Установка класса для тега body для различных типов страниц.
     *
     * @param $APPLICATION
     *
     * @return string
     */
    public static function setBodyClass($APPLICATION) {
        if (
            $APPLICATION->GetCurPage(FALSE) === '/'
            || $APPLICATION->GetCurPage(FALSE) === '/' . LANGUAGE_ID . '/'
        ) return 'index';
        elseif (
            $APPLICATION->GetCurPage(FALSE) === '/catalog/'
            || $APPLICATION->GetCurPage(FALSE) === '/' . LANGUAGE_ID . '/catalog/'
        ) return 'catalog_index';
        elseif (\CSite::InDir('/catalog/')) return 'catalog';
        return 'inner';
    }

}
