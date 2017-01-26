<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;


class HolidayController extends Controller
{
    public function create($id)
    {
        $category = Category::findOrFail($id);
        $holidays = $category->holidays;
        $colors = [
            '#000000',
            '#ffffff',
            '#929292',
            '#ff0000',
            '#a1d623',
            '#20b1f5',
        ];
        return view('admin.holidays.holidays_create', compact('holidays', 'colors'));
    }

    public function save($id, Request $request)
    {
        $input = $request->except(['image', 'floating']);
        if ($image = $request->file('image')) {
            $dir = Holiday::IMAGE_FOLDER;
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $input = array_merge($input, ['floating' => !is_null($request->floating) ? true : false]);
        $holiday = new Holiday($input);
        $category = Category::findOrFail($id);
        $category->holidays()->save($holiday);

        return redirect()->back();
    }

    public function show()
    {
        $holidays = Holiday::all();
        $categories = Category::pluck('name_ru', 'id');
        return view('admin.holidays.show_holiday', compact('holidays', 'categories'));
    }

    public function updateHoliday($id)
    {
        $holiday = Holiday::findOrFail($id);
        $colors = [
            '#000000',
            '#ffffff',
            '#929292',
            '#ff0000',
            '#a1d623',
            '#20b1f5',
        ];
        return view('admin.holidays.update_holiday', compact('holiday', 'colors'));
    }

    public function editHoliday($id, Request $request)
    {
        try {
            $holiday = Holiday::findOrFail($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'the holiday that you want to edit are not found'], 404);
        }
        $input = $request->except(['image', 'floating']);
        /* image */
        if ($image = $request->file('image')) {
            $dir = Holiday::IMAGE_FOLDER;
            File::delete(public_path() . $dir . $holiday->image);
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . $dir, $filename);
            $input = array_merge($input, ['image' => $filename]);
        }
        $input = array_merge($input, ['floating' => !is_null($request->floating) ? true : false]);
        $holiday->update($input);
        return redirect('admin/show');
    }

    public function destroyHoliday($id)
    {
        try {
            $holiday = Holiday::find($id);
        } catch (Exception $exception) {
            return response()->json(['error' => 'holiday you want to delete is not found'], 404);
        }
        $dir = Holiday::IMAGE_FOLDER;
        File::delete(public_path() . $dir . $holiday->image);
        $holiday->delete();

        return redirect('admin/show');
    }

    public function sendPush()
    {
        Artisan::call('send:holidays');

        return response('Push motification command has been executed');
    }

    public function copyHoliday(Request $request)
    {
        $holiday = Holiday::findOrFail($request->holiday_id);
        $duplicatedHoliday = $holiday->replicate();
        $category = Category::findOrFail($request->category);
        $dir = Holiday::IMAGE_FOLDER;
        $filename = uniqid() . '.' . File::extension(public_path() . $dir . $duplicatedHoliday->image);
        File::copy(public_path() . $dir . $holiday->image, public_path() . $dir . $filename);
        $duplicatedHoliday->image = $filename;
        $category->holidays()->save($duplicatedHoliday);

        return redirect()->route('holiday.edit', ['id' => $duplicatedHoliday->id]);
    }
}
