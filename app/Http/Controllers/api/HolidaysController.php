<?php

namespace App\Http\Controllers\api;

use App\Models\Holiday;
use App\Models\HolidaysUser;
use App\Models\PrivateHoliday;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use File;
use JWTAuth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HolidaysController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }


    /**
     * @SWG\Get(
     *     path="/api/v1/",
     *     summary="Holiday delete",
     *     tags={"holidays"},
     *     description="Holiday delete",
     *     operationId="holidayDelete",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */
    public function show()
    {
        $holidays = Holiday::all();
        return response()->json(compact('holidays'));
    }

    /**
     * @SWG\Post(
     *     path="/api/v1/holidays_user/create",
     *     summary="Holiday creation",
     *     tags={"holidays"},
     *     description="Holiday creation",
     *     operationId="holidayCreate",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         description="Device token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         description="Device token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="date_color",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="name_color",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="opacity",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */
    public function create_user_holiday(Request $request)
    {
        //$user - returns an array with information about the user
        $user = JWTAuth::parseToken()->authenticate();
        $input = $request->except(['image']);
        /* image */
        if ($image = $request->file('image')) {
            $dir = '/uploads/holidays/';
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $holiday = new PrivateHoliday($input);
        $user->holidays()->save($holiday);

        return response()->json(compact('holiday'));

    }

    /**
     * @SWG\Post(
     *     path="/api/v1/holidays_user/update/{id}",
     *     summary="Holiday update",
     *     tags={"holidays"},
     *     description="Holiday update",
     *     operationId="holidayUpdate",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="Holiday id",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="date_color",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="name_color",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="opacity",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         description="Device token",
     *         required=false,
     *         type="file"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function update_user_holiday($id, Request $request)
    {
        //$user - returns an array with information about the user
        $user = JWTAuth::parseToken()->authenticate();
        try {
            $holiday = PrivateHoliday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday not found'], 404);
        }
        $input = $request->except(['image']);
        /* image */
        if ($image = $request->file('image')) {
            $dir = '/uploads/holidays/';
            File::delete(public_path() . $dir . $holiday->image);
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $holiday->update($input);

        return response()->json(compact('holiday'));
    }

    /**
     * @SWG\Delete(
     *     path="/api/v1/holidays_user/delete/{id}",
     *     summary="Holiday delete",
     *     tags={"holidays"},
     *     description="Holiday delete",
     *     operationId="holidayDelete",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="Delet id",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */
    public function delete_user_holiday($id)
    {
        try {
            $holiday = PrivateHoliday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday not found'], 404);
        }
        File::delete(public_path() . $holiday->image);
        $holiday->delete();
        return response()->json(true, 200);

    }

    /**
     * @SWG\Post(
     *     path="/api/v1/holidays/favorite/{id}",
     *     summary="Add favorite To favorite",
     *     tags={"holidays"},
     *     description="Add to favorite",
     *     operationId="addToFavorite",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="Holiday id",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function addToFavorite($id)
    {
        //$user - returns an array with information about the user
        $user = JWTAuth::parseToken()->authenticate();
        HolidaysUser::create(['user_id' => $user->id, 'holiday_id' => $id]);
        $favorites = HolidaysUser::all();
        return response()->json(compact('favorites'));
    }

    /**
     * @SWG\Delete(
     *     path="/api/v1/holidays/destroy/{id}",
     *     summary="Holiday delete",
     *     tags={"holidays"},
     *     description="Holiday delete",
     *     operationId="holidayDelete",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="Edit id",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function destroy($id)
    {
        $destroy = HolidaysUser::whereHolidayId($id);
        $destroy->delete();
        return response()->json(true, 200);
    }


}
