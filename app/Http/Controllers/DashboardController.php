<?php

namespace App\Http\Controllers;

use App\Events\MyNotification;
use App\Models\FcmToken;
use App\Models\User;
use App\Services\FCMService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('dashboard.users')->with('users', $users);
    }

    public function notification()
    {
        // event(new MyNotification('hello world'));
        return view('dashboard.notification');
    }



    public function sendNotification(Request $request)
    {

        $tokens = FcmToken::selected()->all();
        // return $tokens;
        // $tokens = array("dgbD-SBz5xtQczZaPxDC9u:APA91bHBsca6883j-PD1HJD5vELOovHL4jkuB1Eqr0kDQ06JgeshYDIt8OkIwNElD3bEPm0rwI48XIqTAxU1kUKXcgHSS0c5EOLRdl2W3j9j2gY5F2anXQ3v57k7lLkv3VTMgpiDUKzm");
        $notification = ['title' => $request->title, 'body' => $request->body];
        FCMService::send(
            $tokens,
            $notification
        );
        // return $response;
        return back()->with('success', 'Notification send successfully.');

        // $SERVER_API_KEY = env('FCM_SERVER_KEY');
        // $arr = array("dgbD-SBz5xtQczZaPxDC9u:APA91bHBsca6883j-PD1HJD5vELOovHL4jkuB1Eqr0kDQ06JgeshYDIt8OkIwNElD3bEPm0rwI48XIqTAxU1kUKXcgHSS0c5EOLRdl2W3j9j2gY5F2anXQ3v57k7lLkv3VTMgpiDUKzm");
        // $data = [
        //     // "to" => "dgbD-SBz5xtQczZaPxDC9u:APA91bHBsca6883j-PD1HJD5vELOovHL4jkuB1Eqr0kDQ06JgeshYDIt8OkIwNElD3bEPm0rwI48XIqTAxU1kUKXcgHSS0c5EOLRdl2W3j9j2gY5F2anXQ3v57k7lLkv3VTMgpiDUKzm",

        //     "registration_ids" => $arr,

        //     "notification" => [
        //         "title" => "notification",
        //         "body" => $request->body,
        //         'subtitle'      => 'subtitle',
        //         'tickerText'    => 'ticker',
        //         'vibrate'   => 1,
        //         'sound'     => 1
        //     ]
        // ];
        // $dataString = json_encode($data);

        // $headers = [
        //     'Authorization: key=' . $SERVER_API_KEY,
        //     'Content-Type: application/json',
        // ];

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        // $response = curl_exec($ch);
        // return $response;
        // return back()->with('success', 'Notification send successfully.');
    }



    // public function sendNotification(Request $request)
    // {
    //     // $data = ['title' => "test", 'content' => "testtt"];
    //     $data = ['title' => $request->title, 'content' => $request->content];
    //     event(new MyNotification($data));
    //     // event(new MyNotification('hello world'));

    //     return redirect()->back();
    // }
}
