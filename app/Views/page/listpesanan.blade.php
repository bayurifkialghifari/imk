@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        <li><a href="#">List Pesanan</a></li>

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
                                <label>Status Pesanan</label>
                                <select class="form-control" id="status">
                                    <option value="Belum Siap" @if ($status == 'Belum Siap') selected @endif>Belum Siap
                                    </option>
                                    <option value="Sudah Siap" @if ($status == 'Sudah Siap') selected @endif>Sudah Siap
                                    </option>
                                </select>
                                <br>
                                <br>
                            </div>
                            {{-- id="example" --}}
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Meja</th>
                                        <th>Atas Nama</th>
                                        <th>Menu</th>
                                        <th>Jumlah </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['nomor'] }}</td>
                                            <td>{{ $d['pelanggan'] }}</td>
                                            <td>{{ $d['menu'] }}</td>
                                            <td>{{ $d['qty'] }}</td>
                                            <td>{{ $d['status'] }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm"
                                                    onclick="shap(`{{ $d['id'] }}`)">
                                                    <i class="fa fa-check"></i> Pesanan Siap
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
@endsection

@push('scripts')
    <script>
        let postType

        // Delete function
        let shap = id => {

            toastr.success(
                `<br />
                <button type='button' id='confirmationButtonYes' class='btn btn-success'>Yes</button>
                <button type='button' id='confirmationButtonNo' class='btn btn-danger'>No</button>`,
                'Pesanan sudah siap ?', {
                    closeButton: false,
                    allowHtml: true,
                    onShown: function(toast) {
                        $("#confirmationButtonYes").click(() => {
                            toastr.clear()

                            $.ajax({
                                url: '{{ base_url }}listpesanan/siap',
                                method: 'post',
                                data: {
                                    id: id,
                                },
                                success(data) {
                                    if (JSON.parse(data)) {
                                        toastr.success(
                                            `Berhasil`,
                                            'Success')

                                        setTimeout(() => {
                                            location.reload()
                                        }, 500)
                                    } else {
                                        toastr.warning('Gagal', 'Failed')
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

        $(() => {

            $('#status').change(() => {
                let status = $('#status').val()

                location.href = '{{ base_url }}listpesanan?status=' + status
            })
        })
    </script>
@endpush
