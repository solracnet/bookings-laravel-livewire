<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListUsers extends Component
{

    public $form = [];
    public User $user;
    public int $userIdBeingRemoved;

    public $showEditModal = false;

    public function addNew()
    {
        $this->form = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {
        $validatedData = Validator::make($this->form, [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ])->validate();
        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);
        // session()->flash('message', 'User added successfully!');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);

        $this->clearValidation();
    }

    public function edit(User $user)
    {
        $this->showEditModal = true;
        $this->user = $user;
        $this->form = $user->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->form, [
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users,email,'.$this->form['id'],
            'password' => 'sometimes|confirmed'
        ])->validate();
        if (!empty($validatedData['password'])){
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $this->user->update($validatedData);
        // session()->flash('message', 'User added successfully!');
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);

        $this->clearValidation();
    }

    public function confirmRemove($id)
    {
        $this->userIdBeingRemoved = $id;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);

        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-form', ['message' => 'User deleted successfully!']);
    }

    public function render()
    {
        $users = User::latest()->paginate(5);
        return view('livewire.admin.users.list-users', ['users' => $users]);
    }
}
