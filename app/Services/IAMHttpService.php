<?php

namespace App\Services;

use App\Traits\IAMRequestTrait;
use Exception;

class IAMHttpService
{
    use IAMRequestTrait;

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

        return $this->IAMPutRequestWithAccessToken('/user/' . $userId . '/password', $jsonData, config('constant.IAMSystemToken'));
    }

    public function adminFindUserByEmail($email): array
    {
        return $this->IAMGetRequestWithAccessToken('/user/email/' . $email, config('constant.IAMSystemToken'));
    }

    public function adminCreateUser($formData): array
    {
        return $this->IAMPostRequestWithAccessToken('/users', $formData, config('constant.IAMSystemToken'));
    }
}
