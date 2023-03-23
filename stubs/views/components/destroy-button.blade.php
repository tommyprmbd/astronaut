<form action="{{ $route }}" method="post" style="display: inline;">
    @csrf
    
    <input type="hidden" name="_method" value="delete">
    
    <x-danger-button>
        <i class="fa-solid fa-trash-can"></i>
    </x-danger-button>

</form>