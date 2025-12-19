<?php

namespace App\Livewire\Satuan;

use App\Models\Satuan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; 
    
    public $nama,
            $deskripsi,
            $satuan_id;

    public $paginate,
            $search;

    public function rules()
    {
        return [
            'nama' => 'required|unique:satuans,nama,'. $this->satuan_id .'|string|max:20',
            'deskripsi' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama satuan tidak boleh kosong',
            'nama.unique' => 'Nama satuan Sudah Terdaftar',
            'nama.string' => 'Nama satuan tidak boleh mengandung karaker lain selain huruf',
            'nama.max' => 'Nama satuan tidak boleh panjang dari 20 huruf',

            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'deskripsi.string' => 'Deskripsi tidak boleh mengandung karaker lain selain huruf',
            'deskripsi.max' => 'Deskripsi tidak boleh panjang dari 100 huruf',
        ];
    }

    public function render()
    {
        return view('livewire.satuan.index', [
            'satuans' => Satuan::where('nama', 'like', '%'. $this->search .'%')
            ->latest()
            ->paginate($this->paginate)
        ]);
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function clean()
    {
        $this->resetValidation();
        $this->reset('nama','deskripsi');
    }

    public function store()
    {
        $this->validate();
        Satuan::create([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
        ]);

        $this->dispatch('closeCreateModal');
        $this->clean();
    }

    public function edit($id)
    {
        $this->clean();

        $satuan = Satuan::findOrFail($id);
        $this->nama = $satuan->nama;
        $this->deskripsi = $satuan->deskripsi;
        $this->satuan_id = $satuan->id;

    }

    public function update()
    {
        $this->validate();
        $satuan = Satuan::findOrFail($this->satuan_id);
        $satuan->update([
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi
        ]);
        
        $this->dispatch('closeEditModal');
        $this->clean();
    }
}
