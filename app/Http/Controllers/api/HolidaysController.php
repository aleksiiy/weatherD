<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use App\Models\Holiday;
use App\Models\HolidaysUser;
use App\Models\PrivateHoliday;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use File;
use JWTAuth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\UserInterface;

class HolidaysController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }


    /**
     * @SWG\Get(
     *     path="/api/v1/categories",
     *     summary="Categories",
     *     tags={"holidays"},
     *     description="Categories",
     *     operationId="Categories",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function categories()
    {
        $categories = Category::all();
        return response()->json(compact('categories'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/categories/{category_id}",
     *     summary="Holiday delete",
     *     tags={"holidays"},
     *     description="Holiday delete",
     *     operationId="holidayDelete",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *      @SWG\Parameter(
     *         name="category_id",
     *         in="path",
     *         description="Device token",
     *         required=true,
     *         type="string"
     *     ),
     *
     *     @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="Device token",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="take",
     *         in="query",
     *         description="Take",
     *         required=true,
     *         type="integer"
     *     ),
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function categoryHolidays($category_id, Request $request)
    {
        $category = Category::findOrFail($category_id);
        $total = $category->holidays()->count();
        $holidays = $category->holidays()->skip($request->skip)->take($request->take)->get();

        return response()->json(compact('total', 'holidays'));
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
    public function createUserHoliday(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $input = $request->except(['image']);
        /* image */
        if ($image = $request->file('image')) {
            $dir = PrivateHoliday::IMAGE_FOLDER;
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $holiday = new PrivateHoliday($input);
        $user->holidays()->save($holiday);
        $holiday = PrivateHoliday::findOrFail($holiday->id);

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

    public function updateUserHoliday($id, Request $request)
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
            $dir = PrivateHoliday::IMAGE_FOLDER;
            File::delete(public_path() . $dir . $holiday->image);
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $holiday->update($input);
        $holiday = PrivateHoliday::findOrFail($holiday->id);

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
    public function deleteUserHoliday($id)
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
     * @SWG\Get(
     *     path="/api/v1/holidays_user/{id}",
     *     summary="PrivateHoliday",
     *     tags={"holidays"},
     *     description="Private Holiday",
     *     operationId="privateHoliday",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="Private Holiday ID",
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

    public function showPrivateHoliday($id)
    {
        $user = JWTAuth::parseToken()->authenticate();
        try {
            $holiday = PrivateHoliday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday not found'], 404);
        }

        return response()->json(compact('holiday'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holiday/{id}",
     *     summary="Holiday",
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

    public function Holiday($id)
    {

        $user = JWTAuth::parseToken()->authenticate();
        try {
            $holiday = Holiday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday not found'], 404);
        }
        $favorites = $user->favorites()->pluck('holiday_id')->toArray();
        $holiday->favorite = in_array($id, $favorites);

        return response()->json(compact('holiday'));
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

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/random/{skip}",
     *     summary="Random Holiday",
     *     tags={"holidays"},
     *     description="Random holiday",
     *     operationId="RandomHoliday",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *      @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="showRandomHoliday",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="take",
     *         in="query",
     *         description="Take",
     *         required=true,
     *         type="integer"
     *     ),
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function showRandomHoliday(Request $request)
    {
        $randomHoliday = Holiday::inRandomOrder(8)->skip($request->skip)->take($request->take)->get();
        return response()->json(compact('randomHoliday'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/near",
     *     summary="Random Holiday",
     *     tags={"holidays"},
     *     description="Random holiday",
     *     operationId="RandomHoliday",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *     @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="Skip random holiday",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="take",
     *         in="query",
     *         description="Take",
     *         required=true,
     *         type="integer"
     *     ),
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function nearHolidays(Request $request)
    {
        $dateInMonth = Carbon::now()->addMonth();
        $dateInMonth->year = Holiday::DEFAULT_YEAR;
        $dateInMonth->format('Y-d-m');
        $now = Carbon::now();
        $now->year = Holiday::DEFAULT_YEAR;
        $now->format('Y-d-m');
        $query = Holiday::whereBetween('date', [$now, $dateInMonth]);
        $total = $query->count();
        $holidays = $query->orderBy('date', 'asc')->skip($request->skip)->take($request->take)->get();
        return response()->json(compact('total', 'holidays'));
    }


    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/month",
     *     summary="Random Holiday",
     *     tags={"holidays"},
     *     description="Random holiday",
     *     operationId="RandomHoliday",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *       @SWG\Parameter(
     *         name="month",
     *         in="query",
     *         description="Month",
     *         required=true,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="Skip",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="take",
     *         in="query",
     *         description="Take",
     *         required=true,
     *         type="integer"
     *     ),
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function monthHolidays(Request $request)
    {
        $month = $request->month;
        $dateStart = Carbon::createFromDate(1970, $month)->startOfMonth();
        $dateEnd = Carbon::createFromDate(1970, $month)->endOfMonth();
        $query = Holiday::whereBetween('date', [$dateStart, $dateEnd]);
        $total = $query->count();
        $holidays = $query->orderBy('date', 'asc')->skip($request->skip)->take($request->take)->get();

        return response()->json(compact('total', 'holidays'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/search",
     *     summary="Seaac",
     *     tags={"holidays"},
     *     description="Random holiday",
     *     operationId="RandomHoliday",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *       @SWG\Parameter(
     *         name="q",
     *         in="query",
     *         description="Month",
     *         required=true,
     *         type="string"
     *     ),
     *      @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="Skip random holiday",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="take",
     *         in="query",
     *         description="Take",
     *         required=true,
     *         type="integer"
     *     ),
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function searchHolidays(Request $request)
    {
        $search = $request->q;
        $query = Holiday::where('name_ru', 'like', '%' . $search . '%');
        $total = $query->count();
        $holidays = $query->orderBy('date', 'asc')->skip($request->skip)->take($request->take)->get();

        return response()->json(compact('total', 'holidays'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays_user/show",
     *     summary="Seaac",
     *     tags={"holidays"},
     *     description="Random holiday",
     *     operationId="RandomHoliday",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *      @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="Skip random holiday",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="take",
     *         in="query",
     *         description="Take",
     *         required=true,
     *         type="integer"
     *     ),
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function showHolidays(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate()->id;
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday not found'], 404);
        }
        $query = PrivateHoliday::whereUserId($user);
        $total = $query->count();
        $holidays = $query->skip($request->skip)->take($request->take)->get();

        return response()->json(compact('total', 'holidays'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/show_favorite",
     *     summary="Seaac",
     *     tags={"holidays"},
     *     description="Random holiday",
     *     operationId="RandomHoliday",
     *     consumes={"application/xml", "application/json"},
     *     produces={"application/xml", "application/json"},
     *
     *      @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="Skip random holiday",
     *         required=true,
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         name="take",
     *         in="query",
     *         description="Take",
     *         required=true,
     *         type="integer"
     *     ),
     *
     *     @SWG\Response(
     *         response="200",
     *         description="Successful operation",
     *     )
     * )
     *
     */

    public function showFavoriteHolidays(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate()->id;
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday not found'], 404);
        }
        $query = HolidaysUser::whereUserId($user);
        $total = $query->count();
        $holidays = $query->skip($request->skip)->take($request->take)->get();

        return response()->json(compact('total', 'holidays'));
    }

}
