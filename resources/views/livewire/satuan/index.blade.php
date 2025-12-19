<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Satuan</h6>
        <button wire:click="clean" class="btn btn-primary" data-toggle="modal" data-target="#tambahSatuan">
            Tambah Satusn
        </button>
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
            </div>
            <div class="col-6">
                <input wire:model.live="search" type="text" class="form-control" placeholder="Pencarian...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Satuan</th>
                        <th>Deskripsi Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($satuans as $satuan)
                        <tr>
                            <td>{{ $satuan->nama }}</td>
                            <td>{{ $satuan->deskripsi }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button wire:click='edit({{ $satuan->id }})' class="btn btn-success mr-1 btn-sm"
                                    data-toggle="modal" data-target="#editSatuan">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="/satuan/hapus/{{ $satuan->id }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <p class="text-center">Data Satuan Tidak Ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $satuans->links() }}
        </div>
    </div>

    {{-- ! create modal --}}
    <x-satuan.form-modal id="tambahSatuan" title="Tambah Satuan" rightBtn="Simpan" event="store" />
    {{-- ! create modal --}}

    {{-- * edit modal --}}
    <x-satuan.form-modal id="editSatuan" title="Edit Satuan" rightBtn="Ubah" event="update" />
    {{-- * edit modal --}}

    @script
        <script>
            $wire.on('closeCreateModal', () => {
                $('#tambahSatuan').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Satuan Berhasil Ditambahkan",
                    icon: "success"
                });
            })
        </script>
    @endscript
    @script
        <script>
            $wire.on('closeEditModal', () => {
                $('#editSatuan').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Satuan Berhasil Diubah",
                    icon: "success"
                });
            })
        </script>
    @endscript
</div>
