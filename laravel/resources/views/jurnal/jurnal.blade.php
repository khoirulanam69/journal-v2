@extends('templates.main')

@section('title', 'Daftar Jurnal')

@section('content')
<div class="container">
    <h1 class="text-center">Jurnal Bulanan</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search by no journal...">
                <button type="submit" class="btn btn-danger">Search</button>
            </div>
        </div>
    </div>
    <div id="listdata"></div>
    <table class="table" id="table">
        <thead>
            <tr>
                <th>No. Journal</th>
                <th>No. Bukti</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Cetak Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurnals as $jurnal)
            <tr>
                <td>{{$jurnal->no_jurnal}}</td>
                <td>{{$jurnal->no_bukti}}</td>
                <td style="width: 100px;">{{$jurnal->tgl_jurnal}}</td>
                <td>{{$jurnal->keterangan}}</td>
                <td style="width: 250px">
                    <div>
                        <a href="{{url('/buktimemorial/'.$jurnal->no_jurnal)}}">
                            <span class="badge rounded-pill bg-primary" style="width: 100px">Memorial</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{url('/buktikasmasuk/'.$jurnal->no_jurnal.'/bukti kas masuk')}}">
                            <span class="badge rounded-pill" style="background-color: #33d02f; width: 100px">Kas Masuk</span>
                        </a>
                        <a href="{{url('/buktikaskeluar/'.$jurnal->no_jurnal.'/bukti kas keluar')}}">
                            <span class="badge rounded-pill bg-success" style="width: 100px">Kas Keluar</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{url('/buktibankmasuk/'.$jurnal->no_jurnal.'/bukti bank masuk')}}">
                            <span class="badge rounded-pill" style="background-color: #ef8f10; width: 100px">Bank Masuk</span>
                        </a>
                        <a href="{{url('/buktibank/'.$jurnal->no_jurnal.'/bukti bank')}}">
                            <span class="badge rounded-pill" style="background-color: #d14f2e; width: 100px">Bank Keluar</span>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            let query = $(this).val();
            $.ajax({
                url: '{{url("/search")}}',
                type: 'GET',
                data: {
                    'search': query
                },
                success: function(data) {
                    $('#listdata').html(data);
                    $('#table').hide();
                }
            })
        })
    })
</script>
@endsection