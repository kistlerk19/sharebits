<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public function mount(Note $note)
    {
        // $this->note = $note;
        $this->authorize('update', $note);
        $this->fill($note);
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
