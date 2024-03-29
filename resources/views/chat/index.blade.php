<x-app-layout>
    <x-slot name="header" class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    <div class="mt-4">
        @foreach ($chats as $chat)
            <a href="{{ route('chat.message', ['id' => $chat->chat_room_id]) }}">
                <div id="room-chat-{{ $chat->chat_room_id }}" class="pt-3">
                    <div
                        class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white py-3 flex rounded-lg shadow-md hover:bg-slate-50 ">
                        <div class="w-auto">
                            <div class="bg-black w-16 h-16 rounded-full me-4 overflow-hidden">
                                <img src="https://eu.ui-avatars.com/api/?name={{ $chat->user->name }}" alt="Profile Pict">
                            </div>
                        </div>
                        <div class="max-w-[450px]">
                            <div class="flex items-center">
                                <h2 class="text-black text-2xl font-medium me-3">{{ $chat->user->name }}</h2>
                                <span id="ping-{{ $chat->chat_room_id }}" class="relative flex h-3 w-3"></span>
                            </div>

                            <p id="last-message-{{ $chat->chat_room_id }}" class="text-gray-400 line-clamp-1 break-words " style="word-break: break-all">
                                {{ $chat->chatRoom->last_message }}
                            </p>
                        </div>
                        <div class="ms-auto text-gray-400 text-xs text-pretty max-w-full">
                            {{ $chat->chatRoom->last_time->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        const roomChatIds = {!! json_encode($chats->pluck('chat_room_id')->toArray()) !!};
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const pusher = new Pusher('{!! env('PUSHER_APP_KEY') !!}', {
            cluster: "ap1",
            channelAuthorization: {
                endpoint: "/broadcasting/auth",
                headers: {
                    "X-CSRF-Token": token
                },
            },
        });


        roomChatIds.forEach(id => {
            const ping = document.getElementById(`ping-${id}`);
            const chat = document.getElementById(`last-message-${id}`);
            const channel = pusher.subscribe(`private-room.channel.${id}`);

            channel.bind("chat-message-event", function(res) {
                ping.innerHTML = `
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-[#818CF8]"></span>
                `;

                chat.innerText = res.message.message;
            });
        });
    </script>
</x-app-layout>
