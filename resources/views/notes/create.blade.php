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
    <x-app-layout>
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create a note') }}
            </h2>
        </x-slot>


        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900">
                    <livewire:notes.create />
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
