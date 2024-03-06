<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chatMessages = [
            [
                "chat_room_id" => "1",
                "chat_id" => "1",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "1",
                "chat_id" => "2",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "2",
                "chat_id" => "3",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "2",
                "chat_id" => "4",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "3",
                "chat_id" => "5",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "3",
                "chat_id" => "6",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "4",
                "chat_id" => "7",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "4",
                "chat_id" => "8",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "5",
                "chat_id" => "9",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "5",
                "chat_id" => "10",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "1",
                "chat_id" => "1",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "1",
                "chat_id" => "2",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "2",
                "chat_id" => "3",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "2",
                "chat_id" => "4",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "3",
                "chat_id" => "5",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "3",
                "chat_id" => "6",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "4",
                "chat_id" => "7",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "4",
                "chat_id" => "8",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "5",
                "chat_id" => "9",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "5",
                "chat_id" => "10",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "1",
                "chat_id" => "1",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "1",
                "chat_id" => "2",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "2",
                "chat_id" => "3",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "2",
                "chat_id" => "4",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "3",
                "chat_id" => "5",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "3",
                "chat_id" => "6",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "4",
                "chat_id" => "7",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "4",
                "chat_id" => "8",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "5",
                "chat_id" => "9",
                "message" => fake()->text(),
            ],
            [
                "chat_room_id" => "5",
                "chat_id" => "10",
                "message" => fake()->text(),
            ],
        ];

        foreach ($chatMessages as $chatMessage) {
            ChatMessage::create([
                "chat_room_id" => $chatMessage["chat_room_id"],
                "chat_id" => $chatMessage["chat_id"],
                "message" => $chatMessage["message"],
            ]);
        }
    }
}
