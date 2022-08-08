@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        <li class="active"><a href="#">Dashboard</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">

            {{-- If admin --}}

            @if ($get_role['nama'] == 'Admin')
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-tile tile-orange">
                            <div class="tile-icon"><i class="fa fa-users"></i></div>
                            <div class="tile-heading"><span>User</span></div>
                            <div class="tile-body"><span>{{ $total_user }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-tile tile-primary">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Menu</span></div>
                            <div class="tile-body"><span>{{ $total_menu }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-tile tile-success">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Pesanan</span></div>
                            <div class="tile-body"><span>{{ $total_pesanan }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-tile tile-danger">
                            <div class="tile-icon"><i class="fa fa-table"></i></div>
                            <div class="tile-heading"><span>Meja</span></div>
                            <div class="tile-body"><span>{{ $total_meja }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-tile tile-success">
                            <div class="tile-icon"><i class="fa fa-dollar"></i></div>
                            <div class="tile-heading"><span>Pendapatan</span></div>
                            <div class="tile-body"><span>Rp . {{ $pendapatan['total'] }}</span></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Is pelayan --}}

            @if ($get_role['nama'] == 'Pelayan')
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-tile tile-primary">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Menu</span></div>
                            <div class="tile-body"><span>{{ $total_menu }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-tile tile-success">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Pesanan</span></div>
                            <div class="tile-body"><span>{{ $total_pesanan }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-tile tile-danger">
                            <div class="tile-icon"><i class="fa fa-table"></i></div>
                            <div class="tile-heading"><span>Meja</span></div>
                            <div class="tile-body"><span>{{ $total_meja }}</span></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Is koki --}}

            @if ($get_role['nama'] == 'Koki')
                <div class="row">
                    <div class="col-md-4">
                        <div class="info-tile tile-primary">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Menu</span></div>
                            <div class="tile-body"><span>{{ $total_menu }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-tile tile-success">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Pesanan</span></div>
                            <div class="tile-body"><span>{{ $total_pesanan }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-tile tile-danger">
                            <div class="tile-icon"><i class="fa fa-table"></i></div>
                            <div class="tile-heading"><span>Bahan</span></div>
                            <div class="tile-body"><span>{{ $total_bahan }}</span></div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Is kasir --}}

            @if ($get_role['nama'] == 'Kasir')
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-tile tile-primary">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Menu</span></div>
                            <div class="tile-body"><span>{{ $total_menu }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-tile tile-success">
                            <div class="tile-icon"><i class="fa fa-list"></i></div>
                            <div class="tile-heading"><span>Pesanan</span></div>
                            <div class="tile-body"><span>{{ $total_pesanan }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-tile tile-danger">
                            <div class="tile-icon"><i class="fa fa-table"></i></div>
                            <div class="tile-heading"><span>Meja</span></div>
                            <div class="tile-body"><span>{{ $total_meja }}</span></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-tile tile-success">
                            <div class="tile-icon"><i class="fa fa-dollar"></i></div>
                            <div class="tile-heading"><span>Pendapatan</span></div>
                            <div class="tile-body"><span>Rp . {{ $pendapatan['total'] }}</span></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
@endpush
