<?php

namespace Mozg\classes;

use FluffyDollop\Support\Cookie;
use Sinergi\BrowserDetector\Language;

class I18n
{
    public const EN = '1';
    public const RU = '2';

    /**
     * get lang number
     * @return string
     */
    public static function getLang(): string
    {
        $lang_list = self::langList();
        $lang_count = \count($lang_list);
        $lang_Id = (int)(Cookie::get('lang'));
        if ($lang_Id > $lang_count) {
            Cookie::append('lang', self::EN, 365);
            $use_lang = self::EN;
        } elseif (!empty($lang_Id)) {
            $use_lang = $lang_Id;
        } else {
            $language = new Language();
            if ($language->getLanguage() === 'en') {
                Cookie::append('lang', self::EN, 365);
                $use_lang = self::EN;
            } elseif ($language->getLanguage() === 'ru') {
                Cookie::append('lang', self::RU, 365);
                $use_lang = self::RU;
            } else {
                Cookie::append('lang', self::EN, 365);
                $use_lang = self::EN;
            }
        }
        return $lang_list[$use_lang]['key'];
    }

    /**
     * Language dictionary
     * @return array dictionary list
     */
    public static function dictionary(): array
    {
        return require ROOT_DIR . '/lang/' . self::getLang() . '/site.php';
    }

    /**
     * languages list
     * @return array
     */
    public static function langList(): array
    {
        return require ENGINE_DIR . '/data/langs.php';
    }
}