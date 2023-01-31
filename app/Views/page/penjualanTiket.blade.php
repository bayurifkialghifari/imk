@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        <li><a href="#">Master Data</a></li>
        <li class="active"><a href="#">Bahan</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>List Bahan</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            <div class="text-left">
                                <button class="btn btn-success btn-md" type="button" id="addBtn">
                                    <i class="fa fa-plus"></i> Create
                                </button>
                                <br>
                                <br>
                            </div>
                            {{-- id="example" --}}
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Pegawai</th>
                                        <th>Tiket</th>
                                        <th>Jumlah</th>
                                        <th>Total Bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['pegawai'] }}</td>
                                            <td>{{ $d['film'] }} - {{ $d['tanggal']}} - {{ $d['no_kursi'] }}</td>
                                            <td>{{ $d['jumlah'] }}</td>
                                            <td>{{ $d['total_bayar'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="destroy(`{{ $d['id'] }}`)">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </button>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="update(`{{ $d['id'] }}`, `{{ $d['id'] }}`, `{{ $d['id'] }}`, `{{ $d['id'] }}`)">
                                                    <i class="fa fa-pencil"></i> Update
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
            <form id="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="id_pegawai" id="id_pegawai" value="{{ $id_pegawai }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Tiket</label>
                                    <select name="id_film" id="id_film" class="form-control">
                                        <option value="">Select Tiket</option>
                                        @php
                                            $list_harga_tiket = [];
                                        @endphp
                                        @foreach($tiket as $tk)
                                            @php
                                                $list_harga_tiket[$tk['id']] = $tk['harga'];
                                            @endphp
                                            <option value="{{ $tk['id'] }}">{{ $tk['film'] }} - {{ $tk['tanggal'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="harga"> Harga Tiket</label>
                                    <input type="number" class="form-control" id="harga-tiket" placeholder="Harga tiket" readonly
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="harga"> Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="harga"> Total Harga</label>
                                    <input type="number" class="form-control" name="total_bayar" id="total_bayar" readonly placeholder="Total Harga"
                                        required />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('scripts')
    <script>
        let postType
        let list_tiket_harga = []

        @foreach($list_harga_tiket as $key => $lht)
            list_tiket_harga[{{ $key }}] = {{$lht}}
        @endforeach

        $('#id_film').on('change', (ev) => {
            ev.preventDefault()

            let val = $('#id_film').val()

            $('#harga-tiket').val(list_tiket_harga[val])
        })

        $('#jumlah').on('change', ev => {
            ev.preventDefault()

            let val = $('#jumlah').val()
            let harga = $('#harga-tiket').val()

            $('#total_bayar').val(Number(val) * Number(harga))
        })
        // Delete function
        let destroy = id => {

            toastr.warning(
                `<br />
                <button type='button' id='confirmationButtonYes' class='btn btn-success'>Yes</button>
                <button type='button' id='confirmationButtonNo' class='btn btn-danger'>No</button>`,
                'Are you sure to delete this item ?', {
                    closeButton: false,
                    allowHtml: true,
                    onShown: function(toast) {
                        $("#confirmationButtonYes").click(() => {
                            toastr.clear()

                            $.ajax({
                                url: '{{ base_url }}penjualan-tiket/delete',
                                method: 'post',
                                data: {
                                    id: id,
                                },
                                success(data) {
                                    if (JSON.parse(data)) {
                                        toastr.success(
                                            `Data berhasil dihapus`,
                                            'Success')

                                        setTimeout(() => {
                                            location.reload()
                                        }, 500)
                                    } else {
                                        toastr.warning('Data tidak bisa dihapus', 'Failed')
                                    }
                                },
                                error($xhr) {
                                    toastr.warning($xhr.statusText, 'Failed')
                                }
                            })
                        })

                        $('#confirmationButtonNo').click(() => {
                            toastr.clear()
                        })
                    }
                })
        }

        // Update button click
        let update = (id, nama, harga, stok) => {
            postType = 'update'
            $('#id').val(id)
            $('#myModalLabel').html('Update {{ $title }}')
            $('#myModal').modal('show')
        }

        $(() => {
            // Add button click
            $('#addBtn').click(() => {
                postType = 'create'
                $('#myModalLabel').html('Create {{ $title }}')
                $('#myModal').modal('show')
            })

            // Form Submit
            $('#form').submit(ev => {
                ev.preventDefault()

                let url = postType == 'create' ?
                    '{{ base_url }}penjualan-tiket/insert' :
                    '{{ base_url }}penjualan-tiket/update';

                $.ajax({
                    url: url,
                    method: 'post',
                    data: $('#form').serialize(),
                    success(data) {
                        toastr.success(
                            `Data berhasil ${postType == 'create' ? 'dibuat' : 'diubah'}`,
                            'Success')

                        setTimeout(() => {
                            location.reload()
                        }, 500)
                    },
                    error($xhr) {
                        toastr.warning($xhr.statusText, 'Failed')
                    }
                })
            })
        })
    </script>
@endpush
