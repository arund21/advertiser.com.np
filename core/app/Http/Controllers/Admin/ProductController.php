<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function allProduct(Request $request)
    {
        $search = $request->search;
        if($search){
            $pageTitle = "Search Result of $search";
            $products = Product::where(function($q) use ($search) {
                $q->orWhere('name', 'LIKE',  "%$search%")->orWhereHas('category', function($category) use($search){
                    $category->where('name', 'LIKE',  "%$search%");
                });
            })->latest()->paginate(getPaginate());
        } else {
            $pageTitle = 'All Products';
            $products = Product::with('category')->latest()->paginate(getPaginate());
        }
        $emptyMessage = 'No data found';
        return view('admin.product.index',compact('pageTitle','emptyMessage','products','search'));
    }

    public function newProduct()
    {
        $pageTitle = 'Add New Product';
        $categories = Category::latest()->get();
        return view('admin.product.new',compact('pageTitle','categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric|gt:0',
            'name' => 'required|max:191',
            'version' => 'required|max:191',
            'rating' => 'required|integer|max:5',
            'response' => 'required|integer',
            'image' => ['required','image','max:2048', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'upload_system' => 'required|integer|in:1,2',
            'file' => ['required_if:upload_system,1','mimes:zip', new FileTypeValidate(['zip'])],
            'links' => 'required_if:upload_system,2|array|min:1',
            'links.*' => 'required_with:links|url',
            'demo_link' => 'required|url|max:255',
        ]);

        $pImage = '';
        if($request->hasFile('image')) {
            try{
                $location = imagePath()['p_image']['path'];
                $size = imagePath()['p_image']['size'];
                $pImage = uploadImage($request->image, $location , $size);

            }catch(\Exception $exp) {
                $notify[] = ['error', 'Could not upload the image'];
                return back()->withNotify($notify);
            }
        }

        $pFile = '';
        if ($request->file) {
            if($request->hasFile('file')) {
                try{
                    $location = imagePath()['p_file']['path'];
                    $pFile = uploadFile($request->file, $location);

                }catch(\Exception $exp) {
                    $notify[] = ['error', 'Could not upload the file'];
                    return back()->withNotify($notify);
                }
            }
        }

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->image = $pImage;
        $product->type = $request->upload_system;
        $product->file = $pFile;
        $product->links = $request->links;
        $product->demo_link = $request->demo_link;
        $product->version = $request->version;
        $product->description = $request->description;
        $product->rating = $request->rating;
        $product->response = $request->response;
        $product->save();

        $notify[] = ['success', 'Product has been successfully added'];
        return back()->withNotify($notify);
    }

    public function editProduct($id)
    {
        $pageTitle = 'Edit Product';
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();

        return view('admin.product.edit',compact('pageTitle', 'product','categories'));
    }

    public function updateProduct(Request $request ,$id)
    {
        $request->validate([
            'category_id' => 'required|numeric|gt:0',
            'name' => 'required|max:191',
            'rating' => 'required|integer|max:5',
            'response' => 'required|integer',
            'version' => 'required|max:191',
            'image' => ['nullable','image','max:2048', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'upload_system' => 'required|integer|in:1,2',
            'file' => ['nullable','mimes:zip', new FileTypeValidate(['zip'])],
            'links' => 'required_if:upload_system,2|array|min:1',
            'links.*' => 'required_with:links|url',
            'demo_link' => 'required|url|max:255',
        ],[
            'links.required_if'=>'Link field is required'
        ]);

        $product = Product::findOrFail($id);


        $pFile = $product->file;
        
        if ($request->upload_system == 1) {
            if ($pFile ) {
                if ($request->hasFile('file')){
                    try{
                        $location = imagePath()['p_file']['path'];
                        $old = $pFile;
                        $pFile = uploadFile($request->file, $location , '' , $old);

                    }catch(\Exception $exp) {
                        $notify[] = ['error', 'Could not upload the file'];
                        return back()->withNotify($notify);
                    }
                }
            }else{
                $notify[] = ['error', 'You have given no file'];
                return back()->withNotify($notify);
            }
        }

        $pImage = $product->image;
        if($request->hasFile('image')) {
            try{
                $location = imagePath()['p_image']['path'];
                $size = imagePath()['p_image']['size'];
                $old = $pImage;
                $pImage = uploadImage($request->image, $location , $size , $old);

            }catch(\Exception $exp) {
                $notify[] = ['error', 'Could not upload the image'];
                return back()->withNotify($notify);
            }
        }

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->image = $pImage;
        $product->type = $request->upload_system;
        $product->file = $pFile;
        $product->links = $request->links;
        $product->demo_link = $request->demo_link;
        $product->version = $request->version;
        $product->description = $request->description;
        $product->rating = $request->rating;
        $product->response = $request->response;
        $product->save();

        $notify[] = ['success', 'Product has been updated successfully'];
        return back()->withNotify($notify);
    }

    public function removeProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|gt:0',
        ]);

        $product = Product::findOrFail($request->product_id);

        $pImageLoc = imagePath()['p_image']['path'];
        $pFileLoc = imagePath()['p_file']['path'];

        $pImage = $product->image;
        $pFile = $product->file;

        removeFile($pImageLoc. '/' . $pImage);
        removeFile($pFileLoc. '/' . $pFile);

        $product->delete();

        $notify[] = ['success', 'Product successfuly removed'];
        return back()->withNotify($notify);
    }

    public function featuredProduct(Request $request){
        $request->validate([
            'id' => 'required|gt:0'
        ]);

        $product = Product::findOrFail($request->id);

        $product->featured = 1;
        $product->save();

        $notify[] = ['success', 'Product has been featured successfully'];
        return back()->withNotify($notify);
    }

    public function unFeaturedProduct(Request $request){
        $request->validate([
            'id' => 'required|gt:0'
        ]);

        $product = Product::findOrFail($request->id);

        $product->featured = 0;
        $product->save();

        $notify[] = ['success', 'Product has been unfeatured successfully'];
        return back()->withNotify($notify);
    }

}
