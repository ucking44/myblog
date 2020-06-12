<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get(); //->paginate(2);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);

            $image = $request->file('image');
            $slug = str_slug($request->name);
            if(isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                if(!Storage::disk('public')->exists('category'))
                {
                    Storage::disk('public')->makeDirectory('category');
                }

                $category = Image::make($image->getRealPath())->resize(1600,479)->save('jpg', 'png', 'jpeg', 'bmp');
                //$category->save('jpg', 'png', 'jpeg', 'bmp');
                Storage::disk('public')->put('category/'.$imagename,$category);

                if(!Storage::disk('public')->exists('category/slider'))
                {
                    Storage::disk('public')->makeDirectory('category/slider');
                }

                $slider = Image::make($image->getRealPath())->resize(500,333)->save('jpg', 'png', 'jpeg', 'bmp');
                Storage::disk('public')->put('category/slider/'.$imagename,$slider);


            } else {
                $imagename = "default.png";
            }

            $category = new Category();
            $category->name = $request->name;
            $category->slug = $slug;
            $category->image = $imagename;
            $category->save();
            Toastr::success('Category Successfully Saved :)', 'Success');
            return redirect()->route('admin.category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        $image = $request->file('image');
            $slug = str_slug($request->name);
            $category = Category::findOrFail($id);

            if(isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                if(!Storage::disk('public')->exists('category'))
                {
                    Storage::disk('public')->makeDirectory('category');
                }

                if(Storage::disk('public')->exists('category/'.$category->image))
                {
                    Storage::disk('public')->delete('category/'.$category->image);
                }

                $categoryimage = Image::make($image->getRealPath())->resize(1600,479)->save('jpg', 'png', 'jpeg', 'bmp');
                //$category->save('jpg', 'png', 'jpeg', 'bmp');
                Storage::disk('public')->put('category/'.$imagename,$categoryimage);

                if(!Storage::disk('public')->exists('category/slider'))
                {
                    Storage::disk('public')->makeDirectory('category/slider');
                }

                if(Storage::disk('public')->exists('category/slider/'.$category->image))
                {
                    Storage::disk('public')->delete('category/slider/'.$category->image);
                }

                $slider = Image::make($image->getRealPath())->resize(500,333)->save('jpg', 'png', 'jpeg', 'bmp');
                Storage::disk('public')->put('category/slider/'.$imagename,$slider);

            } else {
                $imagename = $category->image;
            }

            $category->name = $request->name;
            $category->slug = $slug;
            $category->image = $imagename;
            $category->save();
            Toastr::success('Category Successfully Updated :)', 'Success');
            return redirect()->route('admin.category.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        Toastr::success('Category Successfully Deleted :)', 'Success');
        return redirect()->route('admin.category.index');

    }
}
