<?php

namespace App\Livewire\Barang;

use App\Models\Barang;
use App\Models\Satuan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; 

    public $nama,
            $kode,
            $harga,
            $stok,
            $satuan,
            $barang_id;

    public $filter = 'nama_barang',
            $paginate = '10',
            $search = '';

    protected function rules()
    {
        return [
            'nama'  => 'required|regex:/^[A-Za-z0-9 ]+$/|max:100|unique:barangs,nama_barang,' . $this->barang_id,
            'kode'  => 'required|alpha_num|max:20|unique:barangs,kode,' . $this->barang_id,
            'harga' => 'required|numeric|min:0',
            'stok'  => 'required|integer|min:0',
            'satuan' => 'required|exists:satuans,id',
        ];
    }

    protected function messages()
    {
        return [
            'nama.required' => 'Nama barang wajib diisi',
            'nama.regex' => 'Nama barang hanya boleh menggunakan huruf dan angka',
            'nama.max' => 'Nama barang maksimal 100 karakter',
            'nama.unique' => 'Nama barang sudah digunakan',

            'kode.required' => 'Kode barang wajib diisi',
            'kode.alpha_num' => 'Kode barang hanya boleh huruf dan angka tanpa spasi',
            'kode.unique' => 'Kode barang sudah digunakan',
            'kode.max' => 'Kode barang maksimal 20 karakter',

            'harga.required' => 'Harga barang wajib diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'harga.min' => 'Harga tidak boleh kurang dari 0',

            'stok.required' => 'Stok barang wajib diisi',
            'stok.integer' => 'Stok harus berupa angka bulat',
            'stok.min' => 'Stok tidak boleh kurang dari 0',

            'peran.required' => 'Satuan harus dipilih',
            'peran.exists' => 'Satuan tidak valid',
        ];
    }


    public function render()
    {
        return view('livewire.barang.index', [
            'barangs' => Barang::where($this->filter, 'like', '%'. $this->search .'%')
            ->paginate($this->paginate),
            'satuans' => Satuan::all()
        ]);
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function clean()
    {
        $this->resetValidation();
        $this->reset(['nama','kode','satuan','harga','stok']);
    }

    public function store()
    {
        $this->validate();
        Barang::create([
            'satuan_id' => $this->satuan,
            'kode' => $this->kode,
            'nama_barang' => $this->nama,
            'harga_jual' => $this->harga,
            'jumlah_stok' => $this->stok,
        ]);

        $this->dispatch('closeCreateModal');
        $this->clean();
    }

    public function edit($id)
    {
        $this->clean();

        $barang = Barang::findOrFail($id);
        $this->kode = $barang->kode;
        $this->nama = $barang->nama_barang;
        $this->harga = $barang->harga_jual;
        $this->stok = $barang->jumlah_stok;
        $this->satuan = $barang->satuan_id;
        $this->barang_id = $barang->id;
    }

    public function update()
    {
        $barang = Barang::findOrFail($this->barang_id);
        $this->validate();
        $barang->update([
            'satuan_id' => $this->satuan,
            'kode' => $this->kode,
            'nama_barang' => $this->nama,
            'harga_jual' => $this->harga,
            'jumlah_stok' => $this->stok,
        ]);

        $this->dispatch('closeEditModal');
        $this->clean();
    }
}
