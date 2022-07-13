<?php

namespace App\Http\Controllers;

use App\Imports\EmailImport;
use App\Jobs\SendMails;
use App\Models\Email;
use App\Models\MailForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MailFormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insertEmails(Request $request)
    {
        Email::truncate();
        Excel::import(new EmailImport, $request->excel_file);
        return 'successfuly';
    }

    public function sendEmail($id)
    {
        // Artisan::call('cache:clear');
        // Artisan::call('config:clear');
        // Artisan::call('config:cache');
        // Artisan::call('view:clear'); 
        // $users = User::select('name', 'email')->get();
        // foreach ($users as $user) {
        //     Mail::To($user->email)->send(new NotifyEmail($user->name));
        // }
        // Mail::To('mohaamedmajed@gmail.com')->send(new NotifyEmail());
        $mail = MailForm::find($id);
        Email::chunk(1, function ($data) use ($mail) {
            dispatch(new SendMails($data, $mail));
        });
        // dispatch((new SendMails($data))->delay(60));
        return 'successfuly';
        // return view('emails.email', compact('mail'));
    }

    public function index()
    {
        $mails = MailForm::orderBy('created_at', 'DESC')->get();

        return view('mail_form.index')->with('mails', $mails);
    }

    public function show($id)
    {
        $mail = MailForm::find($id);
        return view('emails.email', compact('mail'));
    }

    public function create()
    {
        return view('mail_form.create');
    }

    public function store(Request $request)
    {
        $mail = new MailForm();
        if ($request->has('header_image')) {

            $header_image = $request->header_image;
            $new_header_image = time() . $header_image->getClientOriginalName();
            $header_image->move('uploads/mail-form/header-image', $new_header_image);
            $mail->header_image = 'uploads/mail-form/header-image/' . $new_header_image;
        }

        if ($request->has('body_image')) {

            $body_image = $request->body_image;
            $new_body_image = time() . $body_image->getClientOriginalName();
            $body_image->move('uploads/mail-form/body-image', $new_body_image);
            $mail->body_image = 'uploads/mail-form/body-image/' . $new_body_image;
        }
        if ($request->has('footer_image')) {

            $footer_image = $request->footer_image;
            $new_footer_image = time() . $footer_image->getClientOriginalName();
            $footer_image->move('uploads/mail-form/footer-image', $new_footer_image);
            $mail->footer_image = 'uploads/mail-form/footer-image/' . $new_footer_image;
        }
        $mail->mail_title = $request->mail_title;
        $mail->body_text_one = $request->body_text_one;
        $mail->button = $request->button;
        $mail->button_link = $request->button_link;
        $mail->body_text_two = $request->body_text_two;
        $mail->button_one = $request->button_one;
        $mail->button_one_link = $request->button_one_link;
        $mail->button_two = $request->button_two;
        $mail->button_two_link = $request->button_two_link;
        $mail->button_three = $request->button_three;
        $mail->button_three_link = $request->button_three_link;
        $mail->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $mail = MailForm::where('id', $id)->first();

        if ($mail === null) {
            return redirect()->back();
        }
        return view('mail_form.edit')->with('mail', $mail);
    }

    public function update(Request $request,  $id)
    {
        $mail = MailForm::find($id);
        if ($request->has('header_image')) {

            $header_image = $request->header_image;
            $new_header_image = time() . $header_image->getClientOriginalName();
            $header_image->move('uploads/mail-form/header-image', $new_header_image);
            $mail->header_image = 'uploads/mail-form/header-image/' . $new_header_image;
        }

        if ($request->has('body_image')) {

            $body_image = $request->body_image;
            $new_body_image = time() . $body_image->getClientOriginalName();
            $body_image->move('uploads/mail-form/body-image', $new_body_image);
            $mail->body_image = 'uploads/mail-form/body-image/' . $new_body_image;
        }
        if ($request->has('footer_image')) {

            $footer_image = $request->footer_image;
            $new_footer_image = time() . $footer_image->getClientOriginalName();
            $footer_image->move('uploads/mail-form/footer-image', $new_footer_image);
            $mail->footer_image = 'uploads/mail-form/footer-image/' . $new_footer_image;
        }
        $mail->mail_title = $request->mail_title;
        $mail->body_text_one = $request->body_text_one;
        $mail->button = $request->button;
        $mail->button_link = $request->button_link;
        $mail->body_text_two = $request->body_text_two;
        $mail->button_one = $request->button_one;
        $mail->button_one_link = $request->button_one_link;
        $mail->button_two = $request->button_two;
        $mail->button_two_link = $request->button_two_link;
        $mail->button_three = $request->button_three;
        $mail->button_three_link = $request->button_three_link;
        $mail->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $mail = MailForm::find($id);

        $mail->delete($id);
        return redirect()->back();
    }
}
