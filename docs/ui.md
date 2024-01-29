# UI

## Card

@demo
<x-card>
    <x-card.header>
        <x-card.title>
            Title
            <x-card.subtitle>
                Subtitle
            </x-card.subtitle>
        </x-card.title>
    </x-card.header>
    <x-card.body>
        Body
    </x-card.body>
    <x-card.footer>
        Footer
    </x-card.footer>
</x-card>
@enddemo

@verbatim

```blade
<x-card>
    <x-card.header>
        <x-card.title>
            Title
            <x-card.subtitle>
                Subtitle
            </x-card.subtitle>
        </x-card.title>
    </x-card.header>
    <x-card.body>
        Body
    </x-card.body>
    <x-card.footer>
        Footer
    </x-card.footer>
</x-card>
```

@endverbatim

## Card sem header

@demo
<x-card>
    <x-card.body>
        <x-card.title>
            Title
        </x-card.title>
        <p class="text-secondary">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p>
    </x-card.body>
</x-card>
@enddemo
