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
                                <div class="text-capitalize btn btn-info badge text-center py-1">
                                    {{ $so->status }}
                                </div>
                            </td>
                            <td>{{ $so->pengguna->nama_pengguna }}</td>
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
                                <h6 class="text-center">Data Sales Order Tidak Ditemukan</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $salesOrders->links() }}
        </div>
    </div>

    {{-- ! create modal --}}
    <livewire:components.so.form-modal id="buatSO" title="Buat Sales Order" rightBtn="Buat" event="store" />
    {{-- ! create modal --}}

    {{-- * edit modal --}}
    <livewire:components.so.form-modal id="detailSO" title="Edit Barang" rightBtn="Ubah" event="update" />
    {{-- * edit modal --}}

    @script
        <script>
            $wire.on('closeCreateModal', () => {
                $('#buatSO').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Sales Order Berhasil Dibuat",
                    icon: "success"
                });
            })
        </script>
    @endscript
    @script
        <script>
            $('#buatSO').on('hidden.bs.modal', function() {
                Livewire.dispatch('closeCreateModal')
            })
        </script>
    @endscript
    @script
        <script>
            $wire.on('closeEditModal', () => {
                $('#editSO').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Sales Order Berhasil Diubah",
                    icon: "success"
                });
            })
        </script>
    @endscript
</div>
