<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $username;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $userId;
    public $editMode =false;
    protected $rules = [
        'username' => 'required',
        'firstName' => 'required',
        'lastName' => 'required',
        'password' => 'required',
        'email' => 'required|email',
    ];

    public function storeUser()
    {
        $this->validate();
        User::create([
            'username' => $this->username,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#userModal', 'actionModal' => 'hide']);
        session()->flash('message', 'User successfully created');
    }

    public function edit($id)
    {
        $u = User::where('id',$id)->first();
            $this->username = $u->username ;
            $this->firstName = $u->first_name ;
            $this->lastName = $u->last_name ;
            $this->email = $u->email ;
            $this->userId = $id;
            $this->editMode =true;
            $this->dispatchBrowserEvent('modal', ['modalId' => '#userModal', 'actionModal' => 'show']);
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#userModal', 'actionModal' => 'hide']);
    }

    public function update()
    {
        $this->validate();
        User::where('id',$this->userId)->update([
            'username' => $this->username,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            // 'password' => Hash::make($this->password),
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#userModal', 'actionModal' => 'hide']);
        session()->flash('message', 'User successfully updated');
    }

    public function delete($id)
    {
        $u = User::where('id',$id)->delete();
        $users = User::paginate(5);
        session()->flash('message', 'User successfully deleted');

    }
    public function render()
    {
        $users = User::where('username','like',"%{$this->search}%")->paginate(5);
        return view('livewire.users.user-index',
                            ['users'=>$users]
                    )->layout('layouts.main');
    }
}
