<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Sales Order Masuk</h6>
    </div>
    <div class="card-body">
        <div class="mb-3 d-flex justify-content-between">
            <div class="col-6 d-flex">
                <div class="mr-2">
                    <select wire:model.live="paginate" class="form-control">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                <div class="mr-2">
                    <select wire:model.live="filter" class="form-control">
                        <option value="penguna_id">Nama Pembeli</option>
                        <option value="petugas_id">Nama Petugas</option>
                        <option value="tanggal_so">Tanggal SO</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <input wire:model.live="search" type="text" class="form-control" placeholder="Pencarian...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Pembeli</th>
                        <th>tanggal Pembuatan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Nama Petugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salesOrders as $so)
                        <tr>
                            <td>{{ $so->pembeli->nama_pembeli }}</td>
                            <td>{{ $so->tanggal_so }}</td>
                            <td>Rp {{ number_format($so->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="badge text-capitalize btn btn-{{ $so->badge_color }}">
                                    {{ ucfirst($so->badge_text) }}
                                </div>
                            </td>
                            <td>{{ $so->petugas->nama_pengguna }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button wire:click='$dispatch("viewSO", {id: {{ $so->id }}})'
                                    class="btn btn-info mr-1 btn-sm" data-toggle="modal" data-target="#detailSO">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <h6 class="text-center">Data Sales Order Masuk Tidak Ditemukan</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $salesOrders->links() }}
        </div>
    </div>

    {{-- * detail modal --}}
    <livewire:components.so.approve id="detailSO" title="Detail Sales Order Masuk" event="update" />
    {{-- * detail modal --}}

    @script
        <script>
            $wire.on('closeModal', () => {
                $('#detailSO').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Status sales order berhasil diupdate",
                    icon: "success"
                });
            })
        </script>
    @endscript
</div>
