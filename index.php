<?php

declare(strict_types=1);

if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

$headerReq = apache_request_headers();

use App\Services\Api;
use App\Services\Auth;
use App\Request\Validator\Api as ApiValidator;

if (isset($headerReq['requestType']) && !empty($headerReq['requestType'] && $headerReq['requestType']) && !empty($headerReq['requestType'])) {
    $methodName = $headerReq['requestType'];
    if ($methodName === 'login') {
        $authService = new Auth();
        echo $authService->login();
    } else {
        $apiService = new Api(new ApiValidator);
        echo $apiService->$methodName();
    }
}
