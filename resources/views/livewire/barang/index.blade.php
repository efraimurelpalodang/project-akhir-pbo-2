<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
    </div>
    <div class="card-body">
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
                    @foreach ($barangs as $barang)
                        <tr>
                            <td>{{ $barang->kode }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->harga_jual }}</td>
                            <td>{{ $barang->jumlah_stok }}</td>
                            <td>{{ $barang->satuan->nama}}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="/barang/edit/{{ $barang->id }}" class="btn btn-success mr-1 btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/barang/hapus/{{ $barang->id }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
