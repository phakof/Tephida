<?php
/*
 * Copyright (c) 2022 Tephida
 *
 *  For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 *
 */

namespace Mozg\classes;

use Exception;
use FluffyDollop\Support\Filesystem;

class Cache
{

    /**
     * @return void
     */
    public static function mozg_clear_cache(): void
    {
        $folder = '';
        $fdir = opendir(ENGINE_DIR . '/cache/' . $folder);
        while ($file = readdir($fdir)) {
            if ($file !== '.' && $file !== '..' && $file !== '.htaccess' && $file !== 'system' && is_file(ENGINE_DIR . '/cache/' . $file)) {
                Filesystem::delete(ENGINE_DIR . '/cache/' . $file);
            }
        }
    }

    /**
     * @param string $folder
     * @return void
     */
    public static function mozg_clear_cache_folder(string $folder): void
    {
        $fdir = opendir(ENGINE_DIR . '/cache/' . $folder);
        while ($file = readdir($fdir)) {
            if (is_file(ENGINE_DIR . '/cache/' . $folder . '/' . $file)) {
                Filesystem::delete(ENGINE_DIR . '/cache/' . $folder . '/' . $file);
            }
        }
    }

    /**
     * @param string $prefix
     * @return bool
     */
    public static function mozg_clear_cache_file(string $prefix): bool
    {
        if (is_file(ENGINE_DIR . '/cache/' . $prefix . '.tmp')) {
            return Filesystem::delete(ENGINE_DIR . '/cache/' . $prefix . '.tmp');
        }

        return false;
    }

    /**
     * @param string $prefix
     * @return void
     */
    public static function mozg_mass_clear_cache_file(string $prefix): void
    {
        $arr_prefix = explode('|', $prefix);
        foreach ($arr_prefix as $file) {
            if (is_file(ENGINE_DIR . '/cache/' . $file . '.tmp')) {
                Filesystem::delete(ENGINE_DIR . '/cache/' . $file . '.tmp');
            }
        }

    }

    /**
     * @throws Exception
     */
    public static function mozg_create_folder_cache(string $prefix): void
    {
        Filesystem::createDir(ROOT_DIR . '/system/cache/' . $prefix);
    }

    /**
     * @param string $prefix
     * @param mixed $cache_text
     * @return false|int
     */
    public static function mozg_create_cache(string $prefix, mixed $cache_text): false|int
    {
        $filename = ENGINE_DIR . '/cache/' . $prefix . '.tmp';
        return file_put_contents($filename, $cache_text);
    }

    /**
     * @param string $prefix
     * @return false|string|int
     */
    public static function mozg_cache(string $prefix): false|string|int
    {
        $filename = ENGINE_DIR . '/cache/' . $prefix . '.tmp';
        if (file_exists($filename)) {
            return file_get_contents($filename);
        }

        return false;
    }
}