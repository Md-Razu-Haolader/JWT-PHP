<?php

declare(strict_types=1);

namespace App\Services;

use Firebase\JWT\JWT;
use App\Facades\CommonHelper;

class JwtLib
{
    private $secretKey;
    private $encAlg;
    private $commonConfig;

    public function __construct()
    {
        $this->commonConfig = CommonHelper::loadConfig('common');
        $this->secretKey = $this->commonConfig['JWT_SECRET_KEY'];
        $this->encAlg = $this->commonConfig['JWT_ENCRYPT_ALG'];
    }
    /**
     * encode jwt token
     *
     * @param array $payload
     * @return array
     */
    public function encodeToken(array $payload): array
    {

        try {
            $result = [
                'result' => true,
                'msg' => 'Token encode successfull',
                'tokenData' => JWT::encode($payload, $this->secretKey)
            ];
        } catch (\Exception $exception) {
            $result = [
                'result' => false,
                'msg' => 'Token encode failed'
            ];
        }
        return $result;
    }
    /**
     * decode jwt token
     *
     * @param string $jwt
     * @return array
     */
    public function decodeToken(string $jwt): array
    {
        try {
            $result = [
                'result' => true,
                'msg' => 'Token decode successfull',
                'data' => (array) JWT::decode($jwt, $this->secretKey, [$this->encAlg])
            ];
        } catch (\Exception $exception) {
            $result = [
                'result' => false,
                'msg' => 'Token decode failed',
                'data' => []
            ];
        }
        return $result;
    }
}
