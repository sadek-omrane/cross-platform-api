<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get my chats
        $chats = Chat::whereHas('users', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('users', 'lastMessage', 'createdBy')->get();

        return $this->sendResponse($chats, 'Chats retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create chat
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'message_content' => 'required|string',
        ])->setCustomMessages([
            'user_id.exists' => 'The user does not exist.',
            'message_content.required' => 'The message content is required.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $chat = Chat::create([
            'created_by_id' => Auth::id(),
        ]);

        $chat->users()->attach([$request->user_id, Auth::id()]);

        // create message
        $chat->messages()->create([
            'from_user_id' => Auth::id(),
            'content' => $request->message_content,
        ]);

        return $this->sendResponse($chat, 'Chat created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $chat->load('users', 'messages');

        return $this->sendResponse($chat, 'Chat retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        $chat->delete();

        return $this->sendResponse(null, 'Chat deleted successfully.');
    }
}
