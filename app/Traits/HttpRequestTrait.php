<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;

trait HttpRequestTrait
{
    public $apiUrl;

    public function getIAMCredentials($request): array
    {
        $credential = $request->input('username');
        $credentialType = filter_var($credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $result = [$credentialType => $request->input('username'), 'password' => $request->input('password')];
        return $result;
    }
    
    public function getApiUrl()
    {
        $this->apiUrl = config('constant.IAMSystemApiUrl');
        Log::channel('iamsystemlog')->info('API_BASE_URL = ' . $this->apiUrl);
        return $this->apiUrl;
    }

    public function getRequest($url, $params = '')
    {
        try {
            $headers = $this->getidFoxHeaders("get");
            $client = new Client([
                'verify' => false,
                'handler' => $this->createLoggingHandlerStack()
            ]);
            $url = $this->getApiUrl() . $url;
            if ($params != "") {
                $url = $url . "?" . $params;
            }
        
            $response = $client->request('GET', $url, [
                'headers' => $headers,
            ]);

            $body = $response->getBody()->__toString();
            return json_decode($body, true);
        } catch (ConnectException $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'data' => []];
        } catch (ClientException $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody()), 'data' => []];
        } catch (\Exception $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
        // return response()->json($response);
        return $response;

    }


    public function postRequest($url, $body = null, $params = "", $formType = '', $formData = '')
    {
        try {
            $headers = $this->getidFoxHeaders("post");
            if ($formType !== 'multipart') {
                $headers['Content-Type'] = 'application/json';
            }

            $url = $this->getApiUrl() . $url;
            $client = new Client([
                'handler' => $this->createLoggingHandlerStack()
            ]);

            $response = $client->request('POST', $url, [
                $formType => $formData,
                'headers' => $headers,
            ]);
            $body = $response->getBody()->__toString();
            return json_decode($body, true);
        } catch (ConnectException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'data' => []];
        } catch (ClientException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody()), 'data' => []];
        } catch (\Exception $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }catch (\Throwable $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
        } 
        return $result;
    }

    public function patchRequest($url, $body = null, $params = "", $formType = '', $formData = '')
    {
        try {
            $headers = $this->getidFoxHeaders("patch");
            if ($formType !== 'multipart') {
                $headers['Content-Type'] = 'application/json';
            }
            $url = $this->getApiUrl() . $url;
            $client = new Client([
                'handler' => $this->createLoggingHandlerStack()
            ]);
            $response = $client->request('PATCH', $url, [
                $formType => $formData,
                'headers' => $headers,
            ]);
            $body = $response->getBody()->__toString();
            return json_decode($body, true);
        } catch (ConnectException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody()), 'data' => []];
        } catch (ClientException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody()), 'data' => []];
        } catch (\Exception $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
        return $result;
    }

    public function deleteRequest($url)
    {
        try {
            $client = new Client([
                'verify' => false,
                'handler' => $this->createLoggingHandlerStack()
            ]);
            $url = $this->getApiUrl() . $url;
            $headers = $this->getidFoxHeaders("delete");
            $response = $client->request('DELETE', $url, [
                'headers' => $headers,
            ]);
            $body = $response->getBody()->__toString();
            return json_decode($body, true);
        } catch (ConnectException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody()), 'data' => []];
        } catch (ClientException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody()), 'data' => []];
        } catch (\Exception $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
        return $result;
    }

    public function IAMGetRequest($url)
    {
        try {
          
            $loggedInUserDetails = session()->get('logged_in_user_detail');

            $headers = [
                'Authorization' => 'Bearer ' . $loggedInUserDetails['data']['access_token'],
                'Content-Type' => 'application/json'
            ];

            $client = new Client([
                'handler' => $this->createLoggingHandlerStack()
            ]);
            $response = $client->request('GET', $url, ['headers' => $headers]);
            $body = $response->getBody()->__toString();
            Log::channel('iamsystemlog')->info('Request to ' . $url . ' succeeded');
            $result = ['status' => true, 'code' => 200, 'message' => 'Logout successfully', 'response' => json_decode($body, true)];
            return $result;
        } catch (ConnectException $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'data' => []];
        } catch (ClientException $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody()), 'data' => []];
        } catch (\Exception $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
        Log::channel('iamsystemlog')->info('Request to ' . $url . ' failed');
       
        return $response;
    }

    public function IAMPostRequest($url, $formData)
    {
        try {
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ];
            $client = new Client([
                'handler' => $this->createLoggingHandlerStack()
            ]);
            $response = $client->request('POST', $url, [
                'json' => $formData,
                'headers' => $headers,
            ]);
            $body = $response->getBody()->__toString();
            Log::channel('iamsystemlog')->info('IAMPostRequest body: ' . $body);
            $result = ['status' => true, 'code' => 200, 'message' => 'Successful', 'response' => json_decode($body, true)];
            return $result;
        } catch (ConnectException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'data' => []];
        } catch (ClientException $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => json_decode($e->getResponse()->getBody(), true), 'data' => []];
        } catch (\Exception $e) {
            $result = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
 
        return $result;
    }

    private function  getidFoxHeaders($requestType){
        $headers = [
            'accept' => 'application/json',
            'content-type'=>'application/json',
        ];
        if ($requestType != "get") {
            $headers ['accepted-lang'] = app()->getLocale();
        }
        if (session()->has('logged_in_user_detail')) {
            $loggedInUserDetails = session()->get('logged_in_user_detail');
            $secretToken = $loggedInUserDetails['data']['access_token'];
            $headers['Authorization'] = 'Bearer ' . $secretToken;
        }
        return $headers;
    }

    // For HTTP logging, see https://betterprogramming.pub/how-to-log-guzzle-requests-fbc16c99a8fd
    private function createLoggingHandlerStack(): HandlerStack
    {
        $messageFormats = [
            '{method} : {target}',
            '{code} : {response}'
        ];
        $stack = HandlerStack::create();
        collect($messageFormats)->each(function ($messageFormat) use ($stack) {
            // We'll use unshift instead of push, to add the middleware to the bottom of the stack, not the top
            $stack->unshift(
                Middleware::log(
                    Log::channel('iamsystemlog'),
                    new MessageFormatter($messageFormat)
                ));
        });
        return $stack;
    }
}
