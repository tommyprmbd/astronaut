<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" style="padding-bottom: .745rem">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <a href="{{ route('permission.create') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Add') }}
                    </a>

                    <table class="table mt-4 shadow-sm text-gray-700" id="datatable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>
                                    <i class="fa-solid fa-gear"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        $('#datatable').DataTable( {
            serverSide: true,
            ajax: '{{ route("permission.index") }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action', sortable: false, searchable: false },
            ]
        } );
    </script>
    @endpush
</x-app-layout>