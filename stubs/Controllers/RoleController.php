<?php
namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Exception;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(RoleService $service)
    {
        return view('role.index', [
            'roles' => $service->list(new Role())
        ]);
    }

    public function create()
    {
        $permissions = PermissionService::groupListing();
        
        return view('role.create', compact('permissions'));
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
        $permissions = PermissionService::groupListing($role);

        return view('role.edit', compact('role', 'permissions'));
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