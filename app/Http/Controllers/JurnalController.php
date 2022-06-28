<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
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
            'jurnals' => Jurnal::select('no_bukti')->latest('tgl_jurnal')->groupBy('no_bukti')->paginate(20)
        ];
        return view('jurnal.jurnal', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function buktiMemorial($bukti)
    {
        $jurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_bukti', $bukti)->first();
        $detailJurnal = DB::table('jurnal')
            ->join('detailjurnal', 'jurnal.no_jurnal', '=', 'detailjurnal.no_jurnal')
            ->join('rekening', 'detailjurnal.kd_rek', '=', 'rekening.kd_rek')
            ->select(DB::raw('sum(kredit) as total_kredit, sum(debet) as total_debet, rekening.kd_rek'))
            ->where('jurnal.no_bukti', '=', $bukti)
            ->groupBy('rekening.kd_rek')
            ->get();
        $total = DB::select('SELECT SUM(debet) AS debet FROM jurnal JOIN detailjurnal USING(no_jurnal) WHERE no_bukti = "' . $bukti . '"');
        $terbilang = terbilang($total[0]->debet);
        $data = [
            'jurnal' => $jurnal,
            'detailjurnal' => $detailJurnal,
            'total' => $total,
            'terbilang' => $terbilang
        ];
        return view('jurnal.buktiMemorial', $data);
    }

    public function buktiMemorialWithDate($year, $month, $day, $number)
    {
        $bukti = $year . '/' . $month . '/' . $day . '/' . $number;
        $jurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_bukti', $bukti)->first();
        $detailJurnal = DB::table('jurnal')
            ->join('detailjurnal', 'jurnal.no_jurnal', '=', 'detailjurnal.no_jurnal')
            ->join('rekening', 'detailjurnal.kd_rek', '=', 'rekening.kd_rek')
            ->select(DB::raw('sum(kredit) as total_kredit, sum(debet) as total_debet, rekening.kd_rek'))
            ->where('jurnal.no_bukti', '=', $bukti)
            ->groupBy('rekening.kd_rek')
            ->get();
        $total = DB::select('SELECT SUM(debet) AS debet FROM jurnal JOIN detailjurnal USING(no_jurnal) WHERE no_bukti = "' . $bukti . '"');
        $terbilang = terbilang($total[0]->debet);
        $data = [
            'jurnal' => $jurnal,
            'detailjurnal' => $detailJurnal,
            'total' => $total,
            'terbilang' => $terbilang
        ];
        return view('jurnal.buktiMemorial', $data);
    }

    public function buktiKeluarMasuk($bukti, $title)
    {
        $jurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_bukti', $bukti)->first();
        $detailJurnal = DB::table('jurnal')
            ->join('detailjurnal', 'jurnal.no_jurnal', '=', 'detailjurnal.no_jurnal')
            ->join('rekening', 'detailjurnal.kd_rek', '=', 'rekening.kd_rek')
            ->select(DB::raw('sum(kredit) as total_kredit, sum(debet) as total_debet, rekening.kd_rek'))
            ->where('jurnal.no_bukti', '=', $bukti)
            ->groupBy('rekening.kd_rek')
            ->get();
        $total = DB::select('SELECT SUM(debet) AS debet FROM jurnal JOIN detailjurnal USING(no_jurnal) WHERE no_bukti = "' . $bukti . '"');
        $terbilang = terbilang($total[0]->debet);
        if ($title == 'bukti kas masuk') {
            $ketbayar = 'Diterima Dari';
        } else if ($title == 'bukti kas masuk') {
            $ketbayar = 'Dibayarkan Kepada';
        } else if ($title == 'bukti bank masuk') {
            $ketbayar = 'Diterima Dari';
        } else {
            $ketbayar = 'Dibayarkan Kepada';
        }
        $data = [
            'jurnal' => $jurnal,
            'detailjurnal' => $detailJurnal,
            'total' => $total,
            'terbilang' => $terbilang,
            'tableTitle' => $title,
            'ketbayar' => $ketbayar
        ];
        return view('jurnal.buktiKeluarMasuk', $data);
    }

    public function buktiKeluarMasukWithDate($year, $month, $day, $number, $title)
    {
        $bukti = $year . '/' . $month . '/' . $day . '/' . $number;
        $jurnal = Jurnal::join('detailjurnal', 'detailjurnal.no_jurnal', '=', 'jurnal.no_jurnal')
            ->where('jurnal.no_bukti', $bukti)->first();
        $detailJurnal = DB::table('jurnal')
            ->join('detailjurnal', 'jurnal.no_jurnal', '=', 'detailjurnal.no_jurnal')
            ->join('rekening', 'detailjurnal.kd_rek', '=', 'rekening.kd_rek')
            ->select(DB::raw('sum(kredit) as total_kredit, sum(debet) as total_debet, rekening.kd_rek'))
            ->where('jurnal.no_bukti', '=', $bukti)
            ->groupBy('rekening.kd_rek')
            ->get();
        $total = DB::select('SELECT SUM(debet) AS debet FROM jurnal JOIN detailjurnal USING(no_jurnal) WHERE no_bukti = "' . $bukti . '"');
        $terbilang = terbilang($total[0]->debet);
        if ($title == 'bukti kas masuk') {
            $ketbayar = 'Diterima Dari';
        } else if ($title == 'bukti kas masuk') {
            $ketbayar = 'Dibayarkan Kepada';
        } else if ($title == 'bukti bank masuk') {
            $ketbayar = 'Diterima Dari';
        } else {
            $ketbayar = 'Dibayarkan Kepada';
        }
        $data = [
            'jurnal' => $jurnal,
            'detailjurnal' => $detailJurnal,
            'total' => $total,
            'terbilang' => $terbilang,
            'tableTitle' => $title,
            'ketbayar' => $ketbayar
        ];
        return view('jurnal.buktiKeluarMasuk', $data);
    }

    public function search()
    {
        $jurnals = Jurnal::where('no_jurnal', 'like', '%' . request('search') . '%')
            ->orwhere('no_bukti', 'like', '%' . request('search') . '%')
            ->orwhere('keterangan', 'like', '%' . request('search') . '%')
            ->latest('tgl_jurnal')
            ->paginate(20);
        $output = '
        <table class="table">
        <thead>
            <tr>
                <th>No. Bukti</th>
                <th class="text-end">Cetak Bukti</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($jurnals as $index => $jurnal) {
            $output .= '<tr>
                <td>' . $jurnal->no_bukti . '</td>
                <td class="text-end">
                    <a href="' . url('/buktimemorial/' . $jurnal->no_bukti) . '">
                        <span class="badge rounded-pill bg-primary" style="width: 100px">Memorial</span>
                    </a>
                    <div>
                        <a href="' . url('/buktikasmasuk/' . $jurnal->no_bukti . '/bukti kas masuk') . '">
                            <span class="badge rounded-pill" style="background-color: #33d02f; width: 100px">Kas Masuk</span>
                        </a>
                        <a href="' . url('/buktikaskeluar/' . $jurnal->no_bukti . '/bukti kas keluar') . '">
                            <span class="badge rounded-pill bg-success" style="width: 100px">Kas Keluar</span>
                        </a>
                    </div>
                    <div>
                        <a href="' . url('/buktibankmasuk/' . $jurnal->no_bukti . '/bukti bank masuk') . '">
                            <span class="badge rounded-pill" style="background-color: #ef8f10; width: 100px">Bank Masuk</span>
                        </a>
                        <a href="' . url('/buktibankkeluar/' . $jurnal->no_bukti . '/bukti bank keluar') . '">
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
