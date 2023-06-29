<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $messages = Message::all();

        return View('message/index', ['messages' => $messages]);
    }
    public function store(Request $request)
    {
        $message = new Message();
        $message->body = $request->body;
        $message->save();

        return redirect('/messages');
    }
}
