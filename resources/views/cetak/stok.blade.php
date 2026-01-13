<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            color: #2c3e50;
        }

        /* HEADER */
        .header {
            background-color: #34495e;
            color: white;
            padding: 20px;
            margin-bottom: 5px;
            width: 675px;
        }

        .header h1 {
            margin: 0 0 8px 0;
            font-size: 20px;
            font-weight: bold;
        }

        .header .info {
            font-size: 9px;
            line-height: 1.6;
            margin: 5px 0;
            opacity: 0.9;
        }

        .header-bottom {
            background-color: #2c3e50;
            color: white;
            padding: 8px 20px;
            font-size: 9px;
            margin-bottom: 15px;
        }

        /* TITLE */
        .title-section {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-bottom: 2px solid #34495e;
            margin-bottom: 20px;
            width: 695px;
        }

        .title-section h2 {
            margin: 0 0 8px 0;
            font-size: 18px;
            color: #34495e;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .periode {
            color: #7f8c8d;
            padding: 5px 15px;
            font-size: 10px;
            font-weight: 500;
            margin: 8px 0;
            margin-right: 100px;
        }

        .date-info {
            font-size: 9px;
            color: #95a5a6;
            margin-top: 5px;
            margin-right: 70px;
            padding-bottom: 20px;
        }

        /* SUMMARY SIMPLE */
        .summary-simple {
            background-color: #ffffff;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ecf0f1;
            border-left: 3px solid #34495e;
        }

        .summary-simple table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-simple td {
            padding: 8px;
            font-size: 11px;
            border-bottom: 1px solid #f5f5f5;
        }

        .summary-simple td:first-child {
            font-weight: 500;
            width: 40%;
            color: #7f8c8d;
        }

        .summary-simple tr:last-child td {
            border-bottom: none;
        }

        .highlight-value {
            color: #2c3e50;
            font-weight: 600;
            font-size: 12px;
        }

        /* TABLE TITLE */
        .table-header {
            background-color: #f8f9fa;
            padding: 10px;
            border-left: 3px solid #34495e;
            margin-bottom: 10px;
        }

        .table-header h3 {
            margin: 0;
            font-size: 12px;
            color: #34495e;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* DATA TABLE */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.data-table th {
            background-color: #34495e;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid #2c3e50;
            letter-spacing: 0.3px;
        }

        table.data-table td {
            padding: 8px;
            border: 1px solid #ecf0f1;
            font-size: 10px;
            background-color: white;
        }

        table.data-table tbody tr:nth-child(even) td {
            background-color: #fafafa;
        }

        table.data-table tbody tr:hover td {
            background-color: #f8f9fa;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .col-no {
            width: 40px;
            color: #95a5a6;
            font-weight: 500;
        }

        .col-kode {
            width: 90px;
            font-weight: 500;
            color: #34495e;
        }

        .col-satuan {
            width: 80px;
        }

        .col-stok {
            width: 80px;
            font-weight: 600;
        }

        .col-price {
            font-weight: 500;
            color: #2c3e50;
        }

        .stok-aman {
            color: #27ae60;
        }

        .stok-rendah {
            color: #e67e22;
        }

        .stok-habis {
            color: #c0392b;
        }

        /* SUMMARY ROW */
        .summary-row td {
            background-color: #34495e;
            color: white;
            font-weight: 600;
            font-size: 11px;
            padding: 12px 8px;
            border: 1px solid #2c3e50;
        }

        .summary-amount {
            font-size: 12px;
        }

        /* NOTES */
        .notes {
            background-color: #f8f9fa;
            border-left: 3px solid #95a5a6;
            padding: 10px;
            margin: 15px 0;
            font-size: 9px;
            color: #7f8c8d;
        }

        .notes strong {
            font-size: 10px;
            display: block;
            margin-bottom: 5px;
            color: #34495e;
        }

        /* SIGNATURE */
        .signature-simple {
            margin-top: 40px;
            page-break-inside: avoid;
        }

        .signature-simple table {
            width: 650px;
            border-collapse: collapse;
        }

        .signature-simple td {
            width: 33.33%;
            text-align: center;
            padding: 10px;
        }

        .sig-header {
            text-align: center;
            padding-left: 100px;
            font-size: 10px;
            color: #7f8c8d;
        }

        .sig-space {
            height: 60px;
        }

        .sig-line {
            border-top: 1px solid #95a5a6;
            padding-top: 5px;
            margin: 0 20px;
            font-weight: 500;
            font-size: 10px;
            color: #34495e;
        }

        /* FOOTER */
        .footer {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 8px;
            font-size: 8px;
            margin-top: 30px;
            position: absolute;
            bottom: 0;
            width: 740px;
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h1>PT. PENYEDIA BAHAN BANGUNAN ABC</h1>
        <div class="info">
            Jl. Contoh Alamat No. 123, Kota, Provinsi 12345<br>
            Telp: (021) 000-0000 | Email: info@perusahaan.com | www.perusahaan.com
        </div>
    </div>

    <div class="header-bottom">
        NPWP: 00.000.000.0-000.000 | NIB: 1234567890123
    </div>

    <!-- TITLE -->
    <div class="title-section">
        <h2>LAPORAN STOK BARANG</h2>
        <div class="periode">Per Tanggal: {{ date('d F Y') }}</div>
        <div class="date-info">
            Dicetak: {{ date('d F Y, H:i') }} WIB
        </div>
    </div>

    <!-- SUMMARY CALCULATIONS -->
    @php
        $totalItem = count($data);
        $totalStok = 0;
        $totalNilai = 0;
        $stokAman = 0;
        $stokRendah = 0;
        $stokHabis = 0;
        
        foreach ($data as $row) {
            $totalStok += $row->jumlah_stok;
            $totalNilai += ($row->jumlah_stok * $row->harga_jual);
            
            if ($row->jumlah_stok == 0) {
                $stokHabis++;
            } elseif ($row->jumlah_stok <= 15) {
                $stokRendah++;
            } else {
                $stokAman++;
            }
        }
    @endphp

    <!-- SUMMARY SIMPLE -->
    <div class="summary-simple">
        <table>
            <tr>
                <td>Total Item Barang</td>
                <td class="highlight-value">{{ number_format($totalItem, 0, ',', '.') }} Item</td>
            </tr>
            <tr>
                <td>Total Jumlah Stok</td>
                <td class="highlight-value">{{ number_format($totalStok, 0, ',', '.') }} Unit</td>
            </tr>
            <tr>
                <td>Total Nilai Persediaan</td>
                <td class="highlight-value">Rp {{ number_format($totalNilai, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Status Stok</td>
                <td class="highlight-value">
                    <span style="color: #27ae60;">{{ $stokAman }} Aman</span>, 
                    <span style="color: #e67e22;">{{ $stokRendah }} Rendah</span>, 
                    <span style="color: #c0392b;">{{ $stokHabis }} Habis</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- TABLE TITLE -->
    <div class="table-header">
        <h3>DETAIL STOK BARANG</h3>
    </div>

    <!-- DATA TABLE -->
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th class="text-center">Satuan</th>
                <th class="text-center">Jumlah Stok</th>
                <th class="text-right">Harga Jual</th>
                <th class="text-right">Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp

            @foreach ($data as $row)
                @php
                    $stokClass = 'stok-aman';
                    if ($row->jumlah_stok == 0) {
                        $stokClass = 'stok-habis';
                    } elseif ($row->jumlah_stok <= 10) {
                        $stokClass = 'stok-rendah';
                    }
                    $nilaiTotal = $row->jumlah_stok * $row->harga_jual;
                @endphp
                <tr>
                    <td class="col-no text-center">{{ $no++ }}</td>
                    <td class="col-kode">{{ $row->kode }}</td>
                    <td>{{ $row->nama_barang }}</td>
                    <td class="col-satuan text-center">{{ $row->satuan->nama_satuan }}</td>
                    <td class="col-stok text-center {{ $stokClass }}">
                        {{ number_format($row->jumlah_stok, 0, ',', '.') }}
                    </td>
                    <td class="col-price text-right">Rp {{ number_format($row->harga_jual, 0, ',', '.') }}</td>
                    <td class="col-price text-right">Rp {{ number_format($nilaiTotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr class="summary-row">
                <td colspan="4" class="text-center">TOTAL KESELURUHAN</td>
                <td class="text-center summary-amount">{{ number_format($totalStok, 0, ',', '.') }}</td>
                <td></td>
                <td class="text-right summary-amount">Rp {{ number_format($totalNilai, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- NOTES -->
    <div class="notes">
        <strong>Keterangan:</strong>
        Laporan ini mencakup seluruh data stok barang yang tersedia di gudang.
        Status stok ditandai dengan warna: hijau (aman > 10), kuning (rendah 1-10), merah (habis).
    </div>

    <!-- SIGNATURE -->
    <div class="signature-simple">
        <table>
            <tr>
                <td class="sig-header">Dibuat Oleh,</td>
                <td class="sig-header">Diperiksa Oleh,</td>
                <td class="sig-header">Diketahui Oleh,</td>
            </tr>
            <tr class="sig-space">
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><div class="sig-line">( Staff Gudang )</div></td>
                <td><div class="sig-line">( Supervisor )</div></td>
                <td><div class="sig-line">( Manager )</div></td>
            </tr>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        Dokumen ini dibuat secara otomatis oleh sistem MatStock
    </div>

</body>

</html>