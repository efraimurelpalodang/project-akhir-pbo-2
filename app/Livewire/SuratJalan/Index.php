<?php

namespace App\Livewire\SuratJalan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SuratJalan;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    public function render()
    {
        $query = SuratJalan::query()
            ->whereHas('salesOrder.pembeli', function ($q) {
                $q->where('nama_pembeli', 'like', '%' . $this->search . '%');
            });

        return view('livewire.surat-jalan.index', [
            'suratJalans' => $query
                ->with([
                    'salesOrder.pembeli',
                    'petugas'
                ])
                ->latest()
                ->paginate($this->paginate),
        ]);
    }
}
