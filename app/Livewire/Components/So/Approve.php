<?php

namespace App\Livewire\Components\So;

use App\Models\Barang;
use App\Models\Pembeli;
use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Approve extends Component
{
    public $id, $title;
    
    // Sales Order
    public $so_id = null;
    public $pembeli_nama = '';
    public $tanggal_so;
    public $status = 'menunggu';
    
    // Items
    public $items = [];
    
    protected $listeners = [
        'viewSO' => 'loadDetailSO',
    ];

    // Load Detail SO untuk ditampilkan
    public function loadDetailSO($id)
    {
        $so = SalesOrder::with(['pembeli', 'details.barang'])->findOrFail($id);
        
        $this->so_id = $so->id;
        $this->pembeli_nama = $so->pembeli->nama_pembeli;
        $this->tanggal_so = $so->tanggal_so;
        $this->status = $so->status;
        
        $this->items = $so->details->map(function($detail) {
            return [
                'barang_id' => $detail->barang_id,
                'barang_nama' => $detail->barang->nama_barang,
                'jumlah' => $detail->jumlah,
                'harga_satuan' => $detail->harga_satuan,
            ];
        })->toArray();
    }

    // Computed property untuk grand total
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

    // Get nama status yang user-friendly
    public function getStatusLabelProperty()
    {
        $labels = [
            'menunggu' => 'Menunggu Persetujuan',
            'proses_persiapan' => 'Proses Persiapan',
            'siap_kirim' => 'Siap Dikirim',
            'dikirim' => 'Sudah Dikirim',
        ];
        
        return $labels[$this->status] ?? $this->status;
    }

    // Get badge class untuk status
    public function getStatusBadgeProperty()
    {
        $badges = [
            'menunggu' => 'badge-warning',
            'proses_persiapan' => 'badge-info',
            'siap_kirim' => 'badge-primary',
            'dikirim' => 'badge-success',
        ];
        
        return $badges[$this->status] ?? 'badge-secondary';
    }

    // Approve pesanan (ubah status ke status berikutnya)
    public function approvePesanan()
    {
        try {
            DB::beginTransaction();

            $so = SalesOrder::findOrFail($this->so_id);
            
            // Logic perpindahan status
            $nextStatus = match($so->status) {
                'menunggu' => 'proses_persiapan',
                'proses_persiapan' => 'siap_kirim',
                'siap_kirim' => 'dikirim',
                default => $so->status // Kalau sudah dikirim, gak berubah
            };

            // Update status
            $so->update(['status' => $nextStatus]);

            DB::commit();

            $this->status = $nextStatus;
            
            session()->flash('message', 'Pesanan berhasil diupdate ke status: ' . $this->statusLabel);
            $this->dispatch('closeModal');
            $this->dispatch('refresh-table');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error approve pesanan: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Batalkan pesanan
    public function batalkanPesanan()
    {
        try {
            DB::beginTransaction();

            $so = SalesOrder::findOrFail($this->so_id);
            
            // Bisa tambahkan validasi, misal cuma bisa dibatalkan kalau status masih menunggu
            if ($so->status !== 'menunggu') {
                session()->flash('error', 'Pesanan hanya bisa dibatalkan saat status Menunggu Persetujuan');
                return;
            }

            // Soft delete atau ubah status jadi 'dibatalkan'
            // Option 1: Soft delete
            $so->delete();
            
            // Option 2: Tambah status 'dibatalkan' di enum
            // $so->update(['status' => 'dibatalkan']);

            DB::commit();

            session()->flash('message', 'Pesanan berhasil dibatalkan');
            $this->dispatch('closeModal');
            $this->dispatch('refresh-table');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error batalkan pesanan: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Get text tombol approve berdasarkan status
    public function getApproveButtonTextProperty()
    {
        return match($this->status) {
            'menunggu' => 'Mulai Persiapan',
            'proses_persiapan' => 'Tandai Siap Kirim',
            'siap_kirim' => 'Tandai Sudah Dikirim',
            'dikirim' => 'Pesanan Selesai',
            default => 'Approve'
        };
    }

    // Cek apakah pesanan bisa di-approve lagi
    public function getCanApproveProperty()
    {
        return $this->status !== 'dikirim';
    }

    // Cek apakah pesanan bisa dibatalkan
    public function getCanCancelProperty()
    {
        return $this->status === 'menunggu';
    }

    public function mount($id = '', $title = '')
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.components.so.approve');
    }
}