<?php

namespace App\Traits;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

trait IAMRequestTrait
{
    private function iamApiUrl() {
        return config('constant.IAMSystemApiUrl');
    }

    /**
     * Calls POST using currently logged-in user token.
     * @param $path
     * @param $formData
     * @param $headers
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */

    public function IAMPostRequest($path, $formData, $headers = []): array
    {
        return $this->IAMPostRequestWithAccessToken($path, $formData, $this->getToken(), $headers);
    }

    public function IAMPostRequestWithAccessToken($path, $formData, $accessToken = null, $headers = []): array
    {
        try {
            $url = $this->iamApiUrl() . $path;
            Log::channel('iamsystemlog')->info('IAMPostRequest url = ' . $url);
            $client = new Client();
            $headers = array_merge($headers, [
                'Authorization' => $accessToken == null ? null : 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]);
            $response = $client->request('POST', $url, [
                'json' => $formData,
                'headers' => $headers
            ]);
            $body = $response->getBody()->__toString() ?? '{}';
            $response = ['status' => true, 'code' => 200, 'message' => 'success', 'response' => json_decode($body, true)];
        } catch (ConnectException|ClientException|Exception $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => $this->getIAMError($e->getMessage()), 'data' => []];
            
        }
        Log::channel('iamsystemlog')->info('IAMPostRequestWithAccessToken response = ' . print_r($response, true));
        return $response;
    }

    /**
     * Calls GET using currently logged-in user token.
     * @param $path
     * @param $headers
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function IAMGetRequest($path, $headers = []): array
    {
        return $this->IAMGetRequestWithAccessToken($path, $this->getToken(), $headers);
    }

    public function IAMGetRequestWithAccessToken($path, $accessToken = null, $headers = []): array
    {
        try {
            $url = $this->iamApiUrl() . $path;
            Log::channel('iamsystemlog')->info('IAMGetRequest $url = ' . $url);
            $headers = array_merge($headers, [
                'Authorization' => $accessToken == null ? null : 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ]);
            $client = new Client();
            $response = $client->request('GET', $url, ['headers' => $headers]);
            $body = $response->getBody()->__toString() ?? '{}';
            $response = ['status' => true, 'code' => 200, 'message' => 'successful', 'response' => json_decode($body, true)];
        } catch (ConnectException|ClientException|Exception $e) {
            $response = ['status' => false, 'code' => $e->getCode(), 'message' => $this->getIAMError($e->getMessage()), 'data' => []];
        }
        Log::channel('iamsystemlog')->info('IAMGetRequestWithAccessToken response = ' . print_r($response, true));
        return $response;
    }

    /**
     * Calls PUT using currently logged-in user token.
     * @param $path
     * @param $jsonData
     * @param $headers
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function IAMPutRequest($path, $jsonData, $headers = []): array
    {
        return $this->IAMPutRequestWithAccessToken($path, $jsonData, $this->getToken(), $headers);
    }

    public function IAMPutRequestWithAccessToken($path, $jsonData, $accessToken = null, $headers = []): array
    {
        try {
            $url = $this->iamApiUrl() . $path;
            Log::channel('iamsystemlog')->info('IAMPutRequest $url = ' . $url . ' jsonData = ' . print_r($jsonData, true));
            $headers = array_merge($headers, [
                'Authorization' => $accessToken == null ? null : 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ]);
            $client = new Client();
            $response = $client->request('PUT', $url, [
                'json' => $jsonData,
                'headers' => $headers
            ]);
            $body = $response->getBody()->__toString() ?? '{}';
            $response = ['status' => true, 'code' => 200, 'message' => 'successful', 'response' => json_decode($body, true)];
        } catch (ConnectException|ClientException|Exception $e) {
            $messageString = $e->getMessage();


            //Json available in string
            $jsonError = [];
            $pattern = '/\{(?:[^{}]|(?R))*\}/';
            if (preg_match($pattern, $messageString, $matches)) {
                $json = $matches[0];
                $data = json_decode($json, true);
                $jsonError = $data;
            } 

            $response = ['status' => false, 'code' => $e->getCode(), 'message' => $e->getMessage(), 'data' => [],'json_error'=>$jsonError];
        }
        Log::channel('iamsystemlog')->info('IAMPutRequest result = ' . print_r($response, true));
        return $response;
    }

    /**
     * Extracts IAM error message from IAM response.
     * @param $message
     * @return array|string
     */
    public function getIAMError($message)
    {
        $startIndex = strpos($message, '{');
        $endIndex = strpos($message, '}');
        if ($startIndex && $endIndex) {
            $json = substr($message, $startIndex, $endIndex);
            $decoded = json_decode($json, true);
            Log::channel('iamsystemlog')->info('getIAMError decoded = ' . print_r($decoded, true));
           
            if(isset($decoded['message'])){
                  return $decoded['message'];
            }else if(isset($decoded['data']['message'])){
                   return $decoded['data']['message'];
            }else{
                return [$message];
            }
            
        } else {
            return [$message];
        }
    }

    /**
     * Returns credentials object which can be passed to IAM Login.
     * @param $request
     * @return array
     */
    function getIAMCredentials($request): array
    {
        $credential = $request->input('username');
        $credentialType = filter_var($credential, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $result = [$credentialType => $request->input('username'), 'password' => $request->input('password')];
        return $result;
    }

    /**
     * Returns the token for the currently logged in user, or null if none available.
     * @return string|null
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getToken(): ?string
    {
        return (session()->has('logged_in_user_detail') ? session()->get('logged_in_user_detail')['data']['access_token'] : null);
    }
}
