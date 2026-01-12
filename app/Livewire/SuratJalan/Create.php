<?php

namespace App\Livewire\SuratJalan;

use App\Models\Pembeli;
use Livewire\Component;
use App\Models\SalesOrder;

class Create extends Component
{
    public $paginate = '10',
        $search = '',
        $filter = 'nama_pembeli';

    public function render()
    {
        $query = SalesOrder::query()->where('status', 'siap_kirim');

        $query->where(function ($q) {   
            $q->whereHas('pembeli', function ($q2) {
                $q2->where('nama_pembeli', 'like', '%' . $this->search . '%');
            })
                ->orWhereDate('tanggal_so', $this->search);
        });

        return view('livewire.surat-jalan.create', [
            'salesOrders' => $query
                ->with(['pembeli', 'petugas'])
                ->latest()
                ->paginate($this->paginate),
            'pembelis' => Pembeli::all()
        ]);
    }
}
