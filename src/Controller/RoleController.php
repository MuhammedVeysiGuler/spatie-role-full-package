<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helper\Permission\Permission as HelperPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{

    public function index()
    {
        return view('spatie-role-full-code::role.index');
    }

    public function fetch()
    {
        $roles = Role::all();
        return DataTables::of($roles)
            ->addColumn('update', function ($data) {
                return '<a href="' . route('panel.super_admin_role.edit', $data->id) . '" class="btn btn-warning">Güncelle</a>';
            })->addColumn('delete', function ($data) {
                return '<a data-toggle="tooltip" onclick="remove(' . $data->id . ',\'' . $data->name . '\')" data-target="#detail_modal" class="btn btn-danger">Sil</a>';
            })->addColumn('created_at', function ($data) {
                $created_at = '-';
                if (!is_null($data->created_at)) {
                    $created_at = date('Y-m-d / H:i:s', strtotime($data->created_at));
                }
                return $created_at;
            })->addColumn('updated_at', function ($data) {
                $updated_at = '-';
                if (!is_null($data->updated_at)) {
                    $updated_at = date('Y-m-d / H:i:s', strtotime($data->updated_at));
                }
                return $updated_at;
            })->rawColumns(['delete', 'update', 'content', 'created_at', 'updated_at'])->make();
    }

    public function create()
    {
        $permissions = new HelperPermission();
        return view('spatie-role-full-code::role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'distinct',
            'name' => 'required|string|max:255',
            'permissions.*' => 'exists:permissions,name',
            'permissions' => 'required',
        ]);
        foreach ($request->all() as $key => $value) {
            if ($key != "permissions")
                $request->$key = HelperPermission::scriptStripper($value);
        }

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('panel.super_admin_role.index');
    }

    public function show(Request $request, $id)
    {
        $request->validate([
            'id' => 'distinct',
        ]);
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'id' => 'distinct',
        ]);
        $role = Role::findById($id);
        $permissions = new HelperPermission();

        return view('spatie-role-full-code::role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'id' => 'distinct',
            'name' => 'required|string|max:255',
            'permissions.*' => 'exists:permissions,name',
            'permissions' => 'required',
        ]);
        foreach ($request->all() as $key => $value) {
            if ($key != "permissions")
                $request->$key = HelperPermission::scriptStripper($value);
        }

        $permissions = HelperPermission::scriptStripper(implode(',', $request->permissions));
        $request->permissions = explode(',', $permissions);

        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);
        return redirect()->route('panel.super_admin_role.index');
    }

    public function destroy(Request $request, $id)
    {
        $request->validate(['id' => 'distinct',]);

        $role = Role::findById($id);
        if ($role) {
            if ($role->delete()) {
                return response()->json(['success' => Lang::get('success/index.success')]);
            } else {
                return response()->json(['error' => Lang::get('error/index.error')]);
            }
        } else {
            return response()->json(['error' => Lang::get('error/index.error')]);
        }

    }

}