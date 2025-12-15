<?php

namespace App\Livewire\Superadmin\User;

use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Index extends Component
{
    public $nama;
    public $username;
    public $telp;
    public $password;
    public $jk;
    public $peran;

    public function render()
    {
        return view('livewire.superadmin.user.index', [
            'penggunas' => Pengguna::latest()->get(),
            'perans' => Role::latest()->get(),
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['nama','username','password','jk','peran','telp']);
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|max:100|string',
            'username' => 'required|unique:penggunas,username|max:10',
            'telp' => 'required',
            'password' => 'required|min:5|max:10',
            'jk' => 'required|in:L,P',
            'peran' => 'required|exists:roles,id',
        ],
        [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama max 100 huruf',
            'nama.string' => 'Nama tidak boleh mengandung angka',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah terdaftar',
            'username.max' => 'Username max 10 huruf',
            'telp.required' => 'Nomor telepon tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password tidak boleh kurang dari 5 karakter',
            'password.max' => 'Password tidak boleh lebih dari 10 karakter',
            'jk.required' => 'Jenis Kelamin harus dipilih',
            'peran.required' => 'Peran harus dipilih',
        ]);

        Pengguna::create([
            'nama_pengguna' => $this->nama,
            'username' => $this->username,
            'telp' => $this->telp,
            'password' => Hash::make($this->password),
            'jk' => $this->jk,
            'role_id' => $this->peran,
        ]);

        $this->dispatch('closeCreateModal');
    }
}
