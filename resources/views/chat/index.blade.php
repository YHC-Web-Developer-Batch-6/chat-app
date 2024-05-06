<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    <div class="mt-4 px-4 sm:px-0">
        @foreach ($chats as $chat)
            @if ($chat->chatRoom->last_message != null)
                <a href="{{ route('chat.message', ['id' => $chat->chat_room_id]) }}">
                    <div class="pt-3" id="room-chat-{{ $chat->chat_room_id }}">
                        <div
                            class="mx-auto flex max-w-3xl rounded-lg bg-white p-3 shadow-md hover:bg-slate-50 sm:px-6 lg:px-8">
                            <div class="w-auto">
                                <div class="me-4 h-16 w-16 max-sm:h-10 max-sm:w-10 overflow-hidden rounded-full bg-black content-center">
                                    <img src="https://eu.ui-avatars.com/api/?name={{ $chat->user->name }}"
                                        alt="Profile Pict">
                                </div>
                            </div>
                            <div class="max-w-[450px]">
                                <div class="flex items-center">
                                    <h2 class="me-3 text-2xl font-medium text-black max-sm:text-base">{{ $chat->user->name }}</h2>
                                    <span class="relative flex h-3 w-3 " id="ping-{{ $chat->chat_room_id }}"></span>
                                </div>

                                <p class="line-clamp-1 break-words text-gray-400 max-sm:text-sm"
                                    id="last-message-{{ $chat->chat_room_id }}" style="word-break: break-all">
                                    {{ $chat->chatRoom->last_message }}
                                </p>
                            </div>
                            <div class="text-pretty ms-auto max-w-full text-xs text-gray-400">
                                {{ $chat->chatRoom->last_time->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    <div class="mt-6 px-4 sm:px-0">
        <div class="mx-auto max-w-3xl">
            <h1 class="text-3xl font-bold max-sm:text-center mb-4">Contacts</h1>
        </div>
        <div class="flex justify-center">
            <section class="grid max-w-3xl grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ($users as $user)
                    <a class="mx-auto flex h-full w-full flex-col items-center justify-start gap-2 rounded-lg bg-white px-2 py-3 shadow-md hover:bg-slate-50 sm:px-6 lg:px-8"
                        id="contact-{{ $user->id }}" href="{{ route('chat.room', ['contactId' => $user->id]) }}">
                        <div class="w-auto">
                            <div class="h-16 w-16 max-sm:h-10 max-sm:w-10 overflow-hidden rounded-full bg-black">
                                <img src="https://eu.ui-avatars.com/api/?name={{ $user->name }}" alt="Profile Pict">
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center">
                                <h2 class="text-balance text-center text-2xl font-medium max-sm:text-base text-black">
                                    {{ $user->name }}
                                </h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </section>
        </div>
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
