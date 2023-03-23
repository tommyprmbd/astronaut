<?php
namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index(Request $request, RoleService $service)
    {
        if ($request->ajax()) {
            $model = Role::all();

            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    return view('astronaut.partial.action', [
                        'model' => $model,
                        'route' => 'role'
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('astronaut.role.index', [
            'roles' => $service->list(new Role())
        ]);
    }

    public function create()
    {
        $permissions = Permission::orderBy('name')->pluck('name');
        
        return view('astronaut.role.create', compact('permissions'));
    }

    public function store(RoleRequest $request, RoleService $service)
    {
        $response = $service->save( $request->validated() );
        if ($response instanceof Exception)
            return redirect()->route('role.index')->with('error', $response->getMessage());
            
        return redirect()->route('role.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->pluck('name');

        return view('astronaut.role.edit', compact('role', 'permissions'));
    }

    public function update(Role $role, RoleRequest $request, RoleService $service)
    {
        $response = $service->save($request->validated(), $role);
        if ($response instanceof Exception)
            return redirect()->route('role.index')->with('error', $response->getMessage());
            
        return redirect()->route('role.index');
    }

    public function destroy(Role $role, RoleService $service)
    {
        $response = $service->destroy($role);
        if ($response instanceof Exception)
            return redirect()->route('role.index')->with('error', $response->getMessage());

        return redirect()->route('role.index');
    }
}