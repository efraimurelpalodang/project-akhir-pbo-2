<?php

namespace App\Livewire\SuratJalan;

use Livewire\Component;
use App\Models\SalesOrder;
use App\Models\SuratJalan;
use Illuminate\Support\Facades\Auth;

class FormModal extends Component
{
    public $so_id;
    public $tanggal_sj;
    public $tanggal_pengantaran;

    protected $listeners = [
        'pilih-so' => 'setSO',
    ];

    public function setSO($soId)
    {
        $this->so_id = $soId;
    }

    public function simpan()
    {
        SuratJalan::create([
            'so_id' => $this->so_id,
            'pengguna_id' => Auth::id(),
            'tanggal_sj' => $this->tanggal_sj,
            'tanggal_pengantaran' => $this->tanggal_pengantaran,
        ]);

        SalesOrder::where('id', $this->so_id)->update([
            'status' => 'dikirim',
        ]);

        $this->dispatch('closeCreateModal');
        $this->dispatch('refresh-table');
    }

    public function render()
    {
        return view('livewire.surat-jalan.form-modal');
    }
}
