<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function advertisements(Request $request)
   {
        $search = $request->search;
        if($search){
            $pageTitle = "Search Result of $search";
            $advertisements = Advertise::where('resolution','like',"%$search%")->latest()->paginate(getPaginate());

        } else {
            $pageTitle = "All Advertisements";
            $advertisements = Advertise::latest()->paginate(getPaginate());
        }
        $emptyMessage = "No Advertisements found";
        return view('admin.advertise',compact('pageTitle','advertisements','search','emptyMessage'));
   }

   public function advertisementStore(Request $request)
   {

        $request->validate([
            'type' => 'required|in:1,2',
            'size' => 'required|in:300x600,300x250,728x90',
            'redirect_url' => 'required_if:type,1|url',
            'adimage' => 'required_if:type,1|image|mimes:jpg,jpeg,png,PNG,gif',
            'script' => 'required_if:type,2',
        ]);

        $advr = new Advertise();
        $advr->type = $request->type;
        $advr->script = $request->script ?? null;
        $advr->redirect_url = $request->redirect_url;
        $advr->resolution = $request->size;

        if($request->adimage){
            if ($request->adimage->getClientOriginalExtension() == 'gif'){
                $advr->ad_image = uploadFile($request->adimage, 'assets/images/advertisement/');
            }else{
                list($width, $height) = getimagesize($request->adimage);
                $size = $width.'x'.$height;
                if($request->size != $size){
                    $notify[]=['error','Sorry image size has to be '.$request->size];
                    return back()->withNotify($notify);
                }
                $advr->ad_image = uploadImage($request->adimage,'assets/images/advertisement/');
            }
        }

        $advr->status = $request->status ? 1:0;
        $advr->save();
        $notify[]=['success','Advertisement added successfully'];
        return back()->withNotify($notify);

   }

   public function advertisementUpdate(Request $request,$id)
   {
        $request->validate([
            'type' => 'required|in:1,2',
            'size' => 'required|in:300x600,300x250,728x90',
            'redirect_url' => 'required_if:type,1|url',
            'adimage' => 'image|mimes:jpg,jpeg,png,PNG,gif',
            'script' => 'required_if:type,2',
        ]);

        $advr = Advertise::findOrFail($id);
        $advr->type = $request->type;
        $advr->script = $request->script ?? null;
        $advr->redirect_url = $request->redirect_url;
        $advr->resolution = $request->size;
        if($request->adimage){

            $old = $advr->ad_image ?? null;
            if ($request->adimage->getClientOriginalExtension() == 'gif'){
                $advr->ad_image = uploadFile($request->adimage, 'assets/images/advertisement/',null,$old);
            }else{
                list($width, $height) = getimagesize($request->adimage);
                $size = $width.'x'.$height;
                if($request->size != $size){
                    $notify[]=['error','Sorry image size has to be '.$request->size];
                    return back()->withNotify($notify);
                }
                $advr->ad_image = uploadImage($request->adimage,'assets/images/advertisement/',null,$old);
            }
        }
        $advr->status = $request->status ? 1:0;
        $advr->save();
        $notify[]=['success','Advertisement Updated successfully'];
        return back()->withNotify($notify);
   }

   public function advertisementRemove(Request $request)
   {
        $request->validate([
            'add_id' => 'required|gt:0'
        ]);

        $add = Advertise::findOrFail($request->add_id);

        removeFile('assets/images/advertisement/' . $add->add_image);
        $add->delete();

        $notify[]=['success','Advertisement removed successfully'];
        return back()->withNotify($notify);
   }
}
