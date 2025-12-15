<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Pembeli</h6>
        <a href="/pembeli/tambah" class="btn btn-primary">
            {{-- <i class="fas fa-plus mr-1"></i> --}}
            Tambah Pembeli
        </a>
    </div>
    <div class="card-body">
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
                                <a href="/pembeli/edit/{{ $pembeli->id }}" class="btn btn-success mr-1 pr-1 btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/pembeli/hapus/{{ $pembeli->id }}" class="btn btn-danger btn-sm">
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
