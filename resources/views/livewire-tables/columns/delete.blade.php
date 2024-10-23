<button x-data="{}"
        x-on:click="window.Livewire.dispatchTo('modal.confirm', 'showConfirmationToDelete', { id: '{{ $path }}' })"
        {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
>
    <x-tblr-icon name="trash" class="icon d-sm-none d-block m-0"/>
    <span class="d-none d-sm-block">
        {{ $title }}
    </span>
</button>
