<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chatRoomId = Chat::where('user_id', auth()->user()->id)->pluck('chat_room_id')->toArray();
        $chats = Chat::where(
            function ($q) use ($chatRoomId) {
                $q->whereNot('user_id', auth()->user()->id)->whereIn('chat_room_id', $chatRoomId);
            }
        )->get();

        return view('chat.index', compact('chats'));
    }

    public function message($id)
    {
        $messages = ChatMessage::where('chat_room_id', $id)->get();
        $users = Chat::where('chat_room_id', $id)->whereNot('user_id', Auth::user()->id)->first();

        return view('chat.message', compact('messages', 'users'));
    }

    public function messageResponse($id)
    {
        $messages = ChatMessage::where('chat_room_id', $id)->with('chat')->get();

        return response()->json([
            "status" => "success",
            "message" => "Data retrived successfully",
            "data" => $messages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'chat_room_id' => 'required',
            'user_id' => 'required',
            'message' => 'required',
        ]);

        $chatId = Chat::where('chat_room_id', $request->chat_room_id)
            ->where('user_id', $request->user_id)
            ->pluck('id')
            ->first();

        $chatMessage = ChatMessage::create([
            'chat_room_id' => $request->chat_room_id,
            'chat_id' => $chatId,
            'message' => $request->message,
        ]);

        event(new MessageCreated($chatMessage));

        return response()->json([
            "status" => "success",
            "message" => "Message successfully created!",
            "data" => $chatMessage,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChatRoom $chatRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatRoom $chatRoom)
    {
        //
    }
}
