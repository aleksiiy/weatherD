<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\HolidaysUser;
use App\Models\PrivateHoliday;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalUsers = User::all()->count();
        $totalHolidays = Holiday::all()->count();
        $totalUserHolidays = HolidaysUser::all()->count();
        $totalUserPrivateis = PrivateHoliday::all()->count();

        return view('admin.home', compact(
            'totalUsers',
            'totalHolidays',
            'totalUserHolidays',
            'totalUserPrivateis'));
    }
}
