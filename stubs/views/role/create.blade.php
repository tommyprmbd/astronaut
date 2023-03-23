<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Add Role') }}
                            </h2>
                        </header>

                        <form action="{{ route('role.store') }}" method="post" class="mt-4 text-gray-700 space-y-6">
                            @csrf
    
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="permission" :value="__('Permission')" />
                                @if (empty($permissions))
                                    {{ __('Permission not found') }}
                                @else
                                    @foreach ($permissions as $name)
                                        <div class="permission-item">
                                        @if (!empty(old('permission')) && in_array($name, old('permission')))
                                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $name }}" id="{{ 'permission-' . $name }}" checked>
                                        @else
                                            <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $name }}" id="{{ 'permission-' . $name }}">
                                        @endif
                                            <label for="{{ 'permission-' . $name }}">
                                                {{ $name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                                <x-input-error class="mt-2" :messages="$errors->get('permission')" />
                            </div>
                            
                            <x-primary-button>{{ __('Create') }}</x-primary-button>

                            <x-cancel-button :route="route('permission.index')">{{ __('Cancel') }}</x-cancel-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>