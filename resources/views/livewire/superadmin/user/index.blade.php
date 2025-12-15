<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
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
</div>
