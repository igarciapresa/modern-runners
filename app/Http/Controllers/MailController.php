<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnswerMail;
use App\Models\Message;

class MailController extends Controller
{
    public function answerMail(Request $request)
    {
        $details = [
            'title' => 'Hi ' . $request->name . ',',
            'question' => 'Your question was: ' . $request->message,
            'answer' => $request->answer
        ];

        Mail::to($request->email)->send(new AnswerMail($details));

        $message = Message::where('id', '=', $request->id);
        $message->delete();
        return "Email sent";
    }
}
