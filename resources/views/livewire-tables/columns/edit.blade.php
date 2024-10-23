<a href="{{ $path }}" {!! count($attributes) ? $column->arrayToAttributes($attributes) : '' !!}>
    <x-tblr-icon name="pencil" class="icon d-sm-none d-block m-0"/>
    <span class="d-none d-sm-block">
        {{ $title }}
    </span>
</a>