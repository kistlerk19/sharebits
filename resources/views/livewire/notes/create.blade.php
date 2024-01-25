<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);
        // dd($this->noteTitle, $this->noteBody, $this->noteRecipient, $this->noteSendDate);
        auth()->user()->notes()->create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => false,
        ]);

        return redirect(route('notes'));
    }
}; ?>

<div>
    <form class="space-y-4" wire:submit='submit'>
        <x-errors />
        <x-input wire:model='noteTitle' label='Title' placeholder='Enter the subject of your note' />
        <x-textarea wire:model='noteBody' label='Body' placeholder="Write your note here..." rows="5"></x-textarea>
        <x-input icon="user" wire:model='noteRecipient' type='mail' label='Recipient' placeholder="yourfriend@email.com"/>
        <x-input icon="calendar" wire:model='noteSendDate' type="date" label='Send Date' />

        <div class="pt-4">
            <x-button primary class="rounded-full" right-icon="calendar" spinner wire:click='submit'>Submit</x-button>
        </div>

    </form>
</div>
