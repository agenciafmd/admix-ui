<button x-data="{}"
        x-on:click="{{ $path }}"
        {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}
>
    <x-tblr-icon name="{{ $attributes['icon'] ?? 'click' }}" class="icon d-sm-none d-block m-0"/>
    <span class="d-none d-sm-block">
        {{ $title }}
    </span>
</button>
