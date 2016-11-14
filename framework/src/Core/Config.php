<?php
declare(strict_types = 1);

namespace Core;

class Config
{
    private static $fileConfig = 'config.ini';
    private static $configData = null;

    private function __construct()
    {
    }

    public static function getOption($key)
    {
        if (!self::$configData) {
            self::loadConfigFile();
        }
        if (isset(self::$configData[$key])) {
            return self::$configData[$key];
        }
        return null;
    }

    private static function loadConfigFile()
    {
        $file = FRAMEWORK_CONFIG_PATH . self::$fileConfig;
        if (!file_exists($file)) {
            throw new \Exception('Create config.ini file - copy form config.ini.sample!');
        }
        try {
            $data = parse_ini_file($file);
            self::$configData = $data;
            return $data;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
