<?php

namespace App\Http\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public $name, $email, $password;
    
    public function storeUserData()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);


        //Add Student Data
        $new_user = new User();
        $new_user->name = $this->name;
        $new_user->email = $this->email;
        $new_user->password = $this->password;


        $new_user->save();


        session()->flash('message', 'New User has been added successfully');


        //For hide modal after add user success
        $this->closeModal();
    }
    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.edit');
    }
}
