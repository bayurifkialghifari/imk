@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        <li class="active"><a href="#">Dashboard</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">

            {{-- If admin --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="info-tile tile-orange">
                        <div class="tile-icon"><i class="fa fa-users"></i></div>
                        <div class="tile-heading"><span>User</span></div>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-tile tile-primary">
                        <div class="tile-icon"><i class="fa fa-list"></i></div>
                        <div class="tile-heading"><span>Menu</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-tile tile-success">
                        <div class="tile-icon"><i class="fa fa-list"></i></div>
                        <div class="tile-heading"><span>Pesanan</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-tile tile-danger">
                        <div class="tile-icon"><i class="fa fa-table"></i></div>
                        <div class="tile-heading"><span>Meja</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-tile tile-success">
                        <div class="tile-icon"><i class="fa fa-dollar"></i></div>
                        <div class="tile-heading"><span>Pendapatan</span></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
@endpush
