@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        <li class="active"><a href="#">Meja Pelanggan</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>List Meja</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            {{-- id="example" --}}
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nomer</th>
                                        <th>Jumlah Kursi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['nomor'] }}</td>
                                            <td>{{ $d['jumlah_kursi'] }}</td>
                                            @php
                                                // Cek Meja terisi atau tidak
                                                $cek = $mejap
                                                    ->select('*')
                                                    ->where('id_meja', $d['id'])
                                                    ->and("status = 'Active'")
                                                    ->get();
                                            @endphp
                                            <td>
                                                {{-- If meja sudah terisi --}}
                                                @if ($cek->num_rows > 0)
                                                    <button class="btn btn-danger btn-sm">Terisi</button>
                                                @else
                                                    <button class="btn btn-success btn-sm">Tersedia</button>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- If meja sudah terisi --}}
                                                @if ($cek->num_rows > 0)
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ base_url }}pesanan?meja={{ $cek->fetch_assoc()['id'] }}">
                                                        <i class="fa fa-pencil"></i> Pesan Makanan
                                                    </a>
                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="batal_isi(`{{ $d['id'] }}`)">
                                                        <i class="fa fa-times"></i> Batas Isi
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="isi_meja(`{{ $d['id'] }}`, `{{ $d['nomor'] }}`, `{{ $d['jumlah_kursi'] }}`)">
                                                        <i class="fa fa-pencil"></i> Isi
                                                    </button>
                                                @endif
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Kursi Tersedia</label>
                                    <input type="text" class="form-control" id="tersedia" placeholder="Nomer" readonly
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="atas_nama"> Atas Nama</label>
                                    <input type="text" class="form-control" name="atas_nama" placeholder="Atas Nama"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah"> Jumlah Orang</label>
                                    <input type="number" class="form-control" name="jumlah" placeholder="Jumlah Orang"
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
        // Isi meja
        let isi_meja = (id, nama, kursi) => {
            $('#myModalLabel').html('Pesan Meja ' + nama)
            $('#id').val(id)
            $('#tersedia').val(kursi)
            $('input[name="atas_nama"]').val('')
            $('input[name="jumlah"]').val('')
            $('#myModal').modal('show')
        }

        // Batal isi
        let batal_isi = (id) => {
            toastr.warning(
                `<br />
                <button type='button' id='confirmationButtonYes' class='btn btn-success'>Yes</button>
                <button type='button' id='confirmationButtonNo' class='btn btn-danger'>No</button>`,
                'Apakah anda yakin ingin membatalkan pesanan di meja ini ?', {
                    closeButton: false,
                    allowHtml: true,
                    onShown: function(toast) {
                        $("#confirmationButtonYes").click(() => {
                            toastr.clear()

                            $.ajax({
                                url: '{{ base_url }}meja-pelanggan/batal_isi',
                                method: 'post',
                                data: {
                                    id: id,
                                },
                                success(data) {
                                    if (JSON.parse(data)) {
                                        toastr.success(
                                            `Meja batal di isi`,
                                            'Success')

                                        setTimeout(() => {
                                            location.reload()
                                        }, 500)
                                    } else {
                                        toastr.warning('Error', 'Failed')
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
            // Jumlah on change
            $('input[name="jumlah"]').on('change', () => {
                let jumlah = $('input[name="jumlah"]').val()
                let tersedia = $('#tersedia').val()

                if (Number(jumlah) > Number(tersedia)) {
                    $('input[name="jumlah"]').val(1)
                }
            })

            // Submit isi meja
            $('#form').submit(ev => {
                ev.preventDefault()

                $.ajax({
                    url: '{{ base_url }}meja-pelanggan/isi_meja',
                    method: 'post',
                    data: $('#form').serialize(),
                    success(data) {
                        toastr.success(
                            `Meja berhasil di isi`,
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
