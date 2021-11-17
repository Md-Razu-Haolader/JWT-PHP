<?php

declare(strict_types=1);

namespace App\Services;

use App\Facades\CommonHelper;
use App\Services\JwtLib;

class Auth
{
    private $commonConfig;
    private $headerReq;
    private $jwtLib;

    public function __construct()
    {
        $this->commonConfig = CommonHelper::loadConfig('common');
        $this->headerReq = apache_request_headers();
        $this->jwtLib = new JwtLib();
    }
    /**
     * login user for API access
     *
     * @return string
     */
    public function login(): string
    {
        $response = ['result' => false, 'msg' => 'Login failed!'];
        if (preg_match('/Basic\s(\S+)/', $this->headerReq['Authorization'], $matches) === 1 && isset($matches[1])) { 
            $inputData = file_get_contents("php://input");
            $request = json_decode($inputData);
            $userName = isset($request->username) && !empty($request->username) ? $request->username : '';
            $password = isset($request->password) && !empty($request->password) ? md5($request->password) : '';
            
            $apiUserData = CommonHelper::getApiUserData($userName);
            if (
                isset($apiUserData['password']) && !empty($apiUserData['password']) && $apiUserData['password'] === $password
                && isset($apiUserData['consumersecret']) && !empty($apiUserData['consumersecret'])
                && isset($apiUserData['consumerkey']) && !empty($apiUserData['consumerkey'])
                && base64_encode($apiUserData['consumerkey'] . ":" . $apiUserData['consumersecret']) === $matches[1]
            ) {
                $payload = [
                    "iss" => $request->username,
                    "aud" => "http://google.com",
                    "username" => $request->username,
                    "iat" => time(),
                    "exp" => time() + $this->commonConfig['API_EXPIRE_TIME']
                ];
                $tokenData = $this->jwtLib->encodeToken($payload);
                $token = '';
                if ($tokenData['result'] === true && isset($tokenData['tokenData']) && !empty($tokenData['tokenData'])) {
                    $token = $tokenData['tokenData'];
                }
                $response = ['result' => true, 'msg' => 'Login successfull!', 'token' => $token];
            }
        }
        return json_encode($response);
    }
}
