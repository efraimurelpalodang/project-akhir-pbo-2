<?php

namespace App\Livewire\SalesOrder;

use App\Models\Pembeli;
use Livewire\Component;
use App\Models\SalesOrder;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $paginate = '10',
            $search;

    #[On('refresh-table')]
    public function refreshTable(){}

    public function render()
    {
        $query = SalesOrder::query();

        $query->where(function ($q) {
            $q->whereHas('pembeli', function ($q2) {
                $q2->where('nama_pembeli', 'like', '%' . $this->search . '%');
            })
                ->orWhereDate('tanggal_so', $this->search);
        });

        return view('livewire.sales-order.index', [
            'salesOrders' => $query
                ->with(['pembeli', 'petugas'])
                ->latest()
                ->paginate($this->paginate),
            'pembelis' => Pembeli::all()
        ]);
    }
    
}
