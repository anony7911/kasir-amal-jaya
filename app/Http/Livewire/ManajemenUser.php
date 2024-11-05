<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManajemenUser extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $name, $email, $password, $role, $user_id, $selected_id;
    public $perPage = 25;

    public function render()
    {
        // search
        $searchParams = '%'.$this->search.'%';
        return view('livewire.manajemen-user', [
            'users' => User::latest()->where('name', 'like', $searchParams)->orWhere('email', 'like', $searchParams)->paginate($this->perPage)
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput(){
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->role = null;
        $this->user_id = null;
    }

    public function cancel(){
        $this->resetInput();
        // close modal
        $this->dispatchBrowserEvent('closeModal');
    }

    public function edit($id){
        $user = User::find($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        // open modal
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'role.required' => 'Role tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => bcrypt($this->password),
        ]);

        session()->flash('message', 'User berhasil ditambahkan');
        $this->resetInput();
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'role' => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'role.required' => 'Role tidak boleh kosong',
        ]);

        $user = User::find($this->user_id);
        if($this->password != null){
            $this->validate([
                'password' => 'required|min:8',
            ],[
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
            ]);
            $user->update([
                'password' => bcrypt($this->password),
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);
        }else{
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
            ]);
        }

        $this->dispatchBrowserEvent('closeModal');
        $this->resetInput();
        session()->flash('message', 'User berhasil diupdate');
    }
}
