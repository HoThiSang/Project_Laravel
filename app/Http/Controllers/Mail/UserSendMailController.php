<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\UserSendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Mail\ContactFormEmail;
use  Illuminate\Mail\PendingMail;
use App\Mail\AdminReplyMail;

class UserSendMailController extends Controller
{
    protected $contact;

    public function __construct()
    {
        $this->contact = new Contact();
    }
    public function sendEmail(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'email' => 'required|email|',
            'title' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'email' => $request->input('email'),
            'title' => $request->input('title'),
            'message' => $request->input('message'),
            'user_name' => $request->input('user_name'),
            'status' => 'No contact yet',
            'created_at' => now(),
        ];

        Mail::to(getenv('MAIL_USERNAME'))->send(new UserSendMail($data));

        if (Mail::failures()) {
            return redirect()->back()->with('error', 'Gửi email thất bại.');
        }
        $this->contact->creatNewContact($data);
        return redirect()->back()->with('success', 'The email has been successfully sent to the system');
    }

    public function replyEmail(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $cart = $this->contact->getContactById($id);
            if (!empty($cart)) {
                $request->validate([
                    'message' => 'required',
                ]);
                $dataSend = [
                    'email' => $cart->email,
                    'title' => $cart->title,
                    'user_name' => $cart->user_name,
                    'message'=>$request->message,
                    'status'=> 'Contacted',
                    'updated_at'=>now()
                ];
                $cartdata= [
                    'status' => 'Contacted',
                    'updated_at' => now()
                ];
                Mail::to($cart->email)->send(new AdminReplyMail($dataSend));
               
                if (Mail::failures()) {
                    return redirect()->back()->with('error', 'Gửi email thất bại.');
                }
                $this->contact->updateContact($id, $cartdata);
                
                return redirect()->route('admin-contact')->with('success', 'The email has been successfully sent to the system');
            }
        }
    }
}
