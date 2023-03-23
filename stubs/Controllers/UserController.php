<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request, UserService $service)
    {
        if ($request->ajax()) {
            $model = User::all();

            return DataTables::of($model)
                ->addColumn('action', function ($model) {
                    return view('astronaut.partial.action', [
                        'model' => $model,
                        'route' => 'user'
                    ]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('astronaut.user.index', [
            'users' => $service->list(new User())
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('astronaut.user.create', compact('roles'));
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

        return view('astronaut.user.edit', compact('roles', 'user'));
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