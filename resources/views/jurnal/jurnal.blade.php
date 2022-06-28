@extends('templates.main')

@section('title', 'Daftar Jurnal')

@section('content')
<div class="container">
    <h1 class="text-center">Jurnal Bulanan</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-danger">Search</button>
                </div>
            </form>
            <h5>Masukkan kode no bukti untuk cetak</h5>
        </div>
    </div>
    <div id="listdata"></div>
    <table class="table" id="table">
        <thead>
            <tr>
                <th>No. Bukti</th>
                <th class="text-end">Cetak Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurnals as $jurnal)
            <tr>
                <td>{{$jurnal->no_bukti}}</td>
                <td class="text-end">
                    <a href="{{url('/buktimemorial/'.$jurnal->no_bukti)}}">
                        <span class="badge rounded-pill bg-primary" style="width: 100px">Memorial</span>
                    </a>
                    <div>
                        <a href="{{url('/buktikasmasuk/'.$jurnal->no_bukti.'/bukti kas masuk')}}">
                            <span class="badge rounded-pill" style="background-color: #33d02f; width: 100px">Kas Masuk</span>
                        </a>
                        <a href="{{url('/buktikaskeluar/'.$jurnal->no_bukti.'/bukti kas keluar')}}">
                            <span class="badge rounded-pill bg-success" style="width: 100px">Kas Keluar</span>
                        </a>
                    </div>
                    <div>
                        <a href="{{url('/buktibankmasuk/'.$jurnal->no_bukti.'/bukti bank masuk')}}">
                            <span class="badge rounded-pill" style="background-color: #ef8f10; width: 100px">Bank Masuk</span>
                        </a>
                        <a href="{{url('/buktibankkeluar/'.$jurnal->no_bukti.'/bukti bank keluar')}}">
                            <span class="badge rounded-pill" style="background-color: #d14f2e; width: 100px">Bank Keluar</span>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$jurnals->links()}}
</div>
<!-- Modal
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%">
        <div class="modal-content bg-primary text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Cetak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row m-3">
                    <div class="col-md-6">
                        <div class="card bg-warning">
                            <div class="card-body text-center">
                                <h1>Berdasarkan No Jurnal</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-danger">
                            <div class="card-body text-center">
                                <h1>Berdasarkan No Bukti</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
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