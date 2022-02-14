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
    <h2 class="text-center text-uppercase mb-0">{{$tableTitle}}</h2>
    <p class="text-center" style="font-size: 1.4em;">No. : {{$jurnal->no_jurnal}}</p>
    <table class="table" style="border-color: transparent;">
        <tr>
            <td>Dibayarkan kepada</td>
            <td>:</td>
            <td><input type="text" placeholder="?"></td>
        </tr>
        <tr>
            <td>Jumlah Transaksi</td>
            <td>:</td>
            <td>Rp. {{number_format($total[0]->debet, 2, ",", ".");}}</td>
        </tr>
        <tr>
            <td colspan="3">
                <p style="padding: 1em; border: 1px solid black; text-transform: capitalize">{{$terbilang}} rupiah</p>
            </td>
        </tr>
        <tr>
            <td>Untuk Keperluan</td>
            <td>:</td>
            <td>{{$jurnal->keterangan}}</td>
        </tr>
        <tr>
            <td>Bukti Pendukung</td>
            <td>:</td>
            <td>
                <p>No. {{$jurnal->no_bukti}}</p>
                <textarea placeholder="?"></textarea>
            </td>
        </tr>
        <tr>
            <td>Cara Pembayaran</td>
            <td>:</td>
            <td><input type="text" placeholder="?"></td>
        </tr>
    </table>
    <div class="d-flex justify-content-evenly">
        <div class="text-center" style="min-width: 12em;">
            <br>
            <p class="card-title">KEPALA RUMAH SAKIT</p>
            <br><br><br>
            <b style="text-decoration: underline;">ANDRE SETYAWAN C.N.</b>
        </div>
        <div class="text-center" style="min-width: 12em;">
            <br>
            <p class="card-title">KABID ADMINKU & SDM</p>
            <br><br><br>
            <b style="text-decoration: underline;">TEGUH MULYO WIDODO</b>
        </div>
        <div class="text-center" style="min-width: 12em;">
            <br>
            <p class="card-title">PJ. KEUANGAN</p>
            <br><br><br>
            <b style="text-decoration: underline;">RINA FITRI LIAWATI</b>
        </div>
        <div class="text-center" style="min-width: 12em;">
            <p>Turen, {{$jurnal->tgl_jurnal}}</p>
            <p class="card-title">BENDAHARA</p>
            <br><br><br>
            <b style="text-decoration: underline;">TITIK YUNAIDAH</b>
        </div>
    </div>
    <table class="table table-bordered mt-4 mb-0" style="border-color: #000;" width="100%">
        <tbody>
            <tr>
                <td style="text-align: center;" colspan="3">Diisi Oleh : Pembukuan</td>
            </tr>
            <tr>
                <td colspan="2">Tanggal Dibukukan : {{$jurnal->tgl_jurnal}}</td>
                <td style="width:13rem;">Paraf : </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered" style="border-color: #000;" width="100%">
        <thead>
            <tr style="text-align: center;">
                <th>No. SANDI</th>
                <th>DEBET</th>
                <th>KREDIT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailjurnal as $detailjurnal)
            <tr>
                <td class="p-0 text-center">{{$detailjurnal['kd_rek']}}</td>
                @if($detailjurnal['debet']>0)
                <td class="text-end p-0" style="width:13rem;">Rp. {{number_format($detailjurnal['debet'], 2, ",", ".");}}</td>
                @else
                <td class="text-end p-0" style="width:13rem;"></td>
                @endif
                @if($detailjurnal['kredit']>0)
                <td class="text-end p-0" style="width:13rem;">Rp. {{number_format($detailjurnal['kredit'], 2, ",", ".");}}</td>
                @else
                <td class="text-end p-0" style="width:13rem;"></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection