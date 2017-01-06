<?php

namespace App\Http\Controllers\api;

use App\Models\PrivateHoliday;
use App\Models\UserSettings;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use JWTAuth;

class AuthController extends Controller
{
    //================= SWAGGER
    /**
     * @SWG\Post(
     *     path="/api/v1/auth/login",
     *     summary="Check if database contains specified device token. If so - user authenticated, else register",
     *     tags={"auth"},
     *     description="Login",
     *     operationId="login",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="device_token",
     *         in="formData",
     *         description="Device token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     **/
    //================= SWAGGER

    /**
     * Check if specified device token exists in database
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $device_token = $request->device_token;
        if (User::whereDeviceToken($device_token)->exists()) {
            $user = User::whereDeviceToken($device_token)->first();
        } else {
            $user = User::create(['device_token' => $device_token]);
        }
        if (is_null($user->settings)) {
            $settings = new UserSettings([
                'active'     => true,
                'categories' => [1, 2, 3, 4, 5],
                'private'    => true,
                'favorite'   => true,
                'time'       => 1
            ]);
            $user->settings()->save($settings);
        }
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

}
