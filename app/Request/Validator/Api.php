<?php

declare(strict_types=1);

namespace App\Request\Validator;

use App\Services\JwtLib;
use App\Facades\CommonHelper;

class Api implements BaseValidator
{
    private $jwtLib;
    public function __construct()
    {
        $this->jwtLib = new JwtLib();
    }
    /**
     * check valid api request
     *
     * @param array $headerInfo
     * @return array
     */
    public function validate($headerInfo): array
    {
        $response = ['result' => false, 'msg' => 'Token Data Error, please try with new token!'];

        if (preg_match('/Bearer\s(\S+)/', $headerInfo['Authorization'], $matches) === 1 && isset($matches[1])) {
            $currentTstamp = time();
            $tokenData = $this->jwtLib->decodeToken($matches[1]);
            if ($tokenData['result'] === true) {
                $token = $tokenData['data'];
                $apiUserData = isset($token['username']) && !empty($token['username']) ? CommonHelper::getApiUserData($token['username']) : [];
                if (!empty($apiUserData) && isset($token['iat']) && $token['iat'] <= $currentTstamp && isset($token['exp']) && $token['exp'] >= $currentTstamp) {
                    $response = ['result' => true, 'msg' => 'Api request valid'];
                }
            }
        }
        return $response;
    }
}
