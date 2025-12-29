<x-modal wire:ignore.self id="{{ $id }}" title="{{ $title }}" size="modal-lg">
    <form>
        <!-- Info Sales Order -->
        <div class="row">
            <!-- Pembeli -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold">Nama Pembeli</label>
                    <div class="p-2 bg-light border rounded">
                        {{ $pembeli_nama ?? '-' }}
                    </div>
                </div>
            </div>

            <!-- Tanggal SO -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold">Tanggal SO</label>
                    <div class="p-2 bg-light border rounded">
                        {{ $tanggal_so ? \Carbon\Carbon::parse($tanggal_so)->format('d F Y') : '-' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold">Status Pesanan</label>
                    <div>
                        <span class="badge {{ $this->statusBadge }} px-3 py-2">
                            {{ $this->statusLabel }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Detail Barang -->
        <h6 class="font-weight-bold mb-3">Detail Barang</h6>

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
                            <td class="text-right">Rp {{ number_format($item['harga_satuan'] ?? 0, 0, ',', '.') }}</td>
                            <td class="text-right font-weight-bold">
                                Rp
                                {{ number_format(($item['jumlah'] ?? 0) * ($item['harga_satuan'] ?? 0), 0, ',', '.') }}
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Tutup
            </button>
            @if ($this->canCancel)
                <button type="button" class="btn btn-danger" wire:click="batalkanPesanan"
                    wire:confirm="Apakah Anda yakin ingin membatalkan pesanan ini?">
                    <i class="fas fa-times-circle mr-1"></i> Batalkan Pesanan
                </button>
            @endif
            @if ($this->canApprove)
                <button type="button" class="btn btn-success" wire:click="approvePesanan"
                    wire:confirm="Lanjutkan pesanan ke status berikutnya?">
                    <i class="fas fa-check mr-1"></i> {{ $this->approveButtonText }}
                </button>
            @endif
        </x-slot:footer>
    </form>
</x-modal>
