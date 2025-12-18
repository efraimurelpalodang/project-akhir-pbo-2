<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Peran</h6>
        <button wire:click="create" class="btn btn-primary" data-toggle="modal" data-target="#tambahPeran">
            Tambah Peran
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
                        <th>Nama Peran</th>
                        <th>Deskripsi Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perans as $peran)
                        <tr>
                            <td>{{ $peran->nama_peran }}</td>
                            <td>{{ $peran->deskripsi }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button wire:click='edit({{ $peran->id }})' class="btn btn-success mr-1 pr-1 btn-sm"
                                    data-toggle="modal" data-target="#editPeran">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="/peran/hapus/{{ $peran->id }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <h6 class="text-center">Data Tidak Ditemukan</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $perans->links() }}
        </div>
    </div>

    {{-- ! create modal --}}
    <x-peran.form-modal id="tambahPeran" title="Tambah Peran" rightBtn="Simpan" event="store" />
    {{-- ! create modal --}}

    {{-- ! create modal --}}
    <x-peran.form-modal id="editPeran" title="Edit Peran" rightBtn="Ubah" event="update" />
    {{-- ! create modal --}}

    @script
        <script>
            $wire.on('closeCreateModal', () => {
                $('#tambahPeran').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Peran Berhasil Ditambahkan",
                    icon: "success"
                });
            })
        </script>
    @endscript
    @script
        <script>
            $wire.on('closeEditModal', () => {
                $('#editPeran').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Peran Berhasil Diubah",
                    icon: "success"
                });
            })
        </script>
    @endscript

</div>
