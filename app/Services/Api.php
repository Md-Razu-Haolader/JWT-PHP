<?php

declare(strict_types=1);

namespace App\Services;

use App\Request\Http\CurlHandler;
use App\Request\Validator\BaseValidator;

class Api
{
    private $curlHandler;
    private $headerReq;
    /**
     * class constructor
     *
     * @param BaseValidator $ApiValidator
     */
    public function __construct(BaseValidator $ApiValidator)
    {
        $this->curlHandler = new CurlHandler();
        $this->headerReq = apache_request_headers();
        $validate = $ApiValidator->validate($this->headerReq);
        if ($validate['result'] !== true) {
            echo json_encode($validate);
            exit;
        }
    }
    /**
     * get post data
     *
     * @return void
     */
    public function getPost()
    {
        $apiUrl = 'https://jsonplaceholder.typicode.com/posts';
        return $this->curlHandler->getRequest($apiUrl);
    }
}
