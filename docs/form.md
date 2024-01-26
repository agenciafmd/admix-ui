# Formulário

## Form

@demo
<x-form>
    <x-form.input name="name" label="Nome" required/>
</x-form>
@enddemo

## Input

@demo
<div class="mb-3">
    <x-form.input name="name"/>
</div>
<div class="mb-3">
    <x-form.input name="name" label="Nome" required/>
</div>
<div class="mb-3">
    <x-form.input name="name" label="Nome" hint="Preencha com seu nome completo"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.input name="name"/>
</div>
<div class="mb-3">
    <x-form.input name="name" label="Nome" required/>
</div>
<div class="mb-3">
    <x-form.input name="name" label="Nome" hint="Preencha com seu nome completo"/>
</div>
```

@endverbatim
