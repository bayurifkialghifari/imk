@extends('layouts.plain')
@section('content')
    <ol class="breadcrumb">

        {{-- <li><a href="#"></a></li> --}}
        <li class="active"><a href="#">User</a></li>

    </ol>
    <div class="container-fluid">
        <div data-widget-group="group1">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2>List User</h2>
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
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr class="odd gradeX">
                                            <td>{{ $d['email'] }}</td>
                                            <td>{{ $d['nama'] }}</td>
                                            <td>{{ $d['role_name'] }}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="destroy(`{{ $d['id'] }}`)">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </button>
                                                <button class="btn btn-primary btn-sm"
                                                    onclick="update(`{{ $d['id'] }}`, `{{ $d['email'] }}`, `{{ $d['nama'] }}`, `{{ $d['role_id'] }}` )">
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
                                    <label for="nama"> Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required />
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Role</label>
                                    <select name="role_id" class="form-control" required>
                                        @foreach ($role as $r)
                                            <option value="{{ $r['id'] }}">{{ $r['nama'] }}</option>
                                        @endforeach
                                    </select>
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
                                url: '{{ base_url }}user/delete',
                                method: 'post',
                                data: {
                                    id: id,
                                },
                                success(data) {
                                    toastr.success(
                                        `Data berhasil dihapus`,
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

                        $('#confirmationButtonNo').click(() => {
                            toastr.clear()
                        })
                    }
                })
        }

        // Update button click
        let update = (id, email, name, role) => {
            postType = 'update'
            $('#id').val(id)
            $('input[name="nama"]').val(name)
            $('input[name="email"]').val(email)
            console.log(role)
            $('select[name="role_id"]').val(role).change()
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
                    '{{ base_url }}user/insert' :
                    '{{ base_url }}user/update';

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
