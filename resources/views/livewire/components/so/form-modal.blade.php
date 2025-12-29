<x-modal wire:ignore.self id="{{ $id }}" title="{{ $title }}" size="modal-lg">
    <form>
        <!-- Info Sales Order -->
        <div class="row">
            <!-- Pembeli -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold">
                        Nama Pembeli
                        @if($mode !== 'view')
                            <sup class="text-danger">*</sup>
                        @endif
                    </label>

                    @if ($mode !== 'view')
                        <!-- Mode Create/Edit: Input dengan autocomplete -->
                        <div class="position-relative">
                            <input type="text" wire:model.live="pembeli_nama"
                                class="form-control {{ $errors->has('pembeli_id') ? 'is-invalid' : '' }}"
                                placeholder="Ketik nama pembeli..." autocomplete="off">

                            @if (!empty($pembeliSuggestions))
                                <div class="list-group position-absolute w-100 shadow-sm border"
                                    style="z-index: 1000; max-height: 200px; overflow-y:auto; top: 100%;">
                                    @foreach ($pembeliSuggestions as $p)
                                        <a href="javascript:void(0)" class="list-group-item list-group-item-action"
                                            wire:click="pilihPembeli({{ $p->id }}, '{{ $p->nama_pembeli }}')">
                                            {{ $p->nama_pembeli }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                            @error('pembeli_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <!-- Mode View: Text biasa -->
                        <div class="p-2 bg-light border rounded">
                            {{ $pembeli_nama ?? '-' }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tanggal SO -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold">
                        Tanggal SO
                        @if($mode !== 'view')
                            <sup class="text-danger">*</sup>
                        @endif
                    </label>

                    @if ($mode !== 'view')
                        <!-- Mode Create/Edit: Date input -->
                        <input type="date" wire:model.live="tanggal_so"
                            class="form-control {{ $errors->has('tanggal_so') ? 'is-invalid' : '' }}">
                        @error('tanggal_so')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    @else
                        <div class="p-2 bg-light border rounded">
                            {{ $tanggal_so ? \Carbon\Carbon::parse($tanggal_so)->format('d F Y') : '-' }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <h6 class="font-weight-bold mb-3">Detail Barang</h6>

        @if ($mode !== 'view')
            <!-- MODE CREATE/EDIT -->
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="bg-light">
                        <tr>
                            <th width="40%">Nama Barang</th>
                            <th width="15%" class="text-center">Jumlah</th>
                            <th width="25%">Harga Satuan</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $i => $item)
                            <tr wire:key="item-{{ $i }}">
                                <!-- Nama Barang -->
                                <td>
                                    <div class="position-relative">
                                        <input type="text"
                                            wire:model.live.debounce.300ms="items.{{ $i }}.barang_nama"
                                            class="form-control form-control-sm {{ $errors->has('items.' . $i . '.barang_id') ? 'is-invalid' : '' }}"
                                            placeholder="Cari barang..." autocomplete="off">

                                        @if (!empty($item['suggestions']))
                                            <div class="list-group position-absolute w-100 shadow-sm border"
                                                style="z-index: 1050; max-height: 200px; overflow-y:auto; top: 100%;">
                                                @foreach ($item['suggestions'] as $b)
                                                    <a href="javascript:void(0)"
                                                        class="list-group-item list-group-item-action"
                                                        wire:click="pilihBarang({{ $i }}, {{ $b['id'] }}, '{{ addslashes($b['nama_barang']) }}')">
                                                        <div class="d-flex justify-content-between">
                                                            <span>{{ $b['nama_barang'] }}</span>
                                                            <small class="text-muted">
                                                                Rp {{ number_format($b['harga_jual'] ?? 0, 0, ',', '.') }}
                                                            </small>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif

                                        @error('items.' . $i . '.barang_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </td>

                                <!-- Jumlah -->
                                <td>
                                    <input type="number" wire:model.live="items.{{ $i }}.jumlah"
                                        class="form-control form-control-sm text-center {{ $errors->has('items.' . $i . '.jumlah') ? 'is-invalid' : '' }}"
                                        min="1">
                                    @error('items.' . $i . '.jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>

                                <!-- Harga Satuan -->
                                <td>
                                    <input type="text"
                                        value="Rp {{ number_format($item['harga_satuan'] ?? 0, 0, ',', '.') }}"
                                        class="form-control form-control-sm bg-light" readonly>
                                </td>

                                <!-- Tombol Hapus -->
                                <td class="text-center">
                                    @if (count($items) > 1)
                                        <button type="button" class="btn btn-danger btn-sm"
                                            wire:click="hapusItem({{ $i }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tombol Tambah Barang -->
            <button type="button" class="btn btn-success btn-sm mt-2" wire:click="tambahItem">
                <i class="fas fa-plus mr-1"></i> Tambah Barang
            </button>
        @else
            <!-- MODE VIEW -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th width="8%" class="text-center">No</th>
                            <th width="37%">Nama Barang</th>
                            <th width="15%" class="text-center">Jumlah</th>
                            <th width="20%" class="text-right">Harga Satuan</th>
                            <th width="20%" class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $i => $item)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $item['barang_nama'] ?? '-' }}</td>
                                <td class="text-center">{{ $item['jumlah'] ?? 0 }}</td>
                                <td class="text-right">Rp {{ number_format($item['harga_satuan'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="text-right font-weight-bold">
                                    Rp {{ number_format(($item['jumlah'] ?? 0) * ($item['harga_satuan'] ?? 0), 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">
                                    Tidak ada data barang
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Grand Total -->
        <div class="border-top pt-3 mt-3">
            <div class="row align-items-center">
                <div class="col text-right">
                    <h5 class="mb-0 font-weight-bold">Total Keseluruhan:</h5>
                </div>
                <div class="col-auto">
                    <h4 class="mb-0 font-weight-bold text-primary">
                        Rp {{ number_format($this->grandTotal, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <x-slot:footer>
            @if ($mode === 'view')
                <!-- Tombol saat mode View -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Tutup
                </button>
                <button type="button" class="btn btn-warning" wire:click="enableEditMode">
                    <i class="fas fa-edit mr-1"></i> Edit
                </button>
            @elseif ($mode === 'edit')
                <!-- Tombol saat mode Edit -->
                <button type="button" class="btn btn-secondary" wire:click="batalEdit">
                    Batal
                </button>
                <button wire:click="simpanPerubahan" type="button" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                </button>
            @else
                <!-- Tombol saat mode Create -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Batal
                </button>
                <button wire:click="store" type="button" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i> Buat Sales Order
                </button>
            @endif
        </x-slot:footer>
    </form>
</x-modal>