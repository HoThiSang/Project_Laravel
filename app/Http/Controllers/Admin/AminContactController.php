<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AminContactController extends Controller
{
    protected $contact;

    public function __construct()
    {
        $this->contact = new Contact();
    }
    public function index()
    {
        $contactAll = $this->contact->getAllContact();
        // dd($contactAll);
        return view('admin/contact/admin-contact', compact('contactAll'));
    }

    public function show($id) 
    {   
        if(!empty($id)){
            $cart = $this->contact->getContactById($id);
            if(!empty($cart)){
                return view('admin/contact/admin-contact-reply', compact('cart'));
            }
            else{
                return redirect()->back()->with('error', 'Not found contact with id : '. $id);
            }
        }
    }

    public function destroy($id) 
    {
        if (!empty($id)) {
            $cart = $this->contact->getContactById($id);
            if (!empty($cart)) {
                $cartDelete = $this->contact->deleteContactId($id);
                if($cartDelete){
                    return redirect()->back()->with('success', 'Deleted contact successfull !');
                }
                return redirect()->back()->with('error', 'Delete contact field !');
            }
            return redirect()->back()->with('error', 'Not found contact with id : ' . $id);
        }
    }
}
