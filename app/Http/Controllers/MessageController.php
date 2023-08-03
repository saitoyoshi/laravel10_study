<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessagePostRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        $messages = Message::all();

        return view('messages.index', compact('messages'));
    }
    public function store(MessagePostRequest $request) {
        $message = new Message();
        $message->body = $request->message;

        $message->save();

        return redirect(route('messages.index'));
    }
    public function update(Message $message) {
        return view('messages.update.index', compact('message'));
    }
    public function edit(Message $message , MessageUpdateRequest $request) {
        $message->body = $request->body;
        $message->update();
        return redirect(route('messages.index'));
    }
    public function delete(Message $message) {
        $message->delete();

        return redirect(route('messages.index'));
    }
}
