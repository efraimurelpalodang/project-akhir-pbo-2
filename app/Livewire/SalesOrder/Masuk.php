<?php

namespace App\Livewire\SalesOrder;

use App\Models\Pembeli;
use Livewire\Component;
use App\Models\SalesOrder;
use Livewire\Attributes\On;

class Masuk extends Component
{
    public $paginate = '10',
            $filter = 'penguna_id',
            $search = '';

    public $color = 'info';

    #[On('refresh-table')]
    public function refreshTable(){}

    public function render()
    {
        $query = SalesOrder::where('status', 'menunggu')->orWhere('status','proses_persiapan');

        if ($this->search !== '') {
            if ($this->filter === 'penguna_id') {
                $query->whereHas('pembeli', function ($q) {
                    $q->where('nama_pembeli', 'like', "%{$this->search}%");
                });
            } elseif ($this->filter === 'petugas_id') {
                $query->whereHas('petugas', function ($q) {
                    $q->where('nama_petugas', 'like', "%{$this->search}%");
                });
            }elseif ($this->filter === 'tanggal_so') {
                $query->where('tanggal_so', 'like', "%{$this->search}%");
            }
        }

        return view('livewire.sales-order.masuk', [
            'salesOrders' => $query->latest()->paginate($this->paginate),
            'pembelis' => Pembeli::all()
        ]);
    }
}
