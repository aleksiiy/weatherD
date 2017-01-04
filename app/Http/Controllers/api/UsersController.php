<?php

namespace App\Http\Controllers\api;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * @SWG\Post(
     *     path="/api/v1/user/settings",
     *     summary="Update/create settings for user",
     *     tags={"user"},
     *     description="Update/create settings for usere",
     *     operationId="settings",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *     @SWG\Parameter(
     *         name="active",
     *         in="formData",
     *         description="On/Off push notifications",
     *         required=true,
     *         type="boolean"
     *     ),
     *     @SWG\Parameter(
     *         name="categories[]",
     *         in="formData",
     *         description="Array of categories",
     *         type="array",
     *         items="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="private",
     *         in="formData",
     *         description="Private holidays",
     *         required=true,
     *         type="boolean"
     *     ),
     *     @SWG\Parameter(
     *         name="favorite",
     *         in="formData",
     *         description="Favorite holidays",
     *         required=true,
     *         type="boolean"
     *     ),
     *     @SWG\Parameter(
     *         name="time",
     *         in="formData",
     *         description="Time in hours before event",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function settings(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $categories = [];
        foreach($request->get('categories') as $item) {
            array_push($categories, intval($item));
        }
        $input = [
            'active'     => boolval($request->get('active')),
            'private'    => boolval($request->get('private')),
            'favorite'   => boolval($request->get('favorite')),
            'time'       => intval($request->get('time')),
            'categories' => $categories
        ];
        if ($settings = $user->settings) {
            $settings->update($input);
        } else {
            $settings = new UserSettings($input);
            $user->settings()->save($settings);
        }

        return response()->json(compact('settings'));
    }
}