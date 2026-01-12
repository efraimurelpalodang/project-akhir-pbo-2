<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            Data Surat Jalan
        </h6>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-2">
                <select wire:model.live="paginate" class="form-control">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                </select>
            </div>
            <div class="col-md-4 ml-auto">
                <input wire:model.live="search" type="text" class="form-control" placeholder="Cari nama pembeli">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>No Surat Jalan</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal SJ</th>
                        <th>Tanggal Antar</th>
                        <th>Total Harga</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suratJalans as $index => $sj)
                        <tr>
                            <td>
                                SJ-{{ str_pad($sj->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td>
                                {{ $sj->salesOrder->pembeli->nama_pembeli }}
                            </td>
                            <td>{{ $sj->tanggal_sj }}</td>
                            <td>{{ $sj->tanggal_pengantaran }}</td>
                            <td>
                                Rp {{ number_format($sj->salesOrder->total_harga, 0, ',', '.') }}
                            </td>
                            <td>{{ $sj->petugas->nama_pengguna }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                Data surat jalan kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $suratJalans->links() }}
        </div>

    </div>
</div>
