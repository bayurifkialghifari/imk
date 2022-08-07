@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        <li><a href="#">Master Data</a></li>
        <li class="active"><a href="#">Meja</a></li>

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
                                        <th>Tipe</th>
                                        <th>Nama</th>
                                        <th>Gambar</th>
                                        <th>Keterangan</th>
                                        <th>Harga (RP)</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['nama_tipe'] }}</td>
                                            <td>{{ $d['nama'] }}</td>
                                            <td>
                                                <a href="{{ base_url }}upload/menu/{{ $d['gambar'] }}"
                                                    target="_blank">{{ $d['gambar'] }}</a>
                                            </td>
                                            <td>{{ $d['keterangan'] }}</td>
                                            <td>{{ $d['harga'] }}</td>
                                            <td>{{ $d['stok'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="destroy(`{{ $d['id'] }}`)">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </button>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="update(`{{ $d['id'] }}`, `{{ $d['id_tipe'] }}`, `{{ $d['nama'] }}`, `{{ $d['gambar'] }}`, `{{ $d['keterangan'] }}`, `{{ $d['harga'] }}`, `{{ $d['stok'] }}` )">
                                                    <i class="fa fa-pencil"></i> Update
                                                </button>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ base_url }}menu/resep?menu={{ $d['id'] }}">
                                                    <i class="fa fa-info-circle"></i> Resep
                                                </a>

                                                <br />
                                                <br />
                                                @php
                                                    $rdata = $resep->find(['id_menu' => $d['id']]);
                                                @endphp

                                                @if ($rdata->num_rows > 0)
                                                    <button class="btn btn-success btn-sm" onclick="addStok()">
                                                        <i class="fa fa-plus"></i> Add Stok
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="">
                                                        <i class="fa fa-minus"></i> Min Stok
                                                    </button>
                                                @else
                                                    <button role="button" class="btn btn-success">Resep Masih
                                                        Kosong</button>
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
                                    <label for="id_tipe"> Tipe</label>
                                    <select name="id_tipe" class="form-control" required>
                                        @foreach ($tipe as $r)
                                            <option value="{{ $r['id'] }}">{{ $r['nama'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" id="gambar" class="form-control" name="gambar"
                                        placeholder="Gambar" accept="image/*" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar">Preview Image</label>
                                    <br>
                                    <img src="" id="image-preview" width="50%">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="keterangan"> Keterangan</label>
                                    <textarea class="form-control" name="keterangan" placeholder="Keterangan" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="harga"> Harga</label>
                                    <input type="number" class="form-control" name="harga" placeholder="Harga"
                                        required />
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="stok"> Stok</label>
                                    <input type="number" class="form-control" name="stok" placeholder="Stok"
                                        required />
                                </div>
                            </div>
                        </div> --}}
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
        // File Review Function
        function readURL(input, id) {
            if (input.files && input.files[0]) {

                let reader = new FileReader()

                reader.onload = function(e) {
                    $(`#${id}`).attr('src', e.target.result)
                }

                reader.readAsDataURL(input.files[0])
            }
        }

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
                                url: '{{ base_url }}menu/delete',
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
        let update = (id, id_tipe, nama, gambar, keterangan, harga, stok) => {
            postType = 'update'
            $('#id').val(id)

            $('select[name="id_tipe"]').val(id_tipe).change()
            $('input[name="nama"]').val(nama)
            $('textarea[name="keterangan"]').val(keterangan)
            $('input[name="harga"]').val(harga)
            $('input[name="stok"]').val(stok)
            $('#myModalLabel').html('Update {{ $title }}')
            $('#myModal').modal('show')
        }

        $(() => {
            // On Change Review File
            $("#gambar").change(function() {
                readURL(this, 'image-preview')
            })

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
                    '{{ base_url }}menu/insert' :
                    '{{ base_url }}menu/update';

                // Get Form data
                let fd = new FormData()
                let gambar = $('#gambar')[0].files[0]

                fd.append('id', $('#id').val())
                fd.append('id_tipe', $('select[name="id_tipe"]').val())
                fd.append('nama', $('input[name="nama"]').val())
                fd.append('keterangan', $('textarea[name="keterangan"]').val())
                fd.append('harga', $('input[name="harga"]').val())
                // fd.append('stok', $('input[name="stok"]').val())

                // Check if image not change
                if (gambar !== undefined) {
                    fd.append('gambar', gambar)
                }

                $.ajax({
                    url: url,
                    method: 'post',
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
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
