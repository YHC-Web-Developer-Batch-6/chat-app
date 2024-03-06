<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                <div class="w-10 h-10 bg-black m-3"></div>
                <div class="p-6 text-gray-900">
                    <div class="ms-auto">
                        <h1 class="text-2xl">Nama Pengirim</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. illo eveniet quas quis velit quae
                            maxime, laudantium quibusdam accusamus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-3">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Chat') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
