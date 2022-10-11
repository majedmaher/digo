<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendMails;
use App\Mail\NotifyEmail;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Email;
use App\Models\JobRequest;
use App\Models\Order;
use App\Models\Services;
use App\Models\Slider;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class SiteUIController extends Controller
{

    public function welcome()
    {
        // Artisan::call('backup:run --only-db');
        return view('site.welcome');
    }
    // /usr/local/bin/php /home/diginhkp/digo.sa/artisan schedule:run
    public function main()
    {
        return view('site.main')
            ->with('sliders',  Slider::orderBy('created_at', 'DESC')->get())
            ->with('slidersTitle',  Slider::orderBy('created_at', 'DESC')->select('title')->get())
            ->with('firstServices', Services::orderBy('id', 'desc')->take(3)->get())
            ->with('secondServices', Services::orderBy('id', 'desc')->skip(3)->take(3)->get())
            ->with('works', Work::orderBy('id', 'desc')->where('is_favorite', 1)->get());
    }

    public function orders()
    {
        return view('site.orders');
    }

    public function order($order)
    {
        return view('site.order')->with('order', $order);
    }

    public function orderStore(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
            'order' =>  'required',
            // 'email' =>  'required',
            'phone_number' =>  'required',
            // 'company' =>  'required',
            // 'details' =>  'required',
        ]);
        Order::create([
            'name' =>  $request->name,
            'order' =>  $request->order,
            'email' =>  $request->email,
            'phone_number' =>  $request->phone_number,
            'company' =>  $request->company,
            'details' =>  $request->details,
        ]);

        return view('site.thanks');
    }

    public function jobRequest()
    {
        return view('site.job_request')
            ->with('sliders',  Slider::orderBy('created_at', 'DESC')->get())
            ->with('slidersTitle',  Slider::orderBy('created_at', 'DESC')->select('title')->get());
    }

    public function jobRequestStore(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
            'email' =>  'required',
            'phone_number' =>  'required',
            'pdf_file' =>  'required|mimes:pdf',
        ]);
        $pdf_file = $request->pdf_file;
        $newPdf_file = time() . $pdf_file->getClientOriginalName();
        $pdf_file->move('uploads/job_requests', $newPdf_file);

        JobRequest::create([
            'name' =>  $request->name,
            'email' =>   $request->email,
            'phone_number' =>   $request->phone_number,
            'homeـadress' =>   $request->homeـadress,
            'job_title' =>   $request->job_title,
            'businessـlink' =>   $request->businessـlink,
            'pdf_file' =>  'uploads/job_requests/' . $newPdf_file,
        ]);
        return redirect()->route('main');
    }

    public function blog($pageNumber)
    {
        return view('site.blog')
            ->with('latestBlogs', Blog::orderBy('id', 'DESC')->take(8)->get())
            ->with('blogs', Blog::orderBy('id', 'DESC')->skip(($pageNumber - 1) * 6)->take(6)->get())
            ->with('count', Blog::all()->count() / 6)

            ->with('pageNumber', $pageNumber);
    }

    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('site.blog_details')
            ->with('latestBlogs', Blog::orderBy('id', 'DESC')->take(8)->get())
            ->with('blog', $blog);
    }

    public function latestWorks()
    {
        return view('site.works')
            ->with('works', Work::orderBy('arrangement', 'ASC')->take(8)->get())
            ->with('count', Work::all()->count() / 8)
            ->with('pageNumber', 1);
    }

    public function works($pageNumber)
    {
        $works = Work::select('photo', 'description', 'link', 'behance', 'arrangement')->orderBy('arrangement', 'ASC')->skip(($pageNumber - 1) * 8)->take(8)->get();
        $count = Work::all()->count() / 8;
        $data = array(
            'works' => $works,
            'pageNumber' => $pageNumber,
            'count' => $count
        );
        return response()->json($data);
    }

    public function contactStore(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
            'email' =>  'required',
            'message' =>  'required',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        Contact::create([
            'name' =>  $request->name,
            'email' =>   $request->email,
            'message' =>   $request->message,
        ]);

        return redirect()->back();
    }



    public function subscribeStore(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
            'email' =>  'required',
        ]);

        Subscribe::create([
            'name' =>  $request->name,
            'email' =>   $request->email,
        ]);

        return redirect()->back();
    }

    public function packages()
    {
        return view('site.packages');
    }
}
