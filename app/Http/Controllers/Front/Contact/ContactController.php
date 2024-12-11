<?php

namespace App\Http\Controllers\Front\Contact;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Front\ContactRequest;
use App\Mail\SendMessageEmail;
use Exception;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.pages.contact.index');
    }

    public function store(ContactRequest $request)
    {
        $message = $request->validated();
        Message::create($message);

        try {
            Mail::to(auth()->user()->email)->send(new SendMessageEmail($message));
        } catch (Exception $e) {
            return back()->withErrors('email failed to send');
        }
        return back()->with('success', 'Message send successfully check confirmation email');
    }
}
