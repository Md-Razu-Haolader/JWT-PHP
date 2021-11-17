<?php
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

use App\Request\Http\CurlHandler;

$curlHandler = new CurlHandler();

$consumerKey = 'qE9EDHEe4y8523nRTgArkfz23fPga';
$consumerSecret = 'u_HzU0OsX4RCQNTj6AyrmvoiqWhUa';
$authCode = base64_encode($consumerKey . ':' . $consumerSecret);

$apiUrl = 'http://192.168.10.61:81/test-app/';
$loginHeader = [
    'requestType: login',
    'Authorization: Basic ' . $authCode,
    'Content-Type: application/json'
];
$loginPostData = '{
    "username":"admin",
    "password":"12345678"
}';

$loginResponse = $curlHandler->postRequest($apiUrl, $loginHeader, $loginPostData);
$loginData = json_decode((string) $loginResponse, true);
echo "<pre>";
var_dump($loginData['token']);

if (isset($loginData['token']) && !empty($loginData['token'])) {
    $postHeader = [
        'requestType: getPost',
        'Authorization: Bearer ' . $loginData['token'],
        'Content-Type: application/json'
    ];

    $response = $curlHandler->getRequest($apiUrl, $postHeader);
    $data = json_decode((string) $response, true);
    var_dump($data);
}
