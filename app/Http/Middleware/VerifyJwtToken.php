<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Log;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\HasClaimWithValue;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\StrictValidAt;

/**
 * VerifyJwtToken is a class which verifies that an incoming request has a valid IAM Server token.
 */
class VerifyJwtToken
{
    /**
     * The constructor initialises the configuration singleton which will be used to verify every IAM token.
     */
    private function getConfiguration($userType): Configuration
    {
        $configuration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText(config('constant.IAMSystemSecret'))
        );
        $configuration->setValidationConstraints(
            new IssuedBy(config('constant.IAMSystemIssuer')),
            new StrictValidAt(SystemClock::fromUTC()),
            new HasClaimWithValue('type', $userType),
        );

        return $configuration;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $accessToken = null;
            $userType = null;

            if($request->session()->get('logged_in_user_detail')) {

                if(isset($request->session()->get('logged_in_user_detail')['data'])) {

                    if(isset($request->session()->get('logged_in_user_detail')['data']['access_token'])) {

                        $accessToken = $request->session()->get('logged_in_user_detail')['data']['access_token'];

                        if(isset($request->session()->get('logged_in_user_detail')['data']['user'])){

                            if(isset($request->session()->get('logged_in_user_detail')['data']['user']['type'])){
                               $userType = $request->session()->get('logged_in_user_detail')['data']['user']['type'];
                               $userType = in_array($userType,config('constant.user_roles')) ? $userType : null;
                            }

                        }

                    }
                }
            }else{
                return redirect()->route('admin.login');
            }

            if (!$accessToken) {
                Log::channel('iamsystemlog')->info('VerifyJwtToken with token: ' . $accessToken);
                if($request->ajax()){
                    return response()->json(['error' => 'Unauthorized'], 401);
                }else{
                    return abort(401);
                }
            }

            Log::channel('iamsystemlog')->info('VerifyJwtToken with token: ' . $accessToken);

            $config = $this->getConfiguration($userType);
            $token = $config->parser()->parse($accessToken);
            $config->validator()->assert($token, ...$config->validationConstraints());

            return $next($request);

        } catch (Exception $e) {
            Log::channel('iamsystemlog')->error('VerifyJwtToken token error: ' . $e->getMessage());

            if($request->ajax()){
                return response()->json(['error' => 'Unauthorized','message'=>$e->getMessage()], 401);
            }else{
                return abort(401, $e->getMessage());
            }

        }

    }
}

