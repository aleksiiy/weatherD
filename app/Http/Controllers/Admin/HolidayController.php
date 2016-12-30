<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;


class HolidayController extends Controller
{
    public function create($id)
    {
        $category = Category::findOrFail($id);
        $holidays = $category->holidays;
        return view('admin.holidays.holidays_create', compact('holidays'));
    }

    public function save($id, Request $request)
    {
        /*--------------------------------------------------------------------------*/
        /*--------------------------------------------------------------------------*/
        /*--------------------------------------------------------------------------*/
        $image_holiday = Input::file('image');
        $dir = '/uploads/holidays_admin/';

        do {
            $filename = str_random(30) . '.' . $image_holiday->getClientOriginalExtension();
        } while (File::exists(public_path() . $dir . $filename));

        Input::file('image')->move(public_path() . $dir, $filename);

        $request->image = $dir . $filename;

        /*--------------------------------------------------------------------------*/
        /*--------------------------------------------------------------------------*/
        /*--------------------------------------------------------------------------*/
        $holiday = new Holiday($request->all());
        $category = Category::findOrFail($id);
        $category->holidays()->save($holiday);
        return redirect()->back();
    }

    public function show()
    {
        $holidays = Holiday::all();
        return view('admin.holidays.show_holiday', compact('holidays'));
    }

    public function description($id)
    {
        $description = Holiday::whereId($id)->get();
        return view('admin.holidays.description', compact('description'));
    }
}
