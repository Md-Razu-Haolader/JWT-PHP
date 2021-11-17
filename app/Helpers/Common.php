<?php

declare(strict_types=1);

namespace App\Helpers;

class Common
{
    /**
     * load config file
     *
     * @param string $configName
     * @return array
     */
    public function loadConfig(string $configName): array
    {
        $configData = [];
        if (file_exists('app/config/' . $configName . '.php')) {
            $configData = require 'app/config/' . $configName . '.php';
        }
        return $configData;
    }
    /**
     * get api user info by username
     *
     * @param string $userName
     * @return array
     */
    public function getApiUserData(string $userName): array
    {
        $data = [];
        if (file_exists('api_users.json')) {
            $str = file_get_contents('api_users.json');
            $data = json_decode($str, true);
            if (isset($data) && !empty($data) && isset($data[$userName])) {
                $data = $data[$userName];
            }
        }
        return $data;
    }
}
