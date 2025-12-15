<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Satuan</h6>
        <a href="/satuan/tambah" class="btn btn-primary">
            {{-- <i class="fas fa-plus mr-1"></i> --}}
            Tambah Satuan
        </a>
    </div>
    <div class="card-body">
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
                    @foreach ($satuans as $satuan)
                        <tr>
                            <td>{{ $satuan->nama }}</td>
                            <td>{{ $satuan->deskripsi }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="/satuan/edit/{{ $satuan->id }}" class="btn btn-success mr-1 pr-1 btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/satuan/hapus/{{ $satuan->id }}" class="btn btn-danger btn-sm">
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
