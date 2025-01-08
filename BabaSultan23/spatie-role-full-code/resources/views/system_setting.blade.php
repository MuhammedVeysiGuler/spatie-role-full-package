<div class="col-sm-12 portlets">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Sistem Ayarları</strong></h2>
        </div>
        <div class="widget-content padding">
            <div class="row top-summary">
                @if(auth()->user()->can('read super_admin_role'))
                    <div class="col-lg-1 col-md-1">
                        <a class="btn btn-app bg-success" href="{{route('panel.super_admin_role.index')}}">
                            <span class="badge bg-red">{{\Spatie\Permission\Models\Role::count()}}</span>
                            <i class="fas fa-users"></i> Roller
                        </a>
                    </div>
                @endif

{{--                yeni eklemeler bu kısıma--}}
            </div>
        </div>
    </div>
</div>
