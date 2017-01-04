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
        $input = $request->except(['image']);
        if ($image = $request->file('image')) {
            $dir = Holiday::IMAGE_FOLDER;
            $filename = $dir . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $holiday = new Holiday($input);
        $category = Category::findOrFail($id);
        $category->holidays()->save($holiday);

        return redirect()->back();
    }

    public function show()
    {
        $holidays = Holiday::all();
        return view('admin.holidays.show_holiday', compact('holidays'));
    }

    public function updateHoliday($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('admin.holidays.update_holiday', compact('holiday'));
    }

    public function editHoliday($id, Request $request)
    {
        try {
            $holiday = Holiday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday not found'], 404);
        }
        $input = $request->except(['image']);
        /* image */
        if ($image = $request->file('image')) {
            $dir = Holiday::IMAGE_FOLDER;
            File::delete(public_path() . $dir . $holiday->image);
            $filename = $dir . uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $holiday->update($input);
        return redirect('admin/show');
    }

    public function destroyHoliday($id)
    {
        Holiday::whereId($id)->delete();
        return redirect('admin/show');
    }
}
