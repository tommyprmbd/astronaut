<x-app-layout title="Role">

    <h1>Edit Role #{{ $role->id }}</h1>
    
    <form action="{{ route('role.destroy', $role->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <button type="submit">Delete</button>
    </form>
    <a href="{{ route('role.create') }}">Add New</a>
    <a href="{{ route('role.index') }}">List</a>

    <form action="{{ route('role.update', $role->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="put">
        <table>
            <tr>
                <td>
                    <label for="name">Name*</label>
                </td>
                <td>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? $role->name }}" />
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
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
                                @if ((!empty(old('permissions')) && in_array($id, old('permissions'))) || $role->hasPermissionTo($id))
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
                    <a href="{{ route('role.index') }}">
                        Cancel
                    </a>
                </td>
            </tr>
        </table>



    </form>

</x-app-layout>