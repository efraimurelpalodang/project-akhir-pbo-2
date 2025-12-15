<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
        <button wire:click="create" class="btn btn-primary" data-toggle="modal" data-target="#tambahPengguna">
            {{-- <i class="fas fa-plus mr-1"></i> --}}
            Tambah Pengguna
        </button>
    </div>
    <div class="card-body">
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
                                <a href="/pengguna/edit/{{ $pengguna->username }}" class="btn btn-success mr-1 btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/pengguna/hapus/{{ $pengguna->username }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ! modal --}}
    <x-modal id="tambahPengguna" title="Tambah Pengguna">
        <form wire:ignore.self>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pengguna<sup class=" text-danger">*</sup></label>
                <input wire:model="nama" type="text"
                    class="form-control {{ $errors->has('nama') ? 'border-danger' : '' }}" id="nama">
                @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username<sup class=" text-danger">*</sup></label>
                <input wire:model="username" type="text"
                    class="form-control {{ $errors->has('username') ? 'border-danger' : '' }}" id="username">
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telepon<sup class=" text-danger">*</sup></label>
                <input wire:model="telp" type="text"
                    class="form-control {{ $errors->has('telp') ? 'border-danger' : '' }}" id="telp">
                @error('telp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password<sup class="text-danger">*</sup></label>
                <input wire:model="password" type="password"
                    class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" id="password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group d-flex">
                <div class="col-6">
                    <label for="jk" class="form-label">Jenis Kelamin<sup class="text-danger">*</sup></label>
                    <select wire:model="jk" id="jk"
                        class="form-control {{ $errors->has('jk') ? 'border-danger' : '' }}">
                        <option selected>-- Pilih --</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    @error('jk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="peran" class="form-label">Peran<sup class="text-danger">*</sup></label>
                    <select wire:model="peran" id="peran"
                        class="form-control {{ $errors->has('peran') ? 'border-danger' : '' }}">
                        <option selected>-- Pilih --</option>
                        @foreach ($perans as $peran)
                            <option value="{{ $peran->id }}">{{ $peran->nama_peran }}</option>
                        @endforeach
                    </select>
                    @error('peran')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <x-slot:footer>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Batal
                </button>
                <button wire:click="store" type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </x-slot:footer>

        </form>
    </x-modal>

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

</div>
