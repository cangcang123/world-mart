<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\Controller;
use SHOP\Admin\Jobs\AdminNotifyMessage;
use Log;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login', 'sso_auth']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['username', 'password']);
        $credentials['status'] = 1;
        $credentials['locked'] = 0;
        $credentials['deleted'] = 0;

        if (!$token = auth()->attempt($credentials)) {
            dispatch(new AdminNotifyMessage('Đăng nhập thất bại', array_merge([
                'ip' => request()->ip(),
                'useragent' => request()->header('User-Agent')
            ], $credentials)));
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $agent = new Agent();
        $platform = $agent->platform() . '-' . $agent->version($agent->platform());
        $browser = $agent->browser() . '-' . $agent->version($agent->browser());

        Log::channel('user_action')->info("auth_login", [
            auth()->user()->role_id,
            auth()->user()->id,
            auth()->user()->username,
            'auth',
            auth()->user()->full_name . ' login',
            request()->ip(),
            $platform,
            $browser,
            request()->userAgent()
        ]);

        dispatch(new AdminNotifyMessage(auth()->user()->full_name . ' (' . auth()->user()->username . ') vừa login bằng ' . $browser . ' trên ' . $platform));

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $agent = new Agent();

        Log::channel('user_action')->info("auth_login", [
            auth()->user()->role_id,
            auth()->user()->id,
            auth()->user()->username,
            'auth',
            auth()->user()->full_name . ' logout',
            request()->ip(),
            $agent->platform() . '-' . $agent->version($agent->platform()),
            $agent->browser() . '-' . $agent->version($agent->browser()),
            request()->userAgent()
        ]);
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function sso_auth()
    {
        $dataPOST = trim(file_get_contents('php://input'));
        $xmlData = simplexml_load_string($dataPOST);
        $array = json_decode(json_encode((array) $xmlData), TRUE);
        logger('sso_auth', $array);
        return $array;
    }

    public function sso_auth_invalid()
    {
        $dataPOST = trim(file_get_contents('php://input'));
        $xmlData = simplexml_load_string($dataPOST);
        $array = json_decode(json_encode((array) $xmlData), TRUE);
        logger('sso_auth_invalid', $array);
        return $array;
    }

    public function sso_auth_logout()
    {
        $dataPOST = trim(file_get_contents('php://input'));
        $xmlData = simplexml_load_string($dataPOST);
        $array = json_decode(json_encode((array) $xmlData), TRUE);
        logger('sso_auth_logout', $array);
        return $array;
    }
}
