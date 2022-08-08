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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .container-fluid -->
@endsection
@push('scripts')
    <script>
        $(() => {
            $('#harian').DataTable()
            $('#mingguan').DataTable()
            $('#bulanan').DataTable()
            $('#tahunan').DataTable()
        })
    </script>
@endpush
