<?php

namespace App\Http\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Distroy extends ModalComponent
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
        $this->closeModal();
    }

    //Delete Confirmation
    public function delete()
    {
        $user = User::where('id', $this->user);
        $user->delete();

        session()->flash('message', 'Student has been deleted successfully');

        $this->closeModal();
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }


    public function render()
    {
        return view('livewire.distroy');
    }
}
