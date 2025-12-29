<?php

namespace App\Livewire\Components\So;

use Livewire\Component;
use App\Models\Pembeli;
use App\Models\Barang;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormModal extends Component
{
    public $id, $title, $rightBtn, $event, $pembelis;
    
    // Pembeli
    public $pembeli_nama = '';
    public $pembeli_id = null;
    public $pembeliSuggestions = [];
    public $originalData = [];
    
    // Sales Order
    public $so_id = null;
    public $tanggal_so;
    public $status = 'menunggu';
    public $mode = 'view'; 
    
    // Items
    public $items = [];
    
    protected $listeners = [
        'resetForm' => 'resetForm',
        'closeCreateModal' => 'resetForm',
        'editSO' => 'edit', 
        'viewSO' => 'loadDetailSO',
        'createSO' => 'openCreateMode',
    ];

    protected function rules()
    {
        return [
            'pembeli_id' => 'required|exists:pembelis,id',
            'tanggal_so' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|numeric|min:0',
        ];
    }

    protected function messages()
    {
        return [
            'pembeli_id.required' => 'Pembeli harus dipilih',
            'pembeli_id.exists' => 'Pembeli tidak valid',
            'tanggal_so.required' => 'Tanggal SO harus diisi',
            'items.required' => 'Minimal harus ada 1 barang',
            'items.*.barang_id.required' => 'Barang harus dipilih',
            'items.*.barang_id.exists' => 'Barang tidak valid',
            'items.*.jumlah.required' => 'Jumlah harus diisi',
            'items.*.jumlah.min' => 'Jumlah minimal 1',
            'items.*.harga_satuan.required' => 'Harga satuan harus ada',
        ];
    }

    // Pembeli Autocomplete
    public function updatedPembeliNama()
    {
        if (strlen($this->pembeli_nama) < 1) {
            $this->pembeliSuggestions = [];
            $this->pembeli_id = null;
            return;
        }

        $this->pembeliSuggestions = Pembeli::where('nama_pembeli', 'like', '%' . $this->pembeli_nama . '%')
            ->limit(5)
            ->get();
    }

    public function pilihPembeli($id, $nama)
    {
        $this->pembeli_id = $id;
        $this->pembeli_nama = $nama;
        $this->pembeliSuggestions = [];
    }

    public function updatedItems($value, $key)
    {
        $parts = explode('.', $key);
        
        if (count($parts) !== 2) {
            return;
        }

        $index = (int) $parts[0];
        $field = $parts[1];

        if ($field !== 'barang_nama') {
            return;
        }

        if (!array_key_exists($index, $this->items)) {
            return;
        }

        $barangNama = $this->items[$index]['barang_nama'] ?? '';

        if ($this->items[$index]['barang_id'] ?? null) {
            $this->items[$index]['barang_id'] = null;
            $this->items[$index]['harga_satuan'] = 0;
        }

        if (empty($barangNama) || strlen($barangNama) < 1) {
            $this->items[$index]['suggestions'] = [];
            return;
        }

        $results = Barang::where('nama_barang', 'like', '%' . $barangNama . '%')
            ->limit(5)
            ->get();

        $this->items[$index]['suggestions'] = $results->toArray();
    }

    public function cariBarang($index, $value)
    {   
        if (!array_key_exists($index, $this->items)) {
            return;
        }

        $this->items[$index]['barang_nama'] = $value;

        if ($this->items[$index]['barang_id'] ?? null) {
            $this->items[$index]['barang_id'] = null;
            $this->items[$index]['harga_satuan'] = 0;
        }

        if (empty($value) || strlen($value) < 1) {
            $this->items[$index]['suggestions'] = [];
            return;
        }

        $results = Barang::where('nama_barang', 'like', '%' . $value . '%')
            ->limit(5)
            ->get();

        $this->items[$index]['suggestions'] = $results->toArray();
    }

    public function pilihBarang($index, $id, $nama)
    {
        if (!array_key_exists($index, $this->items)) {
            return;
        }
        
        $barang = Barang::find($id);
        
        $this->items[$index]['barang_id'] = $id;
        $this->items[$index]['barang_nama'] = $nama;
        $this->items[$index]['harga_satuan'] = $barang->harga_jual ?? 0;
        $this->items[$index]['suggestions'] = [];
        
        $this->resetErrorBag('items.' . $index . '.barang_id');
        
        $this->dispatch('barang-dipilih-' . $index, nama: $nama);
    }

    public function getGrandTotalProperty()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $harga = is_numeric($item['harga_satuan'] ?? 0) ? (float) $item['harga_satuan'] : 0;
            $jumlah = is_numeric($item['jumlah'] ?? 0) ? (float) $item['jumlah'] : 0;
            $total += $harga * $jumlah;
        }
        return $total;
    }

    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $so = SalesOrder::create([
                'pembeli_id' => $this->pembeli_id,
                'pengguna_id' => 1,
                'tanggal_so' => $this->tanggal_so,
                'status' => $this->status,
                'total_harga' => $this->grandTotal,
            ]);

            foreach ($this->items as $item) {
                SalesOrderDetail::create([
                    'so_id' => $so->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan'],
                ]);
            }

            DB::commit();

            session()->flash('message', 'Sales Order berhasil dibuat!');
            $this->resetForm();
            $this->dispatch('closeCreateModal');
            $this->dispatch('refresh-table');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating sales order: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->resetForm();
        
        $so = SalesOrder::with('pembeli', 'details.barang')->findOrFail($id);
        
        // Langsung isi variable 
        $this->so_id = $so->id;
        $this->pembeli_id = $so->pembeli_id;
        $this->pembeli_nama = $so->pembeli->nama_pembeli;
        $this->tanggal_so = $so->tanggal_so;
        $this->status = $so->status;

        // Isi items dari detail
        $this->items = [];
        foreach ($so->details as $detail) {
            $this->items[] = [
                'barang_id' => $detail->barang_id,
                'barang_nama' => $detail->barang->nama_barang,
                'jumlah' => $detail->jumlah,
                'harga_satuan' => $detail->harga_satuan,
                'suggestions' => [],
            ];
        }
    }

    public function update()
    {
        try {
            $this->resetValidation();
            
            $this->validate();

            DB::beginTransaction();

            $so = SalesOrder::findOrFail($this->so_id);

            $so->update([
                'pembeli_id' => $this->pembeli_id,
                'tanggal_so' => $this->tanggal_so,
                'status' => $this->status,
                'total_harga' => $this->grandTotal,
            ]);

            $so->details()->delete();
            
            foreach ($this->items as $item) {
                SalesOrderDetail::create([
                    'so_id' => $so->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga_satuan'],
                ]);
            }

            DB::commit();

            $this->resetForm();
            $this->dispatch('closeEditModal');
            $this->dispatch('refresh-table');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating sales order: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Item Management
    public function tambahItem()
    {
        $this->items[] = [
            'barang_id' => null,
            'barang_nama' => '',
            'jumlah' => 1,
            'harga_satuan' => 0,
            'suggestions' => [],
        ];
    }

    public function hapusItem($index)
    {
        if (count($this->items) <= 1) {
            session()->flash('error', 'Minimal harus ada 1 barang!');
            return;
        }

        if (array_key_exists($index, $this->items)) {
            unset($this->items[$index]);
            $this->items = array_values($this->items);
        }
    }

    // Lifecycle
    public function mount($id = '', $title = '', $rightBtn = '', $event = '', $pembelis = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->rightBtn = $rightBtn;
        $this->event = $event;
        $this->pembelis = $pembelis;
        $this->tanggal_so = now()->format('Y-m-d');
        $this->initItems();
    }

    public function initItems()
    {
        $this->items = [
            [
                'barang_id' => null,
                'barang_nama' => '',
                'jumlah' => 1,
                'harga_satuan' => 0,
                'suggestions' => [],
            ]
        ];
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset([
            'pembeli_id',
            'pembeli_nama',
            'pembeliSuggestions',
            'so_id',
            'tanggal_so',
        ]);
        $this->status = 'menunggu';
        $this->initItems();
    }

    public function render()
    {
        return view('livewire.components.so.form-modal');
    }
    
    public function openCreateMode()
    {
        $this->reset(['pembeli_nama', 'pembeli_id', 'tanggal_so', 'items']);
        $this->mode = 'create';
        $this->items = [
            ['barang_id' => null, 'barang_nama' => '', 'jumlah' => 1, 'harga_satuan' => 0, 'suggestions' => []]
        ];
    }
    
    // Untuk buka modal VIEW (detail)
    public function loadDetailSO($id)
    {
        $so = SalesOrder::with(['pembeli', 'details.barang'])->find($id);
        
        $this->pembeli_nama = $so->pembeli->nama_pembeli;
        $this->pembeli_id = $so->pembeli_id;
        $this->tanggal_so = $so->tanggal_so;
        
        $this->items = $so->details->map(function($detail) {
            return [
                'barang_id' => $detail->barang_id,
                'barang_nama' => $detail->barang->nama_barang,
                'jumlah' => $detail->jumlah,
                'harga_satuan' => $detail->harga_satuan,
                'suggestions' => []
            ];
        })->toArray();
        
        $this->originalData = [
            'pembeli_nama' => $this->pembeli_nama,
            'pembeli_id' => $this->pembeli_id,
            'tanggal_so' => $this->tanggal_so,
            'items' => $this->items
        ];
        
        $this->mode = 'view';
    }
    
    public function enableEditMode()
    {
        $this->mode = 'edit';
    }
    
    // Batalkan edit
    public function batalEdit()
    {
        $this->pembeli_nama = $this->originalData['pembeli_nama'];
        $this->pembeli_id = $this->originalData['pembeli_id'];
        $this->tanggal_so = $this->originalData['tanggal_so'];
        $this->items = $this->originalData['items'];
        
        $this->mode = 'view';
    }
    
    // Simpan perubahan (untuk edit)
    public function simpanPerubahan()
    {
        $this->validate();

        $this->mode = 'view';
        $this->dispatch('closeModal');
    }
    
}