<x-modal id="modalSuratJalan" title="Buat Surat Jalan">
    <div class="mb-3">
        <label>Tanggal Surat Jalan</label>
        <input type="date" wire:model="tanggal_sj" class="form-control">
    </div>

    <div class="mb-3">
        <label>Tanggal Pengantaran</label>
        <input type="date" wire:model="tanggal_pengantaran" class="form-control">
    </div>

    <button wire:click="simpan" class="btn btn-primary">
        Simpan
    </button>
</x-modal>
