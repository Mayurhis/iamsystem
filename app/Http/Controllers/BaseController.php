<?php

namespace App\Http\Controllers;

use App\Traits\HttpRequestTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response as IlluminateResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Base API Controller.
 */
class BaseController extends Controller
{
    use HttpRequestTrait;
    
    /**
     * default status code.
     *
     * @var int
     */
    protected $statusCode = 200;

    /**
     * get the status code.
     *
     * @return statuscode
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * set the status code.
     *
     * @param [type] $statusCode [description]
     *
     * @return statuscode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Respond.
     *
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return response()->json(
            $data,
            $this->getStatusCode(),
            $headers);
    }


    /**Note this function is same as the below function but instead of responding with error below function returns error json
     * Throw Validation.
     *
     * @param string $message
     *
     * @return mix
     */
    public function throwValidation($message)
    {
        return $this->setStatusCode(422)
            ->respondWithError($message);
    }

    
    /**
     * Respond Created.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondCreated($data)
    {
        $data = array_merge(['status_code' => Response::HTTP_OK],$data);
        return $this->respond($data);
    }
    

    /**
     * Respond Created.
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondOk($data)
    {
        $data = array_merge(['status_code' => Response::HTTP_OK],$data);
        return $this->respond($data);
    }

    /**
     * respond with error.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'status' => false,
            'status_code' => $this->getStatusCode(),
            'error' => [
                'message'     => $message
            ]
        ]);
    }
    
    
    /**
     * Get the language value from header
     *
     * @param $message
     *
     */
    public function getLanguage()
    {
        if(request()->header('language') && in_array(request()->header('language'), config('constant.language'))){
            return request()->header('language');
        }
        return false;
    }   

    
    /**
     * Send a success response.
     *
     * @param  string|array $data
     * @param  int          $statusCode
     * @return \Illuminate\Http\Response
     */
    protected function sendSuccessResponse($message, $data=[], $statusCode = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Send an error response.
     *
     * @param  string|array $message
     * @param  int          $statusCode
     * @return \Illuminate\Http\Response
     */
    protected function sendErrorResponse($message, $statusCode = Response::HTTP_BAD_REQUEST,  $error_type='something_error', $errors=[])
    {
        if ($statusCode == Response::HTTP_UNPROCESSABLE_ENTITY) {
            return response()->json([
                'success' => false,
                'error_type' => $error_type,
                'errors' => $errors,
            ], $statusCode);
        } else {
            return response()->json([
                'success' => false,
                'error_type' => $error_type,
                'error' => $message,
            ], $statusCode);
        }
    }

}