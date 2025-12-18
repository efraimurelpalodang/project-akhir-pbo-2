<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pembeli</h6>
        <button wire:click="create" class="btn btn-primary" data-toggle="modal" data-target="#tambahPembeli">
            Tambah Pembeli
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
                        <th>Nama Pembeli</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembelis as $pembeli)
                        <tr>
                            <td>{{ $pembeli->nama_pembeli }}</td>
                            <td>{{ $pembeli->alamat }}</td>
                            <td>{{ $pembeli->telp }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button wire:click='edit({{ $pembeli->id }})' class="btn btn-success mr-1 btn-sm"
                                    data-toggle="modal" data-target="#editPembeli">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="/pembeli/hapus/{{ $pembeli->id }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pembelis->links() }}
        </div>
    </div>

    {{-- ! create modal --}}
    <x-pembeli.form-modal id="tambahPembeli" title="Tambah Pembeli" rightBtn="Simpan" event="store" />
    {{-- ! create modal --}}

    {{--* create modal --}}
    <x-pembeli.form-modal id="editPembeli" title="Edit Pembeli" rightBtn="Ubah" event="update" />
    {{--* create modal --}}

    @script
        <script>
            $wire.on('closeCreateModal', () => {
                $('#tambahPembeli').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Pembeli Berhasil Ditambahkan",
                    icon: "success"
                });
            })
        </script>
    @endscript
    @script
        <script>
            $wire.on('closeEditModal', () => {
                $('#editPembeli').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Pembeli Berhasil Diubah",
                    icon: "success"
                });
            })
        </script>
    @endscript
</div>
