@extends('spatie-role-full-code::dashboard')
@section('content')
    <div class="content-page">
        <div class="content">
            <div class="row">@include('spatie-role-full-code::system_setting')</div>
            <div class="container-fluid pt-5">
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title justify-content-center">
                            <i class="fas fa-newspaper mr-1"></i>
                            Roller
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="role-table" class="display nowrap dataTable cell-border" style="width:100%">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Adı</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Güncelleme Tarihi</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Adı</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Güncelleme Tarihi</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="{{route('panel.super_admin_role.create')}}" class="btn btn-info float-right"><i
                                    class="fas fa-plus"></i>Yeni Rol Ekle</a><br><br>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>


    <script type="text/javascript">

        function remove(id, name) {
            Swal.fire({
                icon: "warning",
                title: "@lang('question/index.areYouSure')",
                html: '"' + name + '"' + "@lang('question/index.thisRole')",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: "@lang('act/index.approve')",
                cancelButtonText: "@lang('act/index.cancel')",
                cancelButtonColor: "#e30d0d",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('panel.super_admin_role.destroy', 0) }}" + id,
                        method: 'delete',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (Object.entries(data)[0][0] === 'unauthorizedSpatie') {
                                Swal.fire({
                                    icon: 'error',
                                    title: '@lang('error/index.error')',
                                    html: Object.entries(data)[0][1],
                                });
                            } else {
                                Swal.fire({
                                    icon: "success",
                                    title: "@lang('success/index.success')",
                                    showConfirmButton: true,
                                    confirmButtonText: "@lang('act/index.ok')"
                                });
                                table.ajax.reload();
                            }
                        },
                        error: function (data) {
                            Swal.fire({
                                icon: "error",
                                title: "@lang('error/index.error')",
                                html: "<div id=\"validation-errors\"></div>",
                                showConfirmButton: true,
                                confirmButtonText: "@lang('act/index.ok')"
                            });
                            $.each(data.responseJSON.errors, function (key, value) {
                                $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div>');
                            });
                        }
                    });
                }
                // else {
                //     Swal.fire({
                //         title: "Uyarı!",
                //         text: "Silme işleminden vazgeçildi.",
                //         icon: "info",
                //         button: false,
                //     });
                // }
            });
        }


        var table = $('#role-table').DataTable({
            order: [
                [0, 'DESC']
            ],
            processing: true,
            serverSide: true,
            language: {
                @if(\Illuminate\Support\Facades\App::getLocale() == 'tr')
                url: "{{asset('datatable_language/tr.json')}}"
                @endif
            },
            ajax: '{!!route('panel.super_admin_role.fetch')!!}',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'update'},
                {data: 'delete'}
            ]
        });

    </script>

@endsection

