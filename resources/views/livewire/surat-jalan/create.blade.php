<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Sales Order Siap Di antar</h6>
        <button wire:click="clean" class="btn btn-primary" data-toggle="modal" data-target="#tambahBarang">
            Buat Surat Jalan
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
                                <button wire:click="$dispatch('pilih-so', { soId: {{ $so->id }} })"
                                    class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalSuratJalan">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if ($so->status === 'menunggu')
                                    <a href="/so/hapus/{{ $so->id }}" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <h6 class="text-center">Data sales order siap dikirim Tidak Ditemukan</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- {{ $salesOrders->links() }} --}}
        </div>
    </div>

    {{-- ! create modal --}}
    @livewire('surat-jalan.form-modal')
    {{-- ! create modal --}}

    {{-- * edit modal --}}
    {{-- <x-barang.form-modal id="editBarang" title="Edit Barang" rightBtn="Ubah" event="update" :satuans="$satuans" /> --}}
    {{-- * edit modal --}}

    @script
        <script>
            $wire.on('closeCreateModal', () => {
                $('#modalSuratJalan').modal('hide');
                Swal.fire({
                    title: "Berhasil!",
                    text: "Surat Jalan berhasil dibuat",
                    icon: "success"
                });
            });
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
