<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Services\PermissionService;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PermissionService $permissionService)
    {
        if ($request->ajax()) {
            $model = Permission::all();

            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    return view('astronaut.partial.action', [
                        'model' => $model,
                        'route' => 'permission'
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('astronaut.permission.index', [
            'permissions' => $permissionService->list(new Permission())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('astronaut.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request, PermissionService $service)
    {
        $response = $service->save( $request->validated() );
        if ($response instanceof Exception)
            return redirect()->route('permission.index')->with('error', $response->getMessage());
            
        return redirect()->route('permission.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('astronaut.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission, PermissionService $service)
    {
        $response = $service->save( $request->validated(), $permission );
        if ($response instanceof Exception)
            return redirect()->route('permission.index')->with('error', $response->getMessage());
            
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if (!$permission->delete())
            return redirect()->route('permission.index')->with('error', 'Failed to delete');

        return redirect()->route('permission.index');
    }
}
