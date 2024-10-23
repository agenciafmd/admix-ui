<button x-data="{}"
        x-on:click="window.Livewire.dispatchTo('modal.html', 'showHtml', { message: '{{ $path }}' })"
        {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
>
    <x-tblr-icon name="zoom-in" class="icon d-sm-none d-block m-0"/>
    <span class="d-none d-sm-block">
        {{ $title }}
    </span>
</button>
