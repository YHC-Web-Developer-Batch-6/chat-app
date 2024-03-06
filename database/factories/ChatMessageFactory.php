<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\ChatRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatMessage>
 */
class ChatMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "chat_room_id" => ChatRoom::all()->random()->id,
            "chat_id" => Chat::all()->random()->id,
            "message" => fake()->text(),
        ];
    }
}
