@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">
        @php
            $meja = $meja->fetch_assoc();
        @endphp
        <li><a href="{{ base_url }}meja-pelanggan">Meja Pelanggan</a></li>
        <li class="active"><a href="#">Meja {{ $meja['nomor'] }} - {{ $meja['atas_nama'] }}</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>Pesanan Meja {{ $meja['nomor'] }} - {{ $meja['atas_nama'] }}</h2>
                            <div class="panel-ctrls"></div>
                        </div>
                        <div class="panel-body">
                            <div class="text-left">
                                <button class="btn btn-success btn-md" type="button" id="addBtn">
                                    <i class="fa fa-plus"></i> Add Order
                                </button>
                                <button class="btn btn-primary btn-md" type="button" id="listMenu">
                                    <i class="fa fa-list"></i> List menu
                                </button>
                                <br>
                                <br>
                            </div>
                            {{-- id="example" --}}
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['menu'] }}</td>
                                            <td>{{ $d['qty'] }}</td>
                                            <td>{{ $d['harga'] }}</td>
                                            <td>{{ $d['total'] }}</td>
                                            <td>{{ $d['status'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="destroy(`{{ $d['id'] }}`)">
                                                    <i class="fa fa-trash-o"></i> Delete
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
                        <input type="hidden" name="id_pesanan" id="id_pesanan" value="{{ $pesanan }}">
                        <input type="hidden" name="stok_sisa" id="stok_sisa">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Menu</label>
                                    <select name="id_menu" id="id_menu" class="form-control" required>
                                        <option value="">
                                            Pilih Menu
                                        </option>
                                        @foreach ($menu as $n)
                                            <option value="{{ $n['id'] }}|{{ $n['stok'] }}|{{ $n['harga'] }}">
                                                {{ $n['nama'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_kursi"> Stok</label>
                                    <input type="number" class="form-control" id="stok" name="stok"
                                        placeholder="Stok" readonly required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_kursi"> Harga</label>
                                    <input type="number" class="form-control" id="harga" name="harga"
                                        placeholder="Harga" readonly required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_kursi"> Jumlah Pesan</label>
                                    <input type="number" class="form-control" id="jumlah_pesan" name="jumlah_pesan"
                                        placeholder="Jumlah Pesan" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_kursi"> Total Harga</label>
                                    <input type="number" class="form-control" id="total_harga" name="total_harga"
                                        placeholder="Total Harga" readonly required />
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

    <!-- Modal Show Menu -->
    <div class="modal fade" id="myModalMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabeMenu">List Menu</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table-bahan" class="table table-striped table-bordered" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Gambar</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menu as $m)
                                        <tr>
                                            <td>{{ $m['nama'] }}</td>
                                            <td>
                                                <img src="{{ base_url }}upload/menu/{{ $m['gambar'] }}"
                                                    alt="{{ $m['gambar'] }}" width="100px">
                                            </td>
                                            <td>{{ $m['stok'] }}</td>
                                            <td>{{ $m['harga'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div><!-- /.modal-content -->

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@push('scripts')
    <script>
        let postType

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
                                url: '{{ base_url }}pesanan/delete',
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

        $(() => {
            $('#table-bahan').DataTable()

            // Add button click
            $('#addBtn').click(() => {
                postType = 'create'
                $('#myModalLabel').html('Create {{ $title }}')
                $('#myModal').modal('show')
                $('#id_menu').val('').change()
                $('#stok').val('')
                $('#harga').val('')
            })

            // Form Submit
            $('#form').submit(ev => {
                ev.preventDefault()

                let url = postType == 'create' ?
                    '{{ base_url }}pesanan/insert' :
                    '{{ base_url }}pesanan/update';

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

            $('#listMenu').click(() => {
                $('#myModalMenu').modal('show')
            })

            // Menu onchange
            $('#id_menu').change(() => {
                let menu = $('#id_menu').val()
                menu = menu.split('|')

                let id = menu[0]
                let stok = menu[1]
                let harga = menu[2]

                $('#stok').val(stok)
                $('#harga').val(harga)
            })

            // Jumlah pesan onchange
            $('#jumlah_pesan').change(() => {
                let harga = $('#harga').val()
                let stok = $('#stok').val()
                let qty = $('#jumlah_pesan').val()

                let total = Number(harga) * Number(qty)
                let stokNow = Number(stok) - Number(qty)

                // Check stok
                if (stokNow < 0) {
                    alert('Stok menu tidak mencukupi')

                    $('#stok_sisa').val(stok)
                    $('#jumlah_pesan').val(1)
                    $('#total_harga').va(harga)
                } else {
                    $('#stok_sisa').val(stokNow)
                    $('#total_harga').val(total)
                }

            })
        })
    </script>
@endpush
