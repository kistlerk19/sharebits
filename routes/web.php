<?php

use App\Models\Note;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('notes', 'notes.index')
    ->middleware(['auth', 'verified'])
    ->name('notes');
Route::view('notes/create', 'notes.create')
    ->middleware(['auth', 'verified'])
    ->name('notes.create');

Volt::route('notes/{note}/edit', 'notes.edit')
    ->middleware(['auth', 'verified'])
    ->name('note.edit');

Route::get('notes/{note}', function (Note $note) {
    if($note->is_published)
    {
        abort(404);
    }
    $user = $note->user;

    return view('notes.display', ['note' => $note, 'user' => $user]);
})->name('notes.show');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
