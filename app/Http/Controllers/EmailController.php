<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\UserSendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use  App\Http\Requests\EmailRequest;

class EmailController extends Controller
{
    public function index()
    {
        return view('users/contact');
    }

    public function sendEmail(EmailRequest $request)
    {
        if ($request->isMethod('post')) {

            if (isset($request->username) && isset($request->email) && isset($request->message)) {
                $username = $request->username;
                $title = $request->title;
                $email = $request->email;
                $message = $request->message;
                //  $content = ['name' => $username, 'email' => $email, 'message' => $message];
                $content = [
                    'subject' => $title,
                    'body' => $message
                ];
                try {
                    Mail::to('hothisang2k4@gmail.com')->send(new UserSendMail($content));
                    return "Email has been sent.";
                } catch (\Exception $e) {
                    return $e->getMessage(); // Trả về thông báo lỗi
                }
            }
        }
    }
}
