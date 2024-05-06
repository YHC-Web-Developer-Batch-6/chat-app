<x-app-layout>
    <style>
        #bgchat {
            background: url('public/image/bg.jpg');
        }
    </style>
    <div class="min-w-full min-h-screen border rounded lg:grid lg:grid-cols-3 ">
        <div class="border-r border-gray-300 lg:col-span-1 max-h-screen max-sm:hidden">
            <div class="justify-end px-4 pt-4 ">
                <a href="{{ route('chats.index') }}">
                    ❌
                </a>
            </div>

            <div class="w-full flex justify-center items-center">
                <div class="flex gap-3 justify-center items-center flex-col">
                    <img class="w-52 h-52 object-cover rounded-full mt-40"
                        src="https://eu.ui-avatars.com/api/?name={{ $users->user->name }}" alt="">
                    <div class="text-center">
                        <h1><b>{{ $users->user->name }}</b></h1>
                        <h5>{{ $users->user->email }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class=" lg:col-span-2">
            <div class="w-full">
                <div class=" hidden max-sm:contents ml-4 flex-1 py-4">
                    <div class="justify-between bg-white p-3 flex">
                        <div class="flex text-center items-center">
                            <img class="w-10 h-10 object-cover rounded-full "
                            src="https://eu.ui-avatars.com/api/?name={{ $users->user->name }}" alt="">
                            <p class="text-grey-darkest ml-4">
                                {{ $users->user->name }}
                            </p>
                        </div>
                        <div class=" content-center">
                            <a class="" href="{{ route('chats.index') }}">
                                ❌
                            </a>
                        </div>
                    </div>
                </div>
                <div class=" w-full px-5 flex flex-col justify-between h-[600px]">
                    <div class="relative flex flex-col mt-5 overflow-y-auto mb-16 sm:mb-0" id="messageContainer">
                    </div>
                </div>

                <div class="flex items-center justify-between w-full px-5 pt-3 pb-3 border-t border-gray-300 max-sm:fixed max-sm:bottom-0 bg-white">
                    <input id="chatbox" type="text" placeholder="Message"
                        class="block w-full pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700"
                        name="message" required />
                    <button type="click" onclick="sendMessage()">
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

</x-app-layout>

<script>
    $(document).ready(function () {
        // Load chat
        const request = function () { 
            $.ajax({
                type: 'GET',
                url: '{{ route("chat.response", ["id" => request()->id]) }}',
                dataType: 'json',
                success: function (res) {
                    $.each(res.data, function (i, data) {
                        const text = data.message;
                        const timestamp = data.created_at;
                        const time = timestamp.substring(11, 16);
                        const userId = {!! auth()->user()->id !!};

                        if (data.chat.user_id != userId) {
                            $('#messageContainer').append(
                                `<div class="flex justify-start mb-2">
                                    <div
                                        class="ml-2 py-3 px-4 bg-gray-500 rounded-br-3xl rounded-tr-3xl rounded-tl-xl text-white max-w-[50%] grid">
                                        <p class="font-medium" style="word-break: break-word;">
                                            ${text}
                                        </p>
                                        <span class="text-slate-300 text-xs mt-2 text-right">
                                            ${time}
                                        </span>
                                    </div>
                                </div>`
                            );
                        } else {
                            $('#messageContainer').append(
                                `<div class="flex justify-end mb-2">
                                    <div
                                        class="mr-2 py-3 px-4 bg-gray-300 rounded-bl-3xl rounded-tl-3xl rounded-tr-xl text-black max-w-[50%] grid">
                                        <p class="font-medium" style="word-break: break-word;">
                                            ${text}
                                        </p>
                                        <span class="text-slate-500 text-xs mt-2">
                                            ${time}
                                        </span>
                                    </div>
                                </div>`
                            );
                        }
                    })

                    const messageContainer = document.getElementById('messageContainer');
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                },
                error: function () {
                    console.log(data);
                }
            });
        };

        request();

        // Pusher event
        Pusher.logToConsole = true;

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

        const roomId = {!! request()->id !!};
        const channel = pusher.subscribe(`private-room.channel.${roomId}`);

        channel.bind("chat-message-event", function(data) {
            request();
        });
    });
</script>

<script>
    function sendMessage() {
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

        xmlhttp.onload = function() {
            if (xmlhttp.status === 201) {
                console.log(xmlhttp.response);
                document.querySelector('input[name="message"]').value = '';
            }
        }
    }

    const input = document.getElementById("chatbox");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            sendMessage();
        }
    });
</script>
