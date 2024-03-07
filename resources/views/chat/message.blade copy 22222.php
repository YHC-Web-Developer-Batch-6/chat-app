<x-app-layout>
    <div class="min-w-full border rounded lg:grid lg:grid-cols-3 ">
        <div class="border-r border-gray-300 lg:col-span-1">
            <div class="justify-end px-4 pt-4 ">
                <a href="{{ route('chats.index') }}">
                    ❌
                </a>
            </div>

            <div class="w-full flex justify-center my-52">
                <div class="flex gap-5 justify-center items-center flex-col">
                    <img class="w-52 h-52 object-cover rounded-full"
                        src="https://cdn.pixabay.com/photo/2018/01/15/07/51/woman-3083383__340.jpg" alt="">
                    <h1 style="font-size: 20px"><b>{{ $users->user->name }}</b></h1>
                    <h5>{{ $users->user->email }}</h5>
                </div>
            </div>
        </div>
        <div class="hidden lg:col-span-2 lg:block ">
            <div class="w-full">

                <div class=" w-full px-5 flex flex-col justify-between h-[650px]">
                    <div class="relative flex flex-col mt-5 overflow-y-scroll ">

                        @foreach ($messages as $message)
                            @if ($message->chat->user->id != Auth::user()->id)
                                <div class="flex justify-start mb-4">

                                    <div
                                        class="ml-2 py-3 px-4 bg-gray-500 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white w-1/2">
                                        {{ $message->message }}
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-end mb-4">

                                    <div
                                        class="mr-2 py-3 px-4 bg-gray-300 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-black w-1/2">
                                        {{ $message->message }}
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-between w-full px-5 py-8 border-t border-gray-300">
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

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        let token = document.querySelector('meta[name="csrf-token"]').content;

        const pusher = new Pusher('{!! env('PUSHER_APP_KEY') !!}', {
            cluster: "ap1",
            channelAuthorization: {
                endpoint: "/broadcasting/auth",
                headers: { "X-CSRF-Token": token },
            },
        });

        const roomId = {!! request()->id !!};
        const channel = pusher.subscribe(`private-room.channel.${roomId}`);

        channel.bind("chat-message-event", function (data) {
            window.location.href = `/message/${roomId}`;
        });
    </script>
</x-app-layout>
