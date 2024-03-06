<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;
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
        // $chats = Chat::where('chat_room_id', [3, 4])->get();
        // dd($chatRoomId, $chats);

        // $chatroom = Chat::where('user_id', auth()->user()->id)->pluck('chat_room_id');
        // dd($chatroom);
        return view('chat.index', compact('chats'));
    }

    function message($id)
    {
        $messages = ChatMessage::where('chat_room_id', $id)->get();
        $users = Chat::where('chat_room_id', $id)->whereNot('user_id', Auth::user()->id)->first();
        // dd($users);


        return view('chat.message', compact('messages', 'users'));
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
        //
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
