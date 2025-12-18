<?php

namespace App\Livewire\Pembeli;

use App\Models\Pembeli;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; 

    public $search = '',
            $paginate = '10';

    public $nama,
            $alamat,
            $telp,
            $pembeli_id;

    public function rules()
    {
        return [
            'nama' => 'required|string|max:80|regex:/^[a-zA-Z\s]+$/',
            'alamat'       => 'required|string',
            'telp'         => 'required|string|max:15|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama pembeli wajib diisi.',
            'nama.string'   => 'Nama pembeli harus berupa teks.',
            'nama.max'      => 'Nama pembeli maksimal 80 karakter.',
            'nama.regex'    => 'Nama pembeli hanya boleh berisi huruf dan spasi.',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string'   => 'Alamat harus berupa teks.',

            'telp.required' => 'Nomor telepon wajib diisi.',
            'telp.string'   => 'Nomor telepon harus berupa teks.',
            'telp.max'      => 'Nomor telepon maksimal 15 digit.',
            'telp.regex'    => 'Nomor telepon hanya boleh berisi angka.',
        ];
    }
    
    public function render()
    {
        return view('livewire.pembeli.index', [
            'pembelis' => Pembeli::where('nama_pembeli', 'like', '%'. $this->search .'%')
            ->latest()
            ->paginate($this->paginate)
        ]);
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['nama','telp','alamat']);
    }

    public function store()
    {
        $this->validate();
        Pembeli::create([
            'nama_pembeli' => $this->nama,
            'telp' => $this->telp,
            'alamat' => $this->alamat
        ]);

        $this->dispatch('closeCreateModal');
        $this->resetValidation();
        $this->reset(['nama','telp','alamat']);
    }
    
    public function edit($id)
    {
        $this->resetValidation();
        $this->reset(['nama','telp','alamat']);

        $pembeli = Pembeli::findOrFail($id);
        $this->nama = $pembeli->nama_pembeli;
        $this->telp = $pembeli->telp;
        $this->alamat = $pembeli->alamat;
        $this->pembeli_id = $pembeli->id;
    }

    public function update()
    {
        $pembeli = Pembeli::findOrFail($this->pembeli_id);
        $this->validate();

        $pembeli->update([
            'nama_pembeli' => $this->nama,
            'telp' => $this->telp,
            'alamat' => $this->alamat
        ]);

        $this->dispatch('closeEditModal');
        $this->resetValidation();
        $this->reset(['nama','telp','alamat']);
    }
}
