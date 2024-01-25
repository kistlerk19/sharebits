<x-guest-layout>
    <div class="container justify-between">
        <h2 class="text-xl font-bold leading-tight text-gray-800">
            {{ $note->title }}
        </h2>
        <p class="mt-2">{{ $note->body }}</p>

        <div class="flex items-center justify-end mt-12 space-x-2">
            <h3 class="text-sm"><span class="font-bold">Sent from:</span> {{ $user->name }}</h3>
            <livewire:heartreact :note='$note' />
        </div>
    </div>
</x-guest-layout>
