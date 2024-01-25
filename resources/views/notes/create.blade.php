
<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('create a note') }}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="max-w-2xl p-6 mx-auto text-gray-900 sm:px-6 lg:px-8">
                <x-button icon="arrow-left" secondary href="{{ route('notes') }}" class="rounded-full">All notes</x-button>
                <livewire:notes.create />
            </div>
        </div>
    </x-app-layout>
</div>
