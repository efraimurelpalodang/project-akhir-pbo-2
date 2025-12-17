<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
        <button wire:click="create" class="btn btn-primary" data-toggle="modal" data-target="#tambahPengguna">
            {{-- <i class="fas fa-plus mr-1"></i> --}}
            Tambah Pengguna
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
                <div>
                    <select wire:model.live="filter" class="form-control">
                        <option value="nama_pengguna">Nama Pengguna</option>
                        <option value="username">Username</option>
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
                        <th>Nama Pengguna</th>
                        <th>Username</th>
                        <th>Jenis Kelamin</th>
                        <th>Telpon</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penggunas as $pengguna)
                        <tr>
                            <td>{{ $pengguna->nama_pengguna }}</td>
                            <td>{{ $pengguna->username }}</td>
                            <td>{{ $pengguna->jk == 'P' ? 'Perempuan' : 'Laki-Laki' }}</td>
                            <td>{{ $pengguna->telp }}</td>
                            <td>{{ $pengguna->role->nama_peran }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button wire:click='edit({{ $pengguna->id }})' class="btn btn-success mr-1 btn-sm"
                                    data-toggle="modal" data-target="#editPengguna">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="/pengguna/hapus/{{ $pengguna->username }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $penggunas->links() }}
        </div>
    </div>

    {{-- ! create modal --}}
    <x-pengguna.form-modal id="tambahPengguna" title="Tambah Pengguna" rightBtn="Simpan" event="store" :perans="$perans" />
    {{-- ! create modal --}}

    {{-- * edit modal --}}
    <x-pengguna.form-modal id="editPengguna" title="Edit Pengguna" rightBtn="Ubah" event="update" :perans="$perans" />
    {{-- * edit modal --}}

    @script
        <script>
            $wire.on('closeCreateModal', () => {
                $('#tambahPengguna').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Pengguna Berhasil Ditambahkan",
                    icon: "success"
                });
            })
        </script>
    @endscript
    @script
        <script>
            $wire.on('closeEditModal', () => {
                $('#editPengguna').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Pengguna Berhasil Diubah",
                    icon: "success"
                });
            })
        </script>
    @endscript

</div>
