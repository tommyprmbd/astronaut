<x-app-layout title="User">
    
    <h1>Role</h1>
    
    <a href="{{ route('role.create') }}">Add</a>

    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @if (count($roles) > 0)
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route('role.edit', $role->id) }}">Edit</a>
                            <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>  
                @endforeach
            @else
            <tr>
                <td colspan="3">Data not found.</td>
            </tr>
            @endif
        </tbody>
    </table>

</x-app-layout>