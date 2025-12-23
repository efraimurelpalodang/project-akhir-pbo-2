<?php

namespace App\Livewire\SalesOrder;

use App\Models\Pembeli;
use Livewire\Component;
use App\Models\SalesOrder;
use Livewire\Attributes\On;

class Index extends Component
{
    public $paginate = '10',
            $search;

    #[On('refresh-table')]
    public function refreshTable(){}

    public function render()
    {
        return view('livewire.sales-order.index', [
            'salesOrders' => SalesOrder::where('status','like','%'. $this->search .'%')
            ->latest()
            ->paginate($this->paginate),
            'pembelis' => Pembeli::all()
        ]);
    }
    
}
