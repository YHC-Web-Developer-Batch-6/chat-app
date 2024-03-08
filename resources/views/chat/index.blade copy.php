<x-app-layout>
    <x-slot name="header" class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    <div class="mt-4 bg-logo ">
        <div class="w-10 h-10 bg-blac bg-logo"></div>
        @foreach ($chats as $chat)
            @if ($chat->user_id != auth()->user()->id)
                <a href="{{ route('chat.message', ['id' => $chat->chat_room_id]) }}">
                    <div class="pt-3">
                        <div
                            class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white py-3 flex rounded-lg shadow-md hover:bg-slate-50 ">
                            <div class="w-auto">
                                <div class="bg-black w-16 h-16 rounded-full me-4 overflow-hidden">
                                    <img src="https://source.unsplash.com/800x800?person" alt="Profile Pict">
                                </div>
                            </div>
                            <div class="">
                                <h2 class="text-black text-2xl font-medium">{{ $chat->user->name }}</h2>
                                <p class="text-gray-400 line-clamp-1">{{ $chat->chatRoom->last_message }}</p>
                            </div>
                            <div class="ms-auto text-gray-400">
                                12.00
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>


</x-app-layout>
