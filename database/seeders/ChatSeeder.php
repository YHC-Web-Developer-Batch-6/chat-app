<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chats = [
            [
                "chat_room_id" => "1",
                "user_id" => "2",
            ],
            [
                "chat_room_id" => "1",
                "user_id" => "1",
            ],
            [
                "chat_room_id" => "2",
                "user_id" => "2",
            ],
            [
                "chat_room_id" => "2",
                "user_id" => "3",
            ],
            [
                "chat_room_id" => "3",
                "user_id" => "1",
            ],
            [
                "chat_room_id" => "3",
                "user_id" => "4",
            ],
            [
                "chat_room_id" => "4",
                "user_id" => "4",
            ],
            [
                "chat_room_id" => "4",
                "user_id" => "3",
            ],
            [
                "chat_room_id" => "5",
                "user_id" => "1",
            ],
            [
                "chat_room_id" => "5",
                "user_id" => "3",
            ],
        ];

        foreach ($chats as $chat) {
            Chat::create([
                "chat_room_id" => $chat["chat_room_id"],
                "user_id" => $chat["user_id"],
            ]);
        }
    }
}
