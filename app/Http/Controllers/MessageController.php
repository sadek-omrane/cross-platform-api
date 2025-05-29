<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reply_to_message_id' => 'nullable|exists:messages,id',
            'chat_id' => 'required|exists:chats,id',
            'content' => 'required|string',
        ])->setCustomMessages([
            'reply_to_message_id.exists' => 'The message does not exist.',
            'chat_id.exists' => 'The chat does not exist.',
            'content.required' => 'The message content is required.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $message = Message::create([
            'from_user_id' => Auth::id(),
            'chat_id' => $request->chat_id,
            'reply_to_message_id' => $request->reply_to_message_id,
            'content' => $request->content,
        ]);

        $message->fromUser;

        return $this->sendResponse($message, 'Message created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ])->setCustomMessages([
            'content.required' => 'The message content is required.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $message->update([
            'content' => $request->content,
        ]);

        return $this->sendResponse($message, 'Message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return $this->sendResponse(null, 'Message deleted successfully.');
    }
}
