<x-app-layout>

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Tailwind CSS Response Chat Template</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>


    <body>
        <div class="min-w-full border rounded lg:grid lg:grid-cols-3">
            <div class="border-r border-gray-300 lg:col-span-1">
                <div class="w-full flex justify-center my-52">
                    <div class="flex gap-5 justify-center items-center flex-col">
                        <img class="w-52 h-52 object-cover rounded-full"
                            src="https://cdn.pixabay.com/photo/2018/01/15/07/51/woman-3083383__340.jpg" alt="">
                        <h1 style="font-size: 20px"><b>{{ $users->user->name }}</b></h1>
                        <h5>J{{ $users->user->email }}</h5>
                    </div>
                </div>
            </div>

            <div class="hidden lg:col-span-2 lg:block">
                <div class="w-full">
                    <div class="relative flex justify-between items-center p-3 border-b border-gray-300">
                        <div class="flex items-center">

                            <img class="object-cover w-10 h-10 rounded-full"
                                src="https://cdn.pixabay.com/photo/2018/01/15/07/51/woman-3083383__340.jpg"
                                alt="username" />
                            <span class="block ml-2 font-bold text-gray-600">{{ $users->user->name }}</span>

                        </div>
                        <a href="{{ route('chats.index') }}">
                            ❌
                        </a>
                    </div>
                    <div class="relative w-full p-6 overflow-y-auto h-[40rem]">
                        <ul class="space-y-2">
                            @foreach ($messages as $message)
                                @if ($message->chat->user->id != Auth::user()->id)
                                    <li class="flex justify-start">
                                        <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow">
                                            <span class="block">{{ $message->message }}</span>
                                        </div>
                                    </li>
                                @else
                                    <li class="flex justify-end">
                                        <div
                                            class="relative max-w-xl px-4 py-2 text-gray-700 bg-gray-100 rounded shadow">
                                            <span class="block">{{ $message->message }}</span>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                            <li id="bubble"></li>
                        </ul>
                    </div>

                    <div class="flex items-center justify-between w-full p-3 border-t border-gray-300">
                        <input id="chatbox" type="text" placeholder="Message"
                            class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                            name="message" required />
                        <button type="click" onclick="clickme()">
                            <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function clickme() {
                const csrf = document.querySelector('meta[name="csrf-token"]').content;
                const text = document.querySelector('input[name="message"]').value;

                const data = {
                    chat_room_id: {!! request()->id !!},
                    user_id: {!! auth()->user()->id !!},
                    message: text,
                    _token: csrf,
                }

                const xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", `/message/${data.chat_room_id}/store`, true);
                xmlhttp.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
                xmlhttp.send(JSON.stringify(data));

                xmlhttp.onload = function () {
                    if(xmlhttp.status === 201) {
                        console.log(xmlhttp.response);
                        document.querySelector('input[name="message"]').value = '';
                    }
                }
            }

            const input = document.getElementById("chatbox");
            input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    clickme();
                }
            });
        </script>
    </body>
</x-app-layout>
