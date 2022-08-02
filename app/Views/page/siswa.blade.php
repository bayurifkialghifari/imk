@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        {{-- <li><a href="#"></a></li> --}}
        <li class="active"><a href="#">Siswa</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>List Siswa</h2>
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
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Tempat lahir</th>
                                        <th>Tanggal lahir</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['nis'] }}</td>
                                            <td>{{ $d['nama'] }}</td>
                                            <td>{{ $d['tempat_lahir'] }}</td>
                                            <td>{{ $d['tanggal_lahir'] }}</td>
                                            <td>{{ $d['alamat'] }}</td>
                                            <td>{{ $d['tanggal_masuk'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="destroy(`{{ $d['id'] }}`)">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </button>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="update(`{{ $d['id'] }}`, `{{ $d['nis'] }}`, `{{ $d['nama'] }}`, `{{ $d['tempat_lahir'] }}`,
                                                    `{{ $d['tanggal_lahir'] }}`, `{{ $d['alamat'] }}`, `{{ $d['tanggal_masuk'] }}`)">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> NIS</label>
                                    <input type="number" min="10" step="1" value="" class="form-control"
                                        name="nis" placeholder="NIS" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama"> Nama</label>
                                    <input type="text" value="" class="form-control" name="nama"
                                        placeholder="Nama" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama"> Alamat</label>
                                    <textarea value="" class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nama"> Tempat Lahir</label>
                                    <input type="text" value="" class="form-control" name="tempat_lahir"
                                        placeholder="Tempat Lahir" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama"> Tanggal Lahir</label>
                                    <input type="date" value="" class="form-control" name="tanggal_lahir"
                                        placeholder="Tanggal Lahir" required />
                                </div>
                                <div class="form-group">
                                    <label for="nama"> Tanggal Masuk</label>
                                    <input type="date" value="" class="form-control" name="tanggal_masuk"
                                        placeholder="Tanggal Masuk" required />
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
                                url: '{{ base_url }}siswa/delete',
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
        let update = (id, nis, nama, tempat_lahir, tanggal_lahir, alamat, tanggal_masuk) => {
            postType = 'update'
            $('#id').val(id)
            $('input[name="nis"]').val(nis)
            $('input[name="nama"]').val(nama)
            $('input[name="tempat_lahir"]').val(tempat_lahir)
            $('input[name="tanggal_lahir"]').val(tanggal_lahir)
            $('input[name="tanggal_masuk"]').val(tanggal_masuk)
            $('textarea[name="alamat"]').val(alamat)
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
                    '{{ base_url }}siswa/insert' :
                    '{{ base_url }}siswa/update';

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
