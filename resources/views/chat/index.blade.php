<x-app-layout>
    <x-slot name="header" class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    <div class="mt-4">
        @foreach ($chats as $chat)
            <a href="{{ route('chat.message', ['id' => $chat->chat_room_id]) }}">

                <div class="pt-3">
                    <div
                        class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white py-3 flex rounded-lg shadow-md hover:bg-slate-50 ">
                        <div class="w-auto">

                            <div class="bg-black w-16 h-16 rounded-full me-4"></div>
                        </div>
                        <div class="">
                            <h2 class="text-black text-2xl font-medium">{{ $chat->user->name }}</h2>
                            <p class="text-gray-400 line-clamp-1">{{ $chat->chatMessages->first()->message }}</p>

                        </div>

                        <div class="ms-auto text-gray-400">
                            12.00
                        </div>

                    </div>
                </div>
            </a>
        @endforeach

        {{-- <div class="pt-3">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white py-3 flex rounded-lg shadow-md hover:bg-slate-50 ">
                <div class="w-auto">

                    <div class="bg-black w-16 h-16 rounded-full me-4"></div>
                </div>
                <div class="">
                    <h2 class="text-black text-2xl font-medium">Rahmat</h2>
                    <p class="text-gray-400 line-clamp-1">Lorem ipsum dolor shidhai diaida iadhiahhddajdjadjodj
                        dadiahdiidhid
                        djadagudagd
                        augdugdugaudgug</p>

                </div>
                <div class="ms-auto text-gray-400">
                    12.00
                </div>

            </div>
        </div> --}}
        {{-- <div class="pt-3">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white py-3 flex rounded-lg shadow-md">
                <div class="w-auto">

                    <div class="bg-black w-16 h-16 rounded-full me-4"></div>
                </div>
                <div class="">
                    <h2 class="text-black text-2xl">Rahmat</h2>
                    <p class="text-gray-400 line-clamp-1">Lorem ipsum dolor shidhai diaida iadhiahhddajdjadjodj
                        dadiahdiidhid
                        djadagudagd
                        augdugdugaudgug</p>

                </div>
                <div class="ms-auto text-gray-400">
                    12.00
                </div>

            </div>
        </div>
        <div class="pt-3">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white py-3 flex rounded-lg shadow-md">
                <div class="w-auto">

                    <div class="bg-black w-16 h-16 rounded-full me-4"></div>
                </div>
                <div class="">
                    <h2 class="text-black text-2xl">Rahmat</h2>
                    <p class="text-gray-400 line-clamp-1">Lorem ipsum dolor shidhai diaida iadhiahhddajdjadjodj
                        dadiahdiidhid
                        djadagudagd
                        augdugdugaudgug</p>

                </div>
                <div class="ms-auto text-gray-400">
                    12.00
                </div>

            </div>
        </div> --}}
        {{-- <div class="pt-3">
                <div
                    class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-gradient-to-r from-pink-900 to-purple-700 py-3 flex rounded-lg">
                    <div class="w-auto">

                        <div class="bg-white w-16 h-16 rounded-full me-4"></div>
                    </div>
                    <div class="">
                        <h2 class="text-white text-2xl">Rahmat</h2>
                        <p class="text-gray-200 line-clamp-1">Lorem ipsum dolor shidhai diaida iadhiahhddajdjadjodj
                            dadiahdiidhid
                            djadagudagd
                            augdugdugaudgug</p>

                    </div>
                    <div class="ms-auto text-white">
                        12.00
                    </div>

                </div>
            </div> --}}
    </div>


</x-app-layout>
