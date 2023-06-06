<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.index');
    }

    public function sendMail(Request $request) {
        // dd($request->all());
        try {
            $mailData = [
                'name'=> $request->name,
                'email'=> $request->email,
                'message'=> $request->message
            ];
            Mail::to(env('MAIL_USERNAME'))->send(new ContactUsMail($mailData));
            // Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactUsMail($mailData));
            return redirect()->back()->with('success', 'Email sent successfully!');
            // return redirect('/contact')->with('success', 'You have successfully send the mail.');

        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Opps, error!');
        }

    }
}
