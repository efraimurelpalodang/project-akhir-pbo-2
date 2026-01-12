<?php

namespace App\Livewire\Components\So;

use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

        $this->items = $so->details->map(function ($detail) {
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
            'batal' => 'badge-danger',
            'proses_persiapan' => 'badge-info',
            'siap_kirim' => 'badge-primary',
            'dikirim' => 'badge-success',
        ];

        return $badges[$this->status] ?? 'badge-secondary';
    }

    // Method untuk membuat transaksi penjualan
    private function createTransaksiPenjualan($so)
    {
        // Hitung total harga
        $totalHarga = $so->details->sum(function ($detail) {
            return $detail->jumlah * $detail->harga_satuan;
        });

        // Buat transaksi penjualan
        $transaksi = TransaksiPenjualan::create([
            'pengguna_id' => Auth::id(), // ID user yang login
            'so_id' => $so->id,
            'tanggal_transaksi' => now()->format('Y-m-d'),
            'tanggal_antar' => now()->addDays(3)->format('Y-m-d'), // Estimasi 3 hari dari sekarang, bisa disesuaikan
            'total_harga' => $totalHarga,
        ]);

        // Buat detail transaksi penjualan dari detail SO
        foreach ($so->details as $detail) {
            TransaksiPenjualanDetail::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $detail->barang_id,
                'jumlah' => $detail->jumlah,
                'harga_satuan' => $detail->harga_satuan,
            ]);
        }

        return $transaksi;
    }

    // Approve pesanan (ubah status ke status berikutnya)
    public function approvePesanan()
    {
        try {
            DB::beginTransaction();

            $so = SalesOrder::with('details')->findOrFail($this->so_id);

            // Simpan status sebelumnya
            $previousStatus = $so->status;

            // Logic perpindahan status
            $nextStatus = match ($so->status) {
                'menunggu' => 'proses_persiapan',
                'proses_persiapan' => 'siap_kirim',
                'siap_kirim' => 'dikirim',
                default => $so->status
            };

            // Jika status berubah dari menunggu ke proses_persiapan, buat transaksi penjualan
            if ($previousStatus === 'menunggu' && $nextStatus === 'proses_persiapan') {
                // Cek apakah transaksi untuk SO ini sudah ada
                $existingTransaksi = TransaksiPenjualan::where('so_id', $so->id)->first();

                if (!$existingTransaksi) {
                    $this->createTransaksiPenjualan($so);
                    Log::info("Transaksi penjualan berhasil dibuat untuk SO ID: {$so->id}");
                }
            }

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

            // cuma bisa dibatalkan kalau status masih menunggu
            if ($so->status !== 'menunggu') {
                session()->flash('error', 'Pesanan hanya bisa dibatalkan saat status Menunggu Persetujuan');
                return;
            }

            $so->update(['status' => 'dibatalkan']);

            DB::commit();

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
        return match ($this->status) {
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
