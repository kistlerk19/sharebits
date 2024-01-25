<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        // $this->note = $note;
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;
    }

    public function updateNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

        $this->dispatch('note-saved');
    }
}; ?>
<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('edit note') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-2xl p-6 mx-auto text-gray-900 sm:px-6 lg:px-8">
            <form class="space-y-4" wire:submit='updateNote'>
                <x-errors />
                <x-action-message on="note-saved" class="text-white bg-indigo-300 rounded-full max-w-10"/>
                <x-input wire:model='noteTitle' label='Title' placeholder='Enter the subject of your note' />
                <x-textarea wire:model='noteBody' label='Body' placeholder="Write your note here..." rows="5"></x-textarea>
                <x-input icon="user" wire:model='noteRecipient' type='mail' label='Recipient' placeholder="yourfriend@email.com"/>
                <x-input icon="calendar" wire:model='noteSendDate' type="date" label='Send Date' />

                <x-checkbox label="Published" wire:model="noteIsPublished" />

                <div class="flex justify-between pt-4">
                    <x-button primary class="mr-2 rounded-full" spinner type="submit">save</x-button>
                    <x-button flat negative href="{{ route('notes') }}" class="rounded-full">cancel</x-button>
                </div>

            </form>
        </div>
    </div>
</div>
