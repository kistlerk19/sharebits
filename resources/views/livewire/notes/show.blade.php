<?php

use Livewire\Volt\Component;
use Carbon\Carbon;

new class extends Component {
    public function with()
    {
        return [
            'notes' => Auth::user()
                ->notes()
                ->orderBy('send_date', 'asc')
                ->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">
                No notes yet!
            </p>
            <p class="text-sm">
                Let's create your first note to share 😊.
            </p>
            <x-button primary icon="plus" class="mt-6 rounded-full" href="{{ route('notes.create') }}" wire:navigate>Create new note</x-button>
        </div>
        @else
        <div class="grid grid-cols-2 gap-4 mt-12">
            @foreach ($notes as $note)
            <x-card class="shadow-lg" wire:key='{{ $note->id }}'>
                <div class="flex justify-between">
                    <a href="#" class="text-xl font:bold hover:underline hover:text-blue-500">
                        {{ $note->title }}
                    </a>
                    <div class="text-sm text-gray-500">
                        {{ Carbon::parse($note->send_date)->format('M-d-Y') }}
                    </div>
                </div>
                <div class="flex justify-between mt-4 space-x-1 flex-items-end">
                    <p class="text-xm">
                        Recipient: <span class="font-semibold">{{ $note->recipient }}</span>
                    </p>
                </div>
                <div>
                    <x-button.circle icon="eye"></x-button.circle>
                    <x-button.circle icon="trash"></x-button.circle>
                </div>
            </x-card>
            @endforeach
        </div>
        @endif
    </div>
</div>
