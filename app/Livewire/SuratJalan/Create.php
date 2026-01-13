<?php

namespace App\Livewire\SuratJalan;

use App\Models\Pembeli;
use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\SuratJalan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = [
        'refresh-table' => '$refresh',
    ];
    
    public $paginate = '10',
        $search = '',
        $filter = 'nama_pembeli',
        $so_id; 

    public function pilihSO($id)
    {
        $this->so_id = $id;
    }

    public function simpan()
    {
        SuratJalan::create([
            'so_id' => $this->so_id,
            'pengguna_id' => Auth::id(),
            'tanggal_sj' => now(),
            'tanggal_pengantaran' => now(),
        ]);
    }

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
