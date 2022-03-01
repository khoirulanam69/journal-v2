@extends('templates.main')

@section('title', 'Detail Jurnal')

@section('content')
<div class="jurnal-detail">
    <ul class="d-flex align-items-center justify-content-between px-2" style="list-style: none;">
        <li class="d-flex align-items-center">
            <img src="{{asset('/assets/img/logo.jpeg')}}" width="30px" height="30px" alt="logo">
            <p class="navbar-brand ms-3">PT. PINDAD MEDIKA UTAMA</p>
        </li>
        <li class="nav-item">
            <p>RSU PINDAD TUREN</p>
        </li>
    </ul>
    <h2 class="text-center mb-0">BUKTI MEMORIAL</h2>
    <p class="text-center" style="font-size: 1.4em;">No. : {{$jurnal->no_bukti}}</p>
    <table class="table tb-form" style="border-color: transparent;">
        <tr>
            <td style="width: 25%;">Jumlah Transaksi</td>
            <td>:</td>
            <td>Rp. {{number_format($total[0]->debet, 2, ",", ".");}}</td>
        </tr>
        <tr>
            <td colspan="3">
                <p style="padding: 1em; border: 1px solid black; text-transform: capitalize">{{$terbilang}} rupiah</p>
            </td>
        </tr>
        <tr>
            <td style="width: 25%;">Untuk Keperluan</td>
            <td>:</td>
            <td>{{$jurnal->keterangan}}</td>
        </tr>
        <form action="/">
            <tr>
                <td style="width: 25%;">Bukti Pendukung</td>
                <td>:</td>
                <td>
                    <textarea placeholder="?"></textarea>
                </td>
            </tr>
            <tr>
                <td style="width: 25%;">Cara Pembayaran</td>
                <td>:</td>
                <td><input type="text" placeholder="?"></td>
            </tr>
        </form>
    </table>
    <div class="d-flex justify-content-evenly">
        <div class="text-center" style="width: 12em;">
            <br>
            <p class="card-title">KEPALA RUMAH SAKIT</p>
            <br><br><br>
            <b style="text-decoration: underline;">ANDRE SETYAWAN C.N.</b>
        </div>
        <div style="width: 12em;">
            <p style="font-size: 1.1em">Turen, {{$jurnal->tgl_jurnal}}</p>
            <p class="card-title">KABID ADMINKU & SDM</p>
            <br><br><br>
            <b style="text-decoration: underline;">TEGUH MULYO WIDODO</b>
        </div>
    </div>
    <table class="table table-bordered mt-4 mb-0" style="border-color: #000;" width="100%">
        <tbody>
            <tr>
                <td class="text-center" colspan="3">Diisi Oleh : Pembukuan</td>
            </tr>
            <tr>
                <td colspan="2">Tanggal Dibukukan : {{$jurnal->tgl_jurnal}}</td>
                <td style="width: 34%;">Paraf : </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered" style="border-color: #000;" width="100%">
        <thead>
            <tr class="text-center">
                <th>KODE AKUN</th>
                <th>DEBET (Rp)</th>
                <th>KREDIT (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailjurnal as $detailjurnal)
            <tr>
                <td class="text-center p-0">{{$detailjurnal->kd_rek}}</td>
                @if($detailjurnal->total_debet>0)
                <td class="text-end p-0">{{number_format($detailjurnal->total_debet, 2, ",", ".");}}</td>
                @else
                <td class="text-end p-0"></td>
                @endif
                @if($detailjurnal->total_kredit>0)
                <td class="text-end p-0">{{number_format($detailjurnal->total_kredit, 2, ",", ".");}}</td>
                @else
                <td class="text-end p-0"></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection