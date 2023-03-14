<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\PermissionService;
use App\Services\UserService;
use Exception;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(UserService $service)
    {
        return view('astronaut::user.index', [
            'users' => $service->list(new User())
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');

        $permissions = PermissionService::groupListing();
        
        return view('user.create', compact('roles', 'permissions'));
    }

    public function store(UserRequest $request, UserService $service)
    {
        $response = $service->save( $request->validated() );
        if ($response instanceof Exception)
            return redirect()->route('user.index')->with('error', $response->getMessage());
            
        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        
        $permissions = PermissionService::groupListing($user);

        return view('user.edit', compact('roles', 'permissions', 'user'));
    }

    public function update(User $user, UserRequest $request, UserService $service)
    {
        $response = $service->save($request->validated());
        if ($response instanceof Exception)
            return redirect()->route('user.index')->with('error', $response->getMessage());
            
        return redirect()->route('user.index');
    }

    public function destroy(User $user, UserService $service)
    {
        $response = $service->destroy($user);
        if ($response instanceof Exception)
            return redirect()->route('user.index')->with('error', $response->getMessage());

        return redirect()->route('user.index');
    }
}