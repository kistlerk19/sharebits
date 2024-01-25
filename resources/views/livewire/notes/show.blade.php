<?php

use Livewire\Volt\Component;
use Carbon\Carbon;
use App\Models\Note;

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

    // Delete a note
    public function delete($noteID)
    {
        $note = Note::where('id', $noteID)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">
                    no notes yet!
                </p>
                <p class="text-sm">
                    let's create your first note to share 😊.
                </p>
                <x-button primary icon="plus" class="mt-6 rounded-full" href="{{ route('notes.create') }}"
                    wire:navigate>add new note</x-button>
            </div>
        @else
        <x-button primary icon="plus" class="mt-6 mb-6 rounded-full" href="{{ route('notes.create') }}"
                    wire:navigate>create new note</x-button>
            <div class="grid grid-cols-2 gap-4 mt-12">
                @foreach ($notes as $note)
                    <x-card class="shadow-lg" wire:key='{{ $note->id }}'>
                        <div class="flex justify-between">
                            <div>
                                <a href="{{ route('note.edit', $note->id) }}" wire:navigate class="text-xl font:bold hover:underline hover:text-blue-500">
                                    {{ $note->title }}
                                </a>
                                <p class="mt-3 text-xs">{{ Str::limit($note->body, 100, '...') }}</p>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ Carbon::parse($note->send_date)->format('M-d-Y') }}
                            </div>
                        </div>
                        <div class="flex justify-between mt-6 space-x-1 flex-items-end">
                            <p class="text-xm">
                                Recipient: <span class="font-semibold">{{ $note->recipient }}</span>
                            </p>
                            <div>
                                <x-button.circle icon="eye"></x-button.circle>
                                <x-button.circle wire:click="delete('{{ $note->id }}')" class="text-red-900" icon="trash"></x-button.circle>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
