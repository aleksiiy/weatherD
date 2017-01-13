<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use App\Models\Holiday;
use App\Models\HolidaysUser;
use App\Models\PrivateHoliday;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
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
     *         description="Category id",
     *         required=true,
     *         type="string"
     *     ),
     *
     *     @SWG\Parameter(
     *         name="skip",
     *         in="query",
     *         description="skip",
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
        $holidays = $category->holidays()->orderBy('date', 'asc')->skip($request->skip)->take($request->take)->get();

        return response()->json(compact('total', 'holidays'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/colors",
     *     summary="Holiday colors",
     *     tags={"holidays"},
     *     description="Show colors",
     *     operationId="ShowColors",
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
    public function getColors()
    {
        $colors = [
            '#000000',
            '#ffffff',
            '#929292',
            '#ff0000',
            '#a1d623',
            '#20b1f5',
        ];
        return response()->json(compact('colors'));
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
     *         description="Name holiday",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="formData",
     *         description="description",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="floating",
     *         in="formData",
     *         description="On/Off floating date",
     *         required=true,
     *         type="boolean"
     *     ),
     *      @SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         description="Date (05-10)",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="date_to",
     *         in="formData",
     *         description="Date_to (05-10)",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="date_color",
     *         in="formData",
     *         description="Only reserved color",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="name_color",
     *         in="formData",
     *         description="only reserved color",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="opacity",
     *         in="formData",
     *         description="only reserved number",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         description="image file",
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
        $input = $request->except(['image', 'floating']);
        /* image */
        if ($image = $request->file('image')) {
            $dir = PrivateHoliday::IMAGE_FOLDER;
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $input = array_merge($input, ['floating' => filter_var($request->get('floating'), FILTER_VALIDATE_BOOLEAN)]);
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
     *         description="Name holiday",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="description",
     *         in="formData",
     *         description="description",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="floating",
     *         in="formData",
     *         description="On/Off floating date",
     *         required=true,
     *         type="boolean"
     *     ),
     *     @SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         description="Date (05-10)",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="date_to",
     *         in="formData",
     *         description="Date_to (05-10)",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="date_color",
     *         in="formData",
     *         description="only reserved color",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="name_color",
     *         in="formData",
     *         description="only reserved color",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="opacity",
     *         in="formData",
     *         description="only reserved number",
     *         required=false,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         description="image file",
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
        try {
            $holiday = PrivateHoliday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'User holiday not found'], 404);
        }
        $input = $request->except(['image', 'floating']);

        if ($image = $request->file('image')) {
            $dir = PrivateHoliday::IMAGE_FOLDER;
            File::delete(public_path() . $dir . $holiday->image);
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $input = array_merge($input, ['floating' => filter_var($request->get('floating'), FILTER_VALIDATE_BOOLEAN)]);
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
            return response()->json(['error' => 'Holiday not found'], 404);
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
        try {
            $holiday = PrivateHoliday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Holiday not found'], 404);
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
     *         description="id holiday",
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        try {
            $holiday = Holiday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'Holiday not found'], 404);
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if ((Holiday::find($id)) !== null) {
            if (($user->favorites()->where('holiday_id', '=', $id)->first()) == null) {
                HolidaysUser::create(['user_id' => $user->id, 'holiday_id' => $id]);
            } else {
                return response()->json(['Holiday has been already added to favorites'], 422);
            }
        } else {
            return response()->json(['Holiday not found'], 404);
        }
        $favorites = HolidaysUser::all();
        return response()->json(compact('favorites'));
    }

    /**
     * @SWG\Delete(
     *     path="/api/v1/holidays/favorite/{id}",
     *     summary="Favorite delete",
     *     tags={"holidays"},
     *     description="Favorite delete",
     *     operationId="FavoriteDelete",
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if (($user->favorites()->where('holiday_id', '=', $id)->first()) != null) {
           HolidaysUser::whereHolidayId($id)->whereUserId($user->id)->delete();
        } else {
            return response()->json(['error' => 'Holiday not found'], 404);
        }

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
     *         description="skip",
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
        $subMonth = Carbon::now()->subMonth();
        $subMonth->year = Holiday::DEFAULT_YEAR;
        $subMonth = $subMonth->format('Y-m-d');
        $now = Carbon::tomorrow();
        $now->year = Holiday::DEFAULT_YEAR;
        $now = $now->format('Y-m-d');
        $randomHoliday = Holiday::inRandomOrder()->whereNotBetween('date', [$subMonth, $now])->skip($request->skip)->take($request->take)->get();
        return response()->json(compact('randomHoliday'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/near",
     *     summary="Near Holidays",
     *     tags={"holidays"},
     *     description="Near holidays",
     *     operationId="NearHoliday",
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

    public function nearHolidays(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $dateInMonth = Carbon::now()->addMonth();
        $dateInMonth->year = Holiday::DEFAULT_YEAR;
        $dateInMonth = $dateInMonth->format('Y-m-d');
        $now = Carbon::tomorrow();
        $now->year = Holiday::DEFAULT_YEAR;
        $now = $now->format('Y-m-d');
        $publicHolidays = Holiday::whereBetween('date', [$now, $dateInMonth])->orderBy('date', 'asc')->get();
        $privateHolidays = $user->holidays()->whereBetween('date', [$now, $dateInMonth])->orderBy('date', 'asc')->get();
        $unsortedHolidays = new Collection();
        $unsortedHolidays = $unsortedHolidays->merge($publicHolidays);
        foreach ($privateHolidays as $holiday) {
            $unsortedHolidays->push($holiday);
        }
        $holidays = $unsortedHolidays->sortBy('original_date')->values();
        return response()->json(compact('holidays'));
    }

    /**
     * @SWG\Get(
     *     path="/api/v1/holidays/today",
     *     summary="Today Holidays",
     *     tags={"holidays"},
     *     description="Get holidays for today",
     *     operationId="todayHolidays",
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

    public function todayHolidays(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $now = Carbon::now();
        $now->year = Holiday::DEFAULT_YEAR;
        $now = $now->format('Y-m-d');
        $publicHolidays = Holiday::where('date', '=', $now)->get();
        $privateHolidays = $user->holidays()->where('date', '=', $now)->get();
        $unsortedHolidays = new Collection();
        $unsortedHolidays = $unsortedHolidays->merge($publicHolidays);
        foreach ($privateHolidays as $holiday) {
            $unsortedHolidays->push($holiday);
        }
        $holidays = $unsortedHolidays->sortBy('id')->values();

        return response()->json(compact('holidays'));
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $month = $request->month;
        $dateStart = Carbon::createFromDate(1970, $month)->startOfMonth();
        $dateEnd = Carbon::createFromDate(1970, $month)->endOfMonth();

        $publicHolidays = Holiday::whereBetween('date', [$dateStart, $dateEnd])->orderBy('date', 'asc')->get();
        $privateHolidays = $user->holidays()->whereBetween('date', [$dateStart, $dateEnd])->orderBy('date', 'asc')->get();
        $unsortedHolidays = new Collection();
        $unsortedHolidays = $unsortedHolidays->merge($publicHolidays);
        foreach ($privateHolidays as $holiday) {
            $unsortedHolidays->push($holiday);
        }
        $holidays = $unsortedHolidays->sortBy('original_date')->values();

        return response()->json(compact('holidays'));
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
        $query = Holiday::where('name_ru', 'like', '%' . $search . '%')
            ->orWhere('name_kz', 'like', '%' . $search . '%');

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
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $query = $user->holidays();
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
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $query = $user->favorites();
        $total = $query->count();
        $holidays = $query->skip($request->skip)->take($request->take)->get();

        return response()->json(compact('total', 'holidays'));
    }

}
