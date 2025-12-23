<x-modal wire:ignore.self id="{{ $id }}" title="{{ $title }}" size="xl">
    <form>
        <!-- Pembeli -->
        <div class="mb-3 position-relative">
            <label class="form-label">Nama Pembeli <sup class="text-danger">*</sup></label>
            <input type="text" wire:model.live="pembeli_nama"
                class="form-control {{ $errors->has('pembeli_id') ? 'border-danger' : '' }}"
                placeholder="Ketik nama pembeli..." autocomplete="off">

            @if (!empty($pembeliSuggestions))
                <div class="list-group position-absolute w-100 shadow"
                    style="z-index: 1000; max-height: 200px; overflow-y:auto">
                    @foreach ($pembeliSuggestions as $p)
                        <button type="button" class="list-group-item list-group-item-action"
                            wire:click="pilihPembeli({{ $p->id }}, '{{ $p->nama_pembeli }}')">
                            {{ $p->nama_pembeli }}
                        </button>
                    @endforeach
                </div>
            @endif

            @error('pembeli_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Tanggal SO -->
        <div class="mb-3">
            <label class="form-label">Tanggal SO <sup class="text-danger">*</sup></label>
            <input type="date" wire:model.live="tanggal_so"
                class="form-control {{ $errors->has('tanggal_so') ? 'border-danger' : '' }}">
            @error('tanggal_so')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <hr>
        <h6 class="fw-bold mb-3">Detail Barang</h6>

        <!-- Header Table -->
        <div class="row mb-2 fw-bold small">
            <div class="col-md-5">Nama Barang</div>
            <div class="col-md-2">Jumlah</div>
            <div class="col-md-3">Harga Satuan</div>
            <div class="col-md-2"></div>
        </div>

        <!-- Items Loop -->
        @foreach ($items as $i => $item)
            <div class="row mb-2 align-items-start" wire:key="item-{{ $i }}">

                <!-- Nama Barang -->
                <div class="col-md-5 position-relative">
                    <input type="text" wire:model.live.debounce.300ms="items.{{ $i }}.barang_nama"
                        class="form-control form-control-sm {{ $errors->has('items.' . $i . '.barang_id') ? 'border-danger' : '' }}"
                        placeholder="Cari barang..." autocomplete="off">

                    @if (!empty($item['suggestions']))
                        <div class="list-group position-absolute w-100 shadow"
                            style="z-index: 1050; max-height: 200px; overflow-y:auto; top: 100%;">
                            @foreach ($item['suggestions'] as $b)
                                <button type="button" class="list-group-item list-group-item-action small"
                                    wire:click="pilihBarang({{ $i }}, {{ $b['id'] }}, '{{ addslashes($b['nama_barang']) }}')">
                                    <div class="fw-bold">{{ $b['nama_barang'] }}</div>
                                    <small class="text-muted">Rp
                                        {{ number_format($b['harga_jual'] ?? 0, 0, ',', '.') }}</small>
                                </button>
                            @endforeach
                        </div>
                    @endif

                    @error('items.' . $i . '.barang_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Jumlah -->
                <div class="col-md-2">
                    <input type="number" wire:model.live="items.{{ $i }}.jumlah"
                        class="form-control form-control-sm {{ $errors->has('items.' . $i . '.jumlah') ? 'border-danger' : '' }}"
                        min="1">

                    @error('items.' . $i . '.jumlah')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Harga Satuan (readonly) -->
                <div class="col-md-3">
                    <input type="text" value="Rp {{ number_format($item['harga_satuan'] ?? 0, 0, ',', '.') }}"
                        class="form-control form-control-sm bg-light" readonly>
                </div>

                <!-- Tombol Hapus -->
                <div class="col-md-2">
                    @if (count($items) > 1)
                        <button type="button" class="btn btn-danger btn-sm"
                            wire:click="hapusItem({{ $i }})">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach

        <!-- Tombol Tambah Barang -->
        <div class="my-3">
            <button type="button" class="btn btn-sm btn-success" wire:click="tambahItem">
                <i class="bi bi-plus-circle"></i> Tambah Barang
            </button>
        </div>

        <!-- Grand Total -->
        <hr>
        <div class="row align-items-center">
            <div class="col-md-6 text-end">
                <h6 class="mb-0"><strong>Total Harga</strong></h6>
            </div>
            <div class="col-md-6">
                <div class="mb-0 text-center py-2">
                    <strong class="fs-5">Rp {{ number_format($this->grandTotal, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>

        <x-slot:footer>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Batal
            </button>
            <button wire:click="{{ $event }}" type="submit" class="btn btn-primary">
                {{ $rightBtn }}
            </button>
        </x-slot:footer>
    </form>
</x-modal>
