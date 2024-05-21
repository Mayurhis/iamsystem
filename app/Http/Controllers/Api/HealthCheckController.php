<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\HttpRequestTrait;

class HealthCheckController extends Controller
{
   use HttpRequestTrait;

   public function index(){
        try {
            
            $apiResponse = $this->getRequest('/health');

            $responseData  =[];
            if($apiResponse['status'] == 'success'){

                $timestamp = $apiResponse['data']['timestamp'];
                $date = Carbon::createFromFormat('YmdHis', $timestamp);
                $formattedDate = $date->format('Y-m-d H:i:s');

                $responseData['status'] = 'Success';
                $responseData['Time Stamp'] = $formattedDate;
               
            }

            return response()->json($responseData, 200);
            
        } catch (Exception $e) {
            // dd('Error in HealthCheckController::index (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            \Log::channel('iamsystemlog')->error('Error in HealthCheckController::index (' . $e->getCode() . '): ' . $e->getMessage() . ' at line ' . $e->getLine());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

   
   }
}