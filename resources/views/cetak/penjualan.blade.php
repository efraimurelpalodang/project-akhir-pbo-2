<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }

        /* HEADER */
        .header {
            background-color: #2c3e50;
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
        }

        .header-bottom {
            background-color: #34495e;
            color: white;
            padding: 8px 20px;
            font-size: 9px;
            margin-bottom: 15px;
        }

        /* TITLE */
        .title-section {
            background-color: #ecf0f1;
            padding: 15px;
            text-align: center;
            border-bottom: 3px solid #3498db;
            margin-bottom: 20px;
            width: 695px; 
        }

        .title-section h2 {
            margin: 0 0 8px 0;
            font-size: 18px;
            color: #2c3e50;
            font-weight: bold;
        }

        .periode {
            background-color: #3498db;
            color: white;
            padding: 5px 15px;
            font-size: 11px;
            font-weight: bold;
            margin: 8px 0;
        }

        .date-info {
            font-size: 9px;
            color: #7f8c8d;
            margin-top: 5px;
            margin-right: 100px;
        }

        /* SUMMARY SIMPLE */
        .summary-simple {
            background-color: #ecf0f1;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #3498db;
        }

        .summary-simple table {
            width: 100%;
            border-collapse: collapse;
        }

        .summary-simple td {
            padding: 8px;
            font-size: 11px;
            border-bottom: 1px solid #ddd;
        }

        .summary-simple td:first-child {
            font-weight: bold;
            width: 40%;
        }

        .summary-simple tr:last-child td {
            border-bottom: none;
        }

        .highlight-value {
            color: #2c3e50;
            font-weight: bold;
            font-size: 13px;
        }

        /* TABLE TITLE */
        .table-header {
            background-color: #ecf0f1;
            padding: 10px;
            border-left: 4px solid #3498db;
            margin-bottom: 10px;
        }

        .table-header h3 {
            margin: 0;
            font-size: 12px;
            color: #2c3e50;
            font-weight: bold;
        }

        /* DATA TABLE */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.data-table th {
            background-color: #2c3e50;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #1a1a1a;
        }

        table.data-table td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 10px;
            background-color: white;
        }

        table.data-table tbody tr:nth-child(even) td {
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
            font-weight: bold;
            color: #7f8c8d;
        }

        .col-date {
            width: 85px;
        }

        .col-sj {
            width: 100px;
            font-weight: bold;
            color: #2980b9;
        }

        .col-status {
            width: 80px;
            color: #3498db;
            font-weight: bold;
        }

        .col-price {
            font-weight: bold;
            color: #27ae60;
        }

        /* TOTAL ROW */
        .total-row td {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            font-size: 11px;
            padding: 12px 8px;
            border: 1px solid #1a1a1a;
        }

        .total-amount {
            font-size: 13px;
        }

        /* NOTES */
        .notes {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px;
            margin: 15px 0;
            font-size: 9px;
            color: #856404;
        }

        .notes strong {
            font-size: 10px;
            display: block;
            margin-bottom: 5px;
        }

        /* SIGNATURE SIMPLE */
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
        }

        .sig-space {
            height: 60px;
        }

        .sig-line {
            border-top: 2px solid #2c3e50;
            padding-top: 5px;
            margin: 0 20px;
            font-weight: bold;
            font-size: 10px;
        }

        /* FOOTER */
        .footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 8px;
            font-size: 8px;
            margin-top: 30px;
            position: absolute;
            bottom: 0;
            width: 740px;
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
        <h2>LAPORAN PENJUALAN</h2>
        @if (isset($periode))
            <div class="periode">{{ $periode }}</div>
        @endif
        <div class="date-info">
            Dicetak: {{ date('d F Y, H:i') }} WIB
        </div>
    </div>

    <!-- SUMMARY SIMPLE -->
    @php
        $totalTransaksi = count($data);
        $grandTotal = 0;
        foreach ($data as $row) {
            $grandTotal += $row->total_harga;
        }
        $rataRata = $totalTransaksi > 0 ? $grandTotal / $totalTransaksi : 0;
    @endphp

    <div class="summary-simple">
        <table>
            <tr>
                <td>Total Transaksi</td>
                <td class="highlight-value">{{ number_format($totalTransaksi, 0, ',', '.') }} Transaksi</td>
            </tr>
            <tr>
                <td>Total Penjualan</td>
                <td class="highlight-value">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Rata-rata per Transaksi</td>
                <td class="highlight-value">Rp {{ number_format($rataRata, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <!-- TABLE TITLE -->
    <div class="table-header">
        <h3>DETAIL TRANSAKSI PENJUALAN</h3>
    </div>

    <!-- DATA TABLE -->
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Tanggal SO</th>
                <th>No Surat Jalan</th>
                <th>Nama Pembeli</th>
                <th class="text-center">Status</th>
                <th class="text-right">Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp

            @foreach ($data as $row)
                <tr>
                    <td class="col-no text-center">{{ $no++ }}</td>
                    <td class="col-date">{{ date('d/m/Y', strtotime($row->tanggal_so)) }}</td>
                    <td class="col-sj">SJ-{{ str_pad(optional($row->sj)->id ?? '0', 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $row->pembeli->nama_pembeli }}</td>
                    <td class="col-status text-center">
                        DIKIRIM
                    </td>
                    <td class="col-price text-right">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr class="total-row">
                <td colspan="5" class="text-center">TOTAL KESELURUHAN PENJUALAN</td>
                <td class="text-right total-amount">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- NOTES -->
    <div class="notes">
        <strong>Catatan:</strong>
        Laporan ini mencakup semua transaksi penjualan dengan status "Dikirim".
        Data yang ditampilkan telah diverifikasi dan sesuai dengan sistem inventory.
    </div>

    <!-- SIGNATURE SIMPLE -->
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
                <td><div class="sig-line">( Staff Admin )</div></td>
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