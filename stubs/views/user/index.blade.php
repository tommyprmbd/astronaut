<x-app-layout title="User">
    
    <h1>User</h1>
    
    <a href="{{ route('user.create') }}">Add</a>

    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>  
                @endforeach
            @else
            <tr>
                <td colspan="4">Data not found.</td>
            </tr>
            @endif
        </tbody>
    </table>
</x-app-layout>