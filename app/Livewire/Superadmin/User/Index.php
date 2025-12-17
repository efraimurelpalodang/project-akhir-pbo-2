<?php

namespace App\Livewire\Superadmin\User;

use App\Models\Pengguna;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $nama;
    public $username;
    public $telp;
    public $password;
    public $jk;
    public $peran;
    public $pengguna_id;
    public $paginate = '10';
    public $filter = 'nama_pengguna';
    public $search = '';
    protected $paginationTheme = 'bootstrap'; 

    public function render()
    {
        return view('livewire.superadmin.user.index', [
            'penggunas' => Pengguna::where($this->filter,'like', '%'. $this->search .'%')
            ->orWhere('username','like', '%'. $this->search .'%')
            ->latest()->paginate($this->paginate),
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
        $this->resetValidation();
        $this->reset(['nama','username','password','jk','peran','telp']);
    }

    public function edit($id)
    {
        $this->resetValidation();

        $pengguna = Pengguna::findOrFail($id);
        $this->nama = $pengguna->nama_pengguna;
        $this->username = $pengguna->username;
        $this->telp = $pengguna->telp;
        $this->password = '';
        $this->jk = $pengguna->jk;
        $this->peran = $pengguna->role_id;
        $this->pengguna_id = $pengguna->id;
    }

    public function update()
    {
        $pengguna = Pengguna::findOrFail($this->pengguna_id);
        
        $this->validate([
            'nama' => 'required|max:100|string',
            'username' => 'required|max:10|unique:penggunas,username,' . $this->pengguna_id,
            'telp' => 'required',
            'jk' => 'required|in:L,P',
            'peran' => 'required|exists:roles,id',
            'password' => 'nullable|min:5|max:10',
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

        $data = [
            'nama_pengguna' => $this->nama,
            'username' => $this->username,
            'telp' => $this->telp,
            'jk' => $this->jk,
            'role_id' => $this->peran,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $pengguna->update($data);
        $this->dispatch('closeEditModal');
    }

}
