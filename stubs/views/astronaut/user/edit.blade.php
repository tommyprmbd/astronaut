<x-app-layout title="User">

    <h1>Edir User #{{ $user->id }}</h1>
    
    <form action="{{ route('user.destroy', $user->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('user.create') }}">Add New</a>
    <a href="{{ route('user.index') }}">List</a>

    <form action="{{ route('user.update', $user->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="put">
        <table>
            <tr>
                <td>
                    <label for="name">Name*</label>
                </td>
                <td>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? $user->name }}" />
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    <label for="email">Email*</label>
                </td>
                <td>
                    <input type="email" name="email" id="email" value="{{ old('email') ?? $user->email }}" />
                    @error('email')
                        <small>{{ $message }}</small>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    <label for="password">Password</label>
                </td>
                <td>
                    <input type="password" name="password" id="password" value="{{ old('password') }}" />
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    <label for="password_confirmation">Retype Password</label>
                </td>
                <td>
                    <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" />
                    @error('password_confirmation')
                        <small>{{ $message }}</small>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    <label for="role">Role</label>
                </td>
                <td>
                    <select name="role" id="role">
                        <option selected>Choose</option>
                        @foreach ($roles as $key => $role)
                            @if (old('role') == $key || $user->hasRole($key))
                                <option value="{{ $key }}" selected>{{ $role }}</option>
                            @else
                                <option value="{{ $key }}">{{ $role }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="permissions">Permissions</label>
                </td>
                <td>
                    @if (empty($permissions))
                        Permission not found
                    @else
                        @foreach ($permissions as $group => $permission)
                            <h3>{{ $group }}</h3>
                            @foreach ($permission as $id => $item)
                                @if ((!empty(old('permissions')) && in_array($id, old('permissions'))) || $user->hasPermissionTo($id))
                                    <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $id }}" id="{{ 'permission-' . $id }}" checked>
                                @else
                                    <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $id }}" id="{{ 'permission-' . $id }}">
                                @endif
                                    <label for="{{ 'permission-' . $id }}">
                                        {{ $item['name'] }}
                                    </label>
                            @endforeach
                        @endforeach
                    @endif
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit">Save</button>
                    <a href="{{ route('user.index') }}">
                        Cancel
                    </a>
                </td>
            </tr>
        </table>



    </form>

</x-app-layout>