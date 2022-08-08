@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        <li class="active"><a href="#">Pembayaran</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>List Belum Membayar</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            <div class="text-left">
                                <br>
                                <br>
                            </div>
                            {{-- id="example" --}}
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['nomor'] }}</td>
                                            <td>{{ $d['atas_nama'] }}</td>
                                            <td>Belum Dibayar</td>
                                            <td>{{ $d['created_at'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="list_pesanan(`{{ $d['id'] }}`, `{{ $d['pesanan_id'] }}`)">
                                                    <i class="fa fa-list"></i> List Pesanan
                                                </button>
                                                <button class="btn btn-success btn-sm"
                                                    onclick="pay(`{{ $d['id'] }}`, `{{ $d['pesanan_id'] }}`)">
                                                    <i class="fa fa-dollar"></i> Bayar
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
                        <input type="hidden" name="total" id="ftotal-dibayar">
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
                        <h4 id="total-dibayar"></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="bayar">
                            Bayar
                        </button>
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
        // Global variable
        let dataPesanan


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

                    // Total dibayar
                    $('#total-dibayar').html('Total Yang Harus Dibayar : ' + totalDibayar)
                    $('#ftotal-dibayar').val(totalDibayar)

                    // Re initialize datatable
                    $('#pesanan-table').DataTable()
                },
                error($xhr) {
                    toastr.warning($xhr.statusText, 'Failed')
                }
            })
        }

        // Bayar
        let pay = (id, id_pesanan) => {
            list_pesanan(id, id_pesanan)

            // Set value
            $('#id').val(id)
            $('#id_pesanan').val(id_pesanan)

            // Ganti label
            $('#myModalLabel').html('Bayar Pesanan')

            // Show button
            $('#bayar').show()
        }

        $(() => {
            // initialize datatable
            $('#pesanan-table').DataTable()

            // Bayar click
            $('#bayar').click((ev) => {
                ev.preventDefault()

                toastr.success(
                    `<br />
                    <button type='button' id='confirmationButtonYes' class='btn btn-success'>Yes</button>
                    <button type='button' id='confirmationButtonNo' class='btn btn-danger'>No</button>`,
                    'Apakah anda yakin ?', {
                        closeButton: false,
                        allowHtml: true,
                        onShown: function(toast) {
                            $("#confirmationButtonYes").click(() => {
                                toastr.clear()

                                $('#form').submit()
                            })

                            $('#confirmationButtonNo').click(() => {
                                toastr.clear()
                            })
                        }
                    })
            })
        })
    </script>
@endpush
