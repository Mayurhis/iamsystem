<?php

namespace App\Services;

use App\Traits\IAMRequestTrait;
use Exception;

class IAMHttpService
{
    use IAMRequestTrait;

    public function checkLoginRequestCredentials($request){
        return $this->getIAMCredentials($request);
    }

    public function login($credentials): array
    {
        return $this->IAMPostRequestWithAccessToken('/login', $credentials);
    }

    public function logout(): array
    {
        return $this->IAMGetRequest('/logout');
    }

    public function getRefreshAccessToken($accessToken, $refreshToken): array
    {
        return $this->IAMGetRequestWithAccessToken('/refresh/' . $refreshToken, $accessToken);
    }

    public function signup($data): array
    {
        return $this->IAMPostRequestWithAccessToken('/signup', $data);
    }

    public function me(): array
    {
        return $this->IAMGetRequest('/users/me');
    }

    public function adminChangePassword($jsonData, $userId = null)
    {
        if (!$userId) {
            $loggedInUserDetails = session()->has('logged_in_user_detail') ? session()->get('logged_in_user_detail') : null;
            if (!$loggedInUserDetails) {
                throw new Exception('Not logged in!');
            }
            $userId = isset($loggedInUserDetails['data']['user_id']) ? $loggedInUserDetails['data']['user_id'] : null;
            if (!$userId) {
                throw new Exception('No user id!');
            }
        }

        return $this->IAMPutRequest('/user/' . $userId . '/password', $jsonData);
    }

    public function adminFindUserByEmail($email): array
    {
        return $this->IAMGetRequest('/user/email/' . $email);
    }

    public function adminFindUserById($userId): array
    {
        return $this->IAMGetRequest('/user/' . $userId);
    }

    public function adminCreateUser($formData): array
    {
        return $this->IAMPostRequest('/users', $formData);
    }

    public function adminUpdateUser($userId,$formData): array
    {
        $apiUrl = '/user/'.$userId;
        return $this->IAMPutRequest($apiUrl, $formData);
    }

    public function adminUpdateUserMetadata($userId,$formData): array
    {
        $apiUrl = '/user/'.$userId.'/metadata/wallets';
        return $this->IAMPutRequest($apiUrl ,$formData);
    }

    public function adminUpdateUserRole($userId,$roleName): array
    {
        $apiUrl = '/user/'.$userId.'/roles/'.$roleName;
        return $this->IAMPutRequest($apiUrl ,$roleName);
    }

    public function adminUpdateUserStatus($userId,$status): array
    {
        $apiUrl = '/user/'.$userId.'/status/'.$status;
        return $this->IAMPutRequest($apiUrl ,$status);
    }

    public function adminUpdateUserPassword($userId,$updatePassword): array
    {
        $apiUrl = '/user/'.$userId.'/password/';
        return $this->IAMPutRequest($apiUrl ,$updatePassword);
    }

    public function adminUserForcelogout($userId): array
    {
        $apiUrl = '/logout/'.$userId;
        return $this->IAMGetRequest($apiUrl);
    }

    public function adminUserList($paramters=[]): array{
        $queryString = count($paramters) > 0 ? '?'.http_build_query($paramters) : '';
      
        $apiUrl = '/users'.$queryString;
      
        return $this->IAMGetRequest($apiUrl);
    }
}
