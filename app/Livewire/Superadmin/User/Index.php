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
    protected $paginationTheme = 'bootstrap'; 

    public $nama,
            $username,
            $telp,
            $password,
            $jk,
            $peran,
            $pengguna_id;

    public $paginate = '10',
            $filter = 'nama_pengguna',
            $search = '';

    public function render()
    {
        return view('livewire.superadmin.user.index', [
            'penggunas' => Pengguna::where($this->filter,'like', '%'. $this->search .'%')
            ->orWhere('username','like', '%'. $this->search .'%')
            ->latest()->paginate($this->paginate),
            'perans' => Role::latest()->get(),
        ]);
    }

    protected function rules()
    {
        return [
            'nama' => 'required|max:100|string',
            'username' => 'required|alpha_num|max:10|unique:penggunas,username,' . $this->pengguna_id,
            'telp' => 'required',
            'password' => $this->pengguna_id
                ? 'nullable|min:5|max:10'
                : 'required|min:5|max:10',
            'jk' => 'required|in:L,P',
            'peran' => 'required|exists:roles,id',
        ];
    }

    protected function messages()
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama max 100 huruf',
            'nama.string' => 'Nama tidak boleh mengandung angka',

            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah terdaftar',
            'username.max' => 'Username max 10 huruf',
            'username.alpha_num' => 'Username hanya boleh angka dan huruf',

            'telp.required' => 'Nomor telepon tidak boleh kosong',

            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password tidak boleh kurang dari 5 karakter',
            'password.max' => 'Password tidak boleh lebih dari 10 karakter',

            'jk.required' => 'Jenis Kelamin harus dipilih',
            'peran.required' => 'Peran harus dipilih',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function clean()
    {
        $this->resetValidation();
        $this->reset(['nama','username','password','jk','peran','telp']);
    }

    public function store()
    {
        $this->validate();

        Pengguna::create([
            'nama_pengguna' => $this->nama,
            'username' => $this->username,
            'telp' => $this->telp,
            'password' => Hash::make($this->password),
            'jk' => $this->jk,
            'role_id' => $this->peran,
        ]);

        $this->dispatch('closeCreateModal');
        $this->clean();
    }

    public function edit($id)
    {
        $this->clean();

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
        
        $this->validate();

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
        $this->clean();
    }

}
