<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
        <button wire:click="create" class="btn btn-primary" data-toggle="modal" data-target="#tambahBarang">
            Tambah Barang
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
                        <option value="nama_barang">Nama Barang</option>
                        <option value="kode">Kode Barang</option>
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
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Stok Barang</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                        <tr>
                            <td>{{ $barang->kode }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->harga_jual }}</td>
                            <td>{{ $barang->jumlah_stok }}</td>
                            <td>{{ $barang->satuan->nama }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <button wire:click='edit({{ $barang->id }})' class="btn btn-success mr-1 btn-sm"
                                    data-toggle="modal" data-target="#editBarang">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="/barang/hapus/{{ $barang->id }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <h6 class="text-center">Data Barang Tidak Ditemukan</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $barangs->links() }}
        </div>
    </div>

    {{-- ! create modal --}}
    <x-barang.form-modal id="tambahBarang" title="Tambah Barang" rightBtn="Simpan" event="store" :satuans="$satuans" />
    {{-- ! create modal --}}
    
    {{--* edit modal --}}
    <x-barang.form-modal id="editBarang" title="Edit Barang" rightBtn="Ubah" event="update" :satuans="$satuans" />
    {{--* edit modal --}}

    @script
        <script>
            $wire.on('closeCreateModal', () => {
                $('#tambahBarang').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Barang Berhasil Ditambahkan",
                    icon: "success"
                });
            })
        </script>
    @endscript
    @script
        <script>
            $wire.on('closeEditModal', () => {
                $('#editBarang').modal('hide');
                Swal.fire({
                    title: "Suksess!",
                    text: "Data Barang Berhasil Diubah",
                    icon: "success"
                });
            })
        </script>
    @endscript
</div>
