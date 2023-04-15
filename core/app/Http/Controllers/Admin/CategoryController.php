<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $pageTitle = 'All Categories';
        $categories = Category::latest()->paginate(getPaginate());
        $emptyMessage = 'No data found';
        return view('admin.category',compact('pageTitle','categories','emptyMessage'));
    }

    public function storeCategory(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:191',
            'image' => ['required', new FileTypeValidate(['jpeg', 'jpg', 'png'])]
        ]);
        $categoryImage = '';
        if($request->hasFile('image')) {
            try{

                $location = imagePath()['category']['path'];
                $size = imagePath()['category']['size'];

                $categoryImage = uploadImage($request->image, $location , $size);

            }catch(\Exception $exp) {
                return back()->withNotify(['error', 'Could not upload the image.']);
            }
        }

        $category = new Category();
        $category->name = $request->name;
        $category->image = $categoryImage;
        $category->save();

        $notify[] = ['success', 'Category details has been added'];
        return back()->withNotify($notify);
    }

    public function updateCategory(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'image' => [new FileTypeValidate(['jpeg', 'jpg', 'png'])]
        ]);
        $category = Category::findOrFail($id);

        $categoryImage = $category->image;
        if($request->hasFile('image')) {
            try{

                $location = imagePath()['category']['path'];
                $size = imagePath()['category']['size'];
                $old = $category->image;
                $categoryImage = uploadImage($request->image, $location , $size, $old);

            }catch(\Exception $exp) {
                return back()->withNotify(['error', 'Could not upload the image.']);
            }
        }

        $category->name = $request->name;
        $category->image = $categoryImage;
        $category->save();

        $notify[] = ['success', 'category details has been Updated'];
        return back()->withNotify($notify);
    }

    public function searchCategory(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $pageTitle = 'Category Search - ' . $search;
        $emptyMessage = 'No data found';
        $categories = Category::where('name', 'like',"%$search%")->paginate(getPaginate());

        return view('admin.category', compact('pageTitle', 'categories', 'emptyMessage'));
    }

    public function activate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $category = Category::findOrFail($request->id);
        $category->status = 1;
        $category->save();

        $notify[] = ['success', $category->name . ' has been activated'];
        return back()->withNotify($notify);
    }

    public function deactivate(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $category = Category::findOrFail($request->id);
        $category->status = 0;
        $category->save();

        $notify[] = ['success', $category->name . ' has been disabled'];
        return back()->withNotify($notify);
    }
}
