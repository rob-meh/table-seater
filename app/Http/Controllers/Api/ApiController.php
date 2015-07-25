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

    public function respondCreateSuccess($message = "Created new model")
    {
        return $this->setStatusCode(200)->prepareResponse('success',$message);
    }

    public function respondUpdateSuccess($message = "Updated existing model")
    {
        return $this->setStatusCode(200)->prepareResponse('success',$message);
    }

    public function respondDeleteSuccess($message = "Deleted model")
    {
        return $this->setStatusCode(200)->prepareResponse('success',$message);
    }

    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->prepareResponse('error',$message);
    }

    public function respondInvalidData($message = 'Some of the data entered is invalid')
    {
        return $this->setStatusCode(500)->prepareResponse('error',$message);
    }

    public function respondExistingRelationship($message = 'Model already has existing relationship')
    {
        return $this->setStatusCode(500)->prepareResponse('error',$message);
    }


    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }
    
    public function prepareResponse($responseType, $message)
    {
        return $this->respond([
            $responseType=>[
                'message'=>$message,
                'status_code'=> $this->getStatusCode()
            ]
        ]);
    }

}