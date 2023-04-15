<?php

namespace App\Http\Controllers;
use App\Models\AdminNotification;
use App\Models\Advertise;
use App\Models\Category;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Page;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function index(){
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $reference = @$_GET['reference'];
        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';

        $sections = Page::where('tempname',$this->activeTemplate)->where('slug','home')->first();

        return view($this->activeTemplate . 'home', compact('pageTitle','sections'));
    }

    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle','sections'));
    }


    public function contact()
    {
        $pageTitle = "Contact Us";
        return view($this->activeTemplate . 'contact',compact('pageTitle'));
    }


    public function contactSubmit(Request $request)
    {

        $attachments = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket = new SupportTicket();
        $ticket->user_id = auth()->id() ?? 0;
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->priority = 2;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->id() ?? 0;
        $adminNotification->title = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message = new SupportMessage();
        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return back();
    }

    public function products()
    {
        $pageTitle = 'Products';
        $products = Product::whereHas('category', function ($query) {
            $query->where('status',1);
        })->with('category')->latest()->paginate(12);

        return view($this->activeTemplate.'products',compact('pageTitle','products'));
    }

    public function featuredProducts()
    {
        $pageTitle = 'Featured Products';
        $products = Product::where('featured',1)->with('category')->latest()->paginate(12);

        return view($this->activeTemplate.'products',compact('pageTitle','products'));
    }

    public function productSearch(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $pageTitle = 'Products for - '.$request->search;
        $emptyMessage = 'No data Found';
        $search = $request->search;

        $products = Product::where(function($q) use ($search) {
            $q->orWhere('name', 'LIKE',  "%$search%")->orWhereHas('category', function($category) use($search){
                $category->where('name', 'LIKE',  "%$search%");
            });
        });

        $products = $products->whereHas('category', function ($query) {
            $query->where('status',1);
        })->with(['category'])->latest()->paginate(12);

        $moreProducts = Product::whereHas('category', function ($query) {
            $query->where('status',1);
        })->with('category')->limit(9)->latest()->get();

        return view($this->activeTemplate.'search',compact('pageTitle','emptyMessage','products','moreProducts'));
    }

    public function categorySearch($id)
    {
        $category = Category::findOrFail($id);
        $pageTitle = 'Products from - '.$category->name;
        $emptyMessage = 'No data Found';
        $products = $category->products()->whereHas('category', function ($query) {
                    $query->where('status',1);
                })->with(['category'])->paginate(12);

        $moreProducts = Product::whereHas('category', function ($query) {
            $query->where('status',1);
        })->with('category')->limit(9)->latest()->get();

        return view($this->activeTemplate.'search',compact('pageTitle','emptyMessage','products','moreProducts'));
    }

    public function productDetails($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $pageTitle = $product->name;

        return view($this->activeTemplate.'product-details',compact('pageTitle','product'));
    }

    public function download($id)
    {
        $product = Product::findOrFail($id);

        $product->total_download += 1;
        $product->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = 0;
        $adminNotification->title = $product->name.' is downloaded';
        $adminNotification->click_url = urlPath('admin.product.all');
        $adminNotification->save();

        $file = $product->file;
        $full_path = 'assets/product/' . $file;
        $title = str_replace(' ','_',strtolower($product->name));
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $mimetype = mime_content_type($full_path);
        header('Content-Disposition: attachment; filename="' . $title . '.' . $ext . '";');
        header("Content-Type: " . $mimetype);
        return readfile($full_path);
    }

    public function blogs()
    {
        $pageTitle = 'Blogs';
        $empty_message = 'No data Found';
        $blogElements = Frontend::where('data_keys', 'blog.element')->latest()->paginate(12);
        return view($this->activeTemplate.'blogs',compact('pageTitle','blogElements'));
    }

    public function blogDetails($id,$slug){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $pageTitle = 'Blog Details';
        $recentBlogs = Frontend::where('data_keys', 'blog.element')->limit(6)->get();
        return view($this->activeTemplate.'blog_details',compact('blog','pageTitle','recentBlogs'));
    }

    public function policy($id, $heading) {
        $policy = Frontend::where('data_keys','policy.element')->findOrFail($id);
        $pageTitle = $heading;

        return view($this->activeTemplate.'policy',compact('pageTitle','policy'));
    }

    public function subscriberStore(Request $request) {


        $validate = Validator::make($request->all(),[
            'email' => 'required|email|unique:subscribers',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->save();

        $notify = ['success' => 'Subscribed Successfully!'];
        return response()->json($notify);
    }

    public function addClickUp(Request $request) {


        $validate = Validator::make($request->all(),[
            'id' => 'required|integer|gt:0',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        $add = Advertise::findOrFail($request->id);
        $add->increment('total_click');
    }

    public function downloadClickUp(Request $request) {


        $validate = Validator::make($request->all(),[
            'id' => 'required|integer|gt:0',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        $product = Product::findOrFail($request->id);
        $product->increment('total_download');

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = 0;
        $adminNotification->title = $product->name.' is downloaded';
        $adminNotification->click_url = urlPath('admin.product.all');
        $adminNotification->save();
    }

    public function cookieAccept(){
        session()->put('cookie_accepted',true);
        return response()->json(['success' =>'Cookie accepted successfully']);
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

}
