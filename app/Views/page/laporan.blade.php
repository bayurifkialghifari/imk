@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">
        <li class="active"><a href="#">Laporan</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Pendapatan Harian : {{ date('Y F d') }}</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            <table id="harian" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Meja</th>
                                        <th>Atas Nama</th>
                                        <th>Status</th>
                                        <th>Waktu Pemesanan</th>
                                        <th>Total Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daily as $d)
                                        <tr>
                                            <td>{{ $d['nomor'] }}</td>
                                            <td>{{ $d['atas_nama'] }}</td>
                                            <td>{{ $d['status'] }}</td>
                                            <td>{{ $d['tanggalpesan'] }}</td>
                                            <td>{{ $d['total'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="list_pesanan(`{{ $d['id'] }}`, `{{ $d['id_pesanan'] }}`)">
                                                    <i class="fa fa-list"></i> List Pesanan
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>

        <div data-widget-group="group2">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Pendapatan Mingguan : {{ date('Y F d', strtotime('-1 week')) }} - {{ date('Y F d') }}</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            <table id="mingguan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Meja</th>
                                        <th>Atas Nama</th>
                                        <th>Status</th>
                                        <th>Waktu Pemesanan</th>
                                        <th>Total Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($weekly as $d)
                                        <tr>
                                            <td>{{ $d['nomor'] }}</td>
                                            <td>{{ $d['atas_nama'] }}</td>
                                            <td>{{ $d['status'] }}</td>
                                            <td>{{ $d['tanggalpesan'] }}</td>
                                            <td>{{ $d['total'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="list_pesanan(`{{ $d['id'] }}`, `{{ $d['id_pesanan'] }}`)">
                                                    <i class="fa fa-list"></i> List Pesanan
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>

        <div data-widget-group="group3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Pendapatan Bulanan : {{ date('F') }}</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            <table id="bulanan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Meja</th>
                                        <th>Atas Nama</th>
                                        <th>Status</th>
                                        <th>Waktu Pemesanan</th>
                                        <th>Total Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthly as $d)
                                        <tr>
                                            <td>{{ $d['nomor'] }}</td>
                                            <td>{{ $d['atas_nama'] }}</td>
                                            <td>{{ $d['status'] }}</td>
                                            <td>{{ $d['tanggalpesan'] }}</td>
                                            <td>{{ $d['total'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="list_pesanan(`{{ $d['id'] }}`, `{{ $d['id_pesanan'] }}`)">
                                                    <i class="fa fa-list"></i> List Pesanan
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>

        <div data-widget-group="group4">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Pendapatan Tahunan : {{ date('Y') }}</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            <table id="tahunan" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Meja</th>
                                        <th>Atas Nama</th>
                                        <th>Status</th>
                                        <th>Waktu Pemesanan</th>
                                        <th>Total Pembayaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthly as $d)
                                        <tr>
                                            <td>{{ $d['nomor'] }}</td>
                                            <td>{{ $d['atas_nama'] }}</td>
                                            <td>{{ $d['status'] }}</td>
                                            <td>{{ $d['tanggalpesan'] }}</td>
                                            <td>{{ $d['total'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="list_pesanan(`{{ $d['id'] }}`, `{{ $d['id_pesanan'] }}`)">
                                                    <i class="fa fa-list"></i> List Pesanan
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ base_url }}bayar/insert" id="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="id_pesanan" id="id_pesanan">
                        <table id="pesanan-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody id="pesanan-data">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@push('scripts')
    <script>
        // Get list pesanan
        let list_pesanan = (id, id_pesanan) => {
            // Reset datatable
            $('#table-bahan').DataTable().clear().destroy()

            // Show modal
            $('#myModal').modal('show')
            $('#myModalLabel').html('List Pesanan')

            // Hide button
            $('#bayar').hide()


            $.ajax({
                url: '{{ base_url }}bayar/getlistpesanan?pesanan=' + id_pesanan,
                success(data) {
                    // Total dibayar
                    let totalDibayar = 0
                    data = JSON.parse(data)
                    dataPesanan = data

                    $('#pesanan-data').html('')

                    // Echo data
                    data.forEach(r => {
                        $('#pesanan-data').append(`<tr>
                            <td>${r.menu}</td>
                            <td>${r.qty}</td>
                            <td>${r.harga}</td>
                            <td>${r.total}</td>
                        </tr>`)

                        totalDibayar += Number(r.total)
                    })

                    // Re initialize datatable
                    $('#pesanan-table').DataTable()
                },
                error($xhr) {
                    toastr.warning($xhr.statusText, 'Failed')
                }
            })
        }

        $(document).ready(function() {
            $('#harian').DataTable()
            $('#mingguan').DataTable()
            $('#bulanan').DataTable()
            $('#tahunan').DataTable()
        })
    </script>
@endpush
