<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'jurnals' => Jurnal::latest('tgl_jurnal')->limit(15)->get()
        ];
        return view('jurnal.jurnal', $data);
    }

    public function search()
    {
        $jurnals = Jurnal::where('no_jurnal', 'like', '%' . request('search') . '%')
            ->orwhere('no_bukti', 'like', '%' . request('search') . '%')
            ->orwhere('keterangan', 'like', '%' . request('search') . '%')
            ->latest('tgl_jurnal')
            ->limit(15)
            ->get();
        $output = '
        <table class="table">
        <thead>
            <tr>
                <th>No. Journal</th>
                <th>No. Bukti</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($jurnals as $index => $jurnal) {
            $output .= '<tr>
                <td>' . $jurnal->no_jurnal . '</td>
                <td>' . $jurnal->no_bukti . '</td>
                <td style="width: 100px;">' . $jurnal['tgl_jurnal'] . '</td>
                <td>' . $jurnal->keterangan . '</td>
                <td style="width: 250px">
                    <div>
                        <a href="' . url('/buktimemorial/' . $jurnal->no_jurnal) . '">
                            <span class="badge rounded-pill bg-primary" style="width: 100px">Memorial</span>
                        </a>
                    </div>
                    <div>
                        <a href="' . url('/buktikasmasuk/' . $jurnal->no_jurnal . '/bukti kas masuk') . '">
                            <span class="badge rounded-pill" style="background-color: #33d02f; width: 100px">Kas Masuk</span>
                        </a>
                        <a href="' . url('/buktikaskeluar/' . $jurnal->no_jurnal . '/bukti kas keluar') . '">
                            <span class="badge rounded-pill bg-success" style="width: 100px">Kas Keluar</span>
                        </a>
                    </div>
                    <div>
                        <a href="' . url('/buktibankmasuk/' . $jurnal->no_jurnal . '/bukti bank masuk') . '">
                            <span class="badge rounded-pill" style="background-color: #ef8f10; width: 100px">Bank Masuk</span>
                        </a>
                        <a href="' . url('/buktibank/' . $jurnal->no_jurnal . '/bukti bank') . '">
                            <span class="badge rounded-pill" style="background-color: #d14f2e; width: 100px">Bank Keluar</span>
                        </a>
                    </div>
                </td>
            </tr>';
        }
        $output .= '</tbody>
                </table>';
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function buktiMemorial($noJurnal)
    {
        $jurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_jurnal', $noJurnal)->first();
        $detailJurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_jurnal', $noJurnal)
            ->get();
        $total = DB::select('SELECT SUM(debet) AS debet FROM jurnal JOIN detailjurnal USING(no_jurnal) WHERE no_jurnal = "' . $noJurnal . '" GROUP BY no_jurnal');
        $terbilang = terbilang($total[0]->debet);
        $data = [
            'jurnal' => $jurnal,
            'detailjurnal' => $detailJurnal,
            'total' => $total,
            'terbilang' => $terbilang
        ];
        return view('jurnal.buktiMemorial', $data);
    }

    public function buktiKeluar($noJurnal, $title)
    {
        $jurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_jurnal', $noJurnal)->first();
        $detailJurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_jurnal', $noJurnal)
            ->get();
        $total = DB::select('SELECT SUM(debet) AS debet FROM jurnal JOIN detailjurnal USING(no_jurnal) WHERE no_jurnal = "' . $noJurnal . '" GROUP BY no_jurnal');
        $terbilang = terbilang($total[0]->debet);
        $data = [
            'jurnal' => $jurnal,
            'detailjurnal' => $detailJurnal,
            'total' => $total,
            'terbilang' => $terbilang,
            'tableTitle' => $title
        ];
        return view('jurnal.buktiKeluar', $data);
    }

    public function buktiMasuk($noJurnal, $title)
    {
        $jurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_jurnal', $noJurnal)->first();
        $detailJurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_jurnal', $noJurnal)
            ->get();
        $total = DB::select('SELECT SUM(debet) AS debet FROM jurnal JOIN detailjurnal USING(no_jurnal) WHERE no_jurnal = "' . $noJurnal . '" GROUP BY no_jurnal');
        $terbilang = terbilang($total[0]->debet);
        $data = [
            'jurnal' => $jurnal,
            'detailjurnal' => $detailJurnal,
            'total' => $total,
            'terbilang' => $terbilang,
            'tableTitle' => $title
        ];
        return view('jurnal.buktiMasuk', $data);
    }
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}
