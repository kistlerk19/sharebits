<?php

use Livewire\Volt\Component;

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
    @foreach ($notes as $note)
        <li>
            {{ $note->title }}
        </li>
    @endforeach
</div>
