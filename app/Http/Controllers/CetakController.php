<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;

class CetakController extends Controller
{
    public function penjualan()
    {
        $data = SalesOrder::with(['pembeli', 'sj'])
            ->where('status', 'dikirim')
            ->orderBy('tanggal_so', 'desc')
            ->get();
        $html = view('cetak.penjualan', compact('data'))->render();
        $pdf = new Html2Pdf('P', 'A4', 'en');
        $pdf->writeHTML($html);
        return response($pdf->output('laporan-penjualan.pdf'))
            ->header('Content-Type', 'application/pdf');
    }

    public function stok()
    {
        $data = Barang::with('satuan')
            ->orderBy('nama_barang', 'asc')
            ->get();

        $html = view('cetak.stok', compact('data'))->render();

        $pdf = new Html2Pdf('P', 'A4', 'en');
        $pdf->writeHTML($html);

        return response($pdf->output('laporan-stok-barang.pdf'))
            ->header('Content-Type', 'application/pdf');
    }
}
