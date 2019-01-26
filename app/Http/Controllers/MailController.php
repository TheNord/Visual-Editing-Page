<?php

namespace App\Http\Controllers;

use App\Entity\Project\Settings;
use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\DeclareDeclare;

class MailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'check' => 'required'
        ]);

        $toEmail = Settings::getEmail();

        Mail::to($toEmail)->send(new ContactForm($request));

        return redirect()->back()->with(['status' => 'Ваше сообщение успешно отправлено']);
    }
}
