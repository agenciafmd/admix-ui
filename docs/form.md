# Formulário

## Form

@demo
<x-form>
    <x-form.input name="name" label="Nome" required/>
    <x-form.textarea name="message" label="Mensagem" hint="Max 1000 chars" rows="15" cols="50" maxlength="1000" placeholder="Mensagem..." required/>
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

## Textarea

@demo
<div class="mb-3">
    <x-form.textarea name="message" rows="15" cols="50" maxlength="1000" placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" rows="15" cols="50" required maxlength="1000" placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" hint="Max 1000 chars" rows="15" cols="50" maxlength="1000"
    placeholder="Mensagem..."/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.textarea name="message" cols="50" rows="15" maxlength="1000" placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" cols="50" rows="15" maxlength="1000" required placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" hint="Max 1000 chars" cols="50" rows="15" maxlength="1000" placeholder="Mensagem..."/>
</div>
```

@endverbatim
