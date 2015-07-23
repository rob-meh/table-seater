<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
class ApiController extends Controller
{
    protected $statusCode =200;

    public function getStatusCode()
    {
        return $this->statusCode ;
    }


    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }


    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondInvalidData($message = 'Some of the data entered is invalid')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }


    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }
    

    public function respondWithError($message)
    {
        return $this->respond([
            'error'=>[
                'message'=>$message,
                'status_code'=> $this->getStatusCode()
            ]
        ]);
    }
}