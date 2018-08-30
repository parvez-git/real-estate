<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Category;
use Carbon\Carbon;
use Toastr;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:categories|max:255',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            $slider = Image::make($image)->resize(1600, 480)->save();
            Storage::disk('public')->put('category/slider/'.$imagename, $slider);

            if(!Storage::disk('public')->exists('category/thumb')){
                Storage::disk('public')->makeDirectory('category/thumb');
            }
            $thumb = Image::make($image)->resize(500, 330)->save();
            Storage::disk('public')->put('category/thumb/'.$imagename, $thumb);
        }else{
            $imagename = 'default.png';
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();

        Toastr::success('message', 'Category created successfully.');
        return redirect()->route('admin.categories.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->name);
        $category = Category::find($id);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category/slider')){
                Storage::disk('public')->makeDirectory('category/slider');
            }
            if(Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }
            $slider = Image::make($image)->resize(1600, 480)->save();
            Storage::disk('public')->put('category/slider/'.$imagename, $slider);

            if(!Storage::disk('public')->exists('category/thumb')){
                Storage::disk('public')->makeDirectory('category/thumb');
            }
            if(Storage::disk('public')->exists('category/thumb/'.$category->image)){
                Storage::disk('public')->delete('category/thumb/'.$category->image);
            }
            $thumb = Image::make($image)->resize(500, 330)->save();
            Storage::disk('public')->put('category/thumb/'.$imagename, $thumb);
        }else{
            $imagename = $category->image;
        }

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();

        Toastr::success('message', 'Category updated successfully.');
        return redirect()->route('admin.categories.index');
    }


    public function destroy($id)
    {
        $category = Category::find($id);

        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        if(Storage::disk('public')->exists('category/thumb/'.$category->image)){
            Storage::disk('public')->delete('category/thumb/'.$category->image);
        }

        $category->delete();
        $category->posts()->detach();

        Toastr::success('message', 'Category deleted successfully.');
        return back();
    }
}
