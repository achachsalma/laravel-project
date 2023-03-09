<?php

namespace App\Http\Livewire;

use App\Models\User;

use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $user;
    public $name;
    public $email;

    public function mount($user, $name, $email)
    {
        $this->user = $user;
        $this->email = $email;
        $this->name = $name;
        $this->closeModal();
    }

    public function update()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        //Add Student Data
        $user_update = User::where('id', $this->user)->first();
        $user_update->name = $this->name;
        $user_update->email = $this->email;

        $user_update->save();

        session()->flash('message', 'Student has been updated successfully');

        $this->closeModal();
    }
    public function create()
    {
        //on form submit validation
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        //Add Student Data
        $new_user = new User();
        $new_user->name = $this->name;
        $new_user->email = $this->email;

        $new_user->save();

        session()->flash('message', 'Student has been created successfully');

        $this->closeModal();
    }

    

    public function render()
    {
        return view('livewire.create');
    }
}
