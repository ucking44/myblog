<div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you, want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Delete</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




        {{-- $image = $request->file('image');
        $slug = str_slug($request->name);
        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }

            $category = Image::make($image->getRealPath())->resize(1600,479);; //->save();
            $category->save();
            Storage::disk('public')->put('category/'.$imagename,$category);

            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }

            $slider = Image::make($image->getRealPath())->resize(500,333)->save();
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


 --}}


{{--


 // $filenameWithExtension = $request->file('image')->getClientOriginalName();

        // $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

        // $extension = $request->file('image')->getClientOriginalName();

        // $filenameToStore = $filename . '_' . time() . '.' . $extension;

        // $request->file('image')->storeAs('public/categories', $filenameToStore);

        // $category = Category::findOrFail($id);
        // $category->name = $request->input('name');
        // $category->slug = str_slug($request->name);
        // $category->image = $filenameToStore;
        // $category->save();
        // Toastr::success('Category Successfully Updated :)', 'Success');
        // return redirect()->route('admin.category.index'); --}}


        

        {{-- // $filenameWithExtension = $request->file('image')->getClientOriginalName();

        // $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

        // $extension = $request->file('image')->getClientOriginalName();

        // $filenameToStore = $filename . '_' . time() . '.' . $extension;

        // $request->file('image')->storeAs('public/categories', $filenameToStore);

        // //dd($path);

        // $category = new Category();
        // $category->name = $request->input('name');
        // $category->slug = str_slug($request->name);
        // $category->image = $filenameToStore;
        // $category->save();
        // Toastr::success('Category Successfully Saved :)', 'Success');
        // return redirect()->route('admin.category.index');
 --}}
