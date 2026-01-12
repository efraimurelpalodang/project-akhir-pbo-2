<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\Barang;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $transaksiHariIni = SalesOrder::whereDate('tanggal_so', Carbon::today())
            ->sum('total_harga');
        $totalPenjualan = SalesOrder::sum('total_harga');
        $barangRestock = Barang::whereColumn('stok', '<=', 'stok_minimal')->count();
        $pesananMenunggu = SalesOrder::where('status', 'menunggu')->count();

        return view('livewire.dashboard', [
            'transaksiHariIni' => $transaksiHariIni,
            'totalPenjualan'   => $totalPenjualan,
            'barangRestock'    => $barangRestock,
            'pesananMenunggu'  => $pesananMenunggu,
        ]);
    }
}
