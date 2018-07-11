<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function send(Request $request)
    {


        Mail::send('mails.send', ['title' => "New Blog Made", 'body' => "There is a new blog"], function ($message)
        {

            $message->from('molukaka@cytonn.com', 'Michael Olukaka');

            $message->to('molukaka-95e115@inbox.mailtrap.io');

        });


        return view('posts', ['success' => 'Email Sent']);


    }
}
