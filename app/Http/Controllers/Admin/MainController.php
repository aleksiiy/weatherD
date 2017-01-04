<?php

namespace App\Http\Controllers\Admin;

use App\Addres;
use App\Categories;
use App\Email;
use App\Http\Requests\CreatephoneRequest;
use App\Logo;
use App\Message;
use App\Models\Category;
use App\Phone_number;
use App\Product;
use App\Slider;
use App\Social;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function login()
    {
        return view('auth.login');
    }


    public function category()
    {
        $categories = Category::all();
        return view('admin.category.category_create', compact('categories'));
    }

    public function category_create(Request $request)
    {
        $category = $request->all();
        Category::create($category);
        return redirect('/admin/category');
    }

    public function destroy($id)
    {
        Category::whereId($id)->delete();
        return redirect('/admin/category');
    }

    public function update($id)
    {
        $update = Category::findOrFail($id);
        return view('admin.category.update', compact('update'));
    }

    public function edit($id, Request $request)
    {
        $edit = Category::findOrFail($id);
        $edit->update($request->all());

        $categories = Category::all();
        return view('admin.category.category_create', compact('categories'));
    }
}
