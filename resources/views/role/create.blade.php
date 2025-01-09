@extends('spatie-role-full-code.dashboard')
@section('content')
    <div class="content-page">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="content">
            <div class="row">@include('spatie-role-full-code.system_setting')</div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-sm-6 portlets">
                    <div class="widget">
                        <div class="widget-header transparent">
                            <h2><strong>Rol</strong> Oluştur</h2>
                        </div>
                        <div class="widget-content padding">
                            <div id="basic-form">
                                <form role="form" action="{{route('panel.super_admin_role.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Adı</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{old('name')}}"
                                                       placeholder="Adı">
                                            </div>
                                            @error('name')
                                            <div class="alert alert-danger nomargin">{{ $errors->first('name') }}</div>
                                            <br>@enderror
                                            @error('permissions')
                                            <div class="alert alert-danger nomargin">{{ $errors->first('permissions') }}</div>@enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive" style="overflow-x: unset;">
                                                <input type="checkbox" name="select-all" id="select-all"/> Tümünü
                                                Seç<br/>
                                                <div class="box-body no-padding">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>İzin</th>
                                                            <th width="100">Oku</th>
                                                            <th width="100">Oluştur</th>
                                                            <th width="100">Güncelle</th>
                                                            <th width="100">Sil</th>
                                                            <th width="100">Satır Seç</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($permissions->get_permissions() as $key => $permission)
                                                            <tr>
                                                                <td>
                                                                    <label class="control-label">{{$permission}}</label>
                                                                </td>
                                                                <td><input type="checkbox" class="check{{$key}}"
                                                                           name="permissions[]" value="read {{$key}}">
                                                                </td>
                                                                <td><input type="checkbox" class="check{{$key}}"
                                                                           name="permissions[]" value="create {{$key}}">
                                                                </td>
                                                                <td><input type="checkbox" class="check{{$key}}"
                                                                           name="permissions[]" value="update {{$key}}">
                                                                </td>
                                                                <td><input type="checkbox" class="check{{$key}}"
                                                                           name="permissions[]" value="delete {{$key}}">
                                                                </td>
                                                                <td><input type="checkbox" class="checkedAll"
                                                                           id="check{{$key}}"></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>İzin</th>
                                                            <th width="100">Oku</th>
                                                            <th width="100">Oluştur</th>
                                                            <th width="100">Güncelle</th>
                                                            <th width="100">Sil</th>
                                                            <th width="100">Satır Seç</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-block btn-secondary btn-lg">Kaydet</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>


    <script>
        //tümünü seçmek için
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });

        //satır seçmek için
        $(".checkedAll").change(function (event) {
            if ($(this).is(':checked')) {
                $("." + event.currentTarget.id).prop('checked', true);
            } else {
                $("." + event.currentTarget.id).prop('checked', false);
            }
        })
    </script>
@endsection
