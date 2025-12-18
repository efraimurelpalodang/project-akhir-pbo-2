<?php

namespace App\Livewire\Superadmin\Peran;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $paginate;
    public $nama;
    public $deskripsi;
    public $peran_id;

    public function rules()
    {
        return [
            'nama' => 'required|unique:roles,nama_peran|string|max:20',
            'deskripsi' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama Peran tidak boleh kosong',
            'nama.unique' => 'Nama Peran Sudah Terdaftar',
            'nama.string' => 'Nama Peran tidak boleh mengandung karaker lain selain huruf',
            'nama.max' => 'Nama Peran tidak boleh panjang dari 20 huruf',

            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.string' => 'Deskripsi tidak boleh mengandung karaker lain selain huruf',
            'deskripsi.max' => 'Deskripsi tidak boleh panjang dari 100 huruf',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.superadmin.peran.index',[
            'perans' => Role::where('nama_peran', 'like', '%'. $this->search .'%')->latest()->paginate($this->paginate)
            ]
        );
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['nama','deskripsi']);
    }

    public function store()
    {
        $this->validate();

        Role::create([
            'nama_peran' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);

        $this->dispatch('closeCreateModal');
        $this->resetValidation();
        $this->reset(['nama','deskripsi']);
    }

    public function edit($id)
    {
        $peran = Role::findOrFail($id);
        $this->nama = $peran->nama_peran;
        $this->deskripsi = $peran->deskripsi;
        $this->peran_id = $peran->id;
    }

    public function update()
    {
        $role = Role::findOrFail($this->peran_id);
        
        $this->validate();

        $role->update([
            'nama_peran' => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);

        $this->dispatch('closeEditModal');
        $this->resetValidation();
        $this->reset(['nama','deskripsi']);
    }
}
