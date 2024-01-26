# Páginas

## Form

Estrutura de página utilizado nos CRUDs

@demo(["class" => "col-12"])
<x-page.form>
    <x-slot:title>
        title
    </x-slot:title>

    <x-slot:headerActions>
        headerActions
    </x-slot:headerActions>
    
    slot
    
    <x-slot:complement>
        complement
    </x-slot:complement>

    <x-slot:actions>
        actions
    </x-slot:actions>
</x-form>
@enddemo

@verbatim

```blade
<x-page.form>
    <x-slot:title>
        title
    </x-slot:title>

    <x-slot:headerActions>
        headerActions
    </x-slot:headerActions>
    
    slot
    
    <x-slot:complement>
        complement
    </x-slot:complement>

    <x-slot:actions>
        actions
    </x-slot:actions>
</x-form>
```

@endverbatim

## Exemplo

@demo(["class" => "col-12"])
<x-page.form>
    <x-slot:title>
        {{ __('Update :name', ['name' => 'articles']) }}
    </x-slot:title>

    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input name="model.name" :label="__('name')"/>
        </div>
        <div class="col-md-6 mb-3">
            <!-- input here -->
        </div>
    </div>
    
    <x-slot:complement>
        <div class="mb-3">
            <x-form.plaintext :label="__('id')"
                              value="1"/>
        </div>
        <div class="mb-3">
            <x-form.plaintext :label="__('slug')"
                              value="irineu-junior"/>
        </div>
        <div class="mb-3">
            <x-form.plaintext :label="__('created_at')"
                              value="01/01/2024 08:00"/>
        </div>
        <div class="mb-3">
            <x-form.plaintext :label="__('updated_at')"
                              value="01/01/2024 09:00"/>
        </div>
    </x-slot:complement>
</x-form>
@enddemo

@verbatim

```blade
<x-page.form>
    <x-slot:title>
        {{ __('Update :name', ['name' => 'articles']) }}
    </x-slot:title>

    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input name="model.name" :label="__('name')"/>
        </div>
        <div class="col-md-6 mb-3">
            <!-- input here -->
        </div>
    </div>
    
    <x-slot:complement>
        <div class="mb-3">
            <x-form.plaintext :label="__('id')"
                              value="1"/>
        </div>
        <div class="mb-3">
            <x-form.plaintext :label="__('slug')"
                              value="irineu-junior"/>
        </div>
        <div class="mb-3">
            <x-form.plaintext :label="__('created_at')"
                              value="01/01/2024 08:00"/>
        </div>
        <div class="mb-3">
            <x-form.plaintext :label="__('updated_at')"
                              value="01/01/2024 09:00"/>
        </div>
    </x-slot:complement>
</x-form>
```

@endverbatim
