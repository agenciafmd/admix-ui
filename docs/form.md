# Formulário

## Form

@demo
<x-form>
    <div class="mb-3">
        <x-form.input name="name" label="Nome" required/>
    </div>
    <div class="mb-3">
        <x-form.textarea name="message" label="Mensagem" hint="Max 1000 chars" rows="15" cols="50" maxlength="1000" placeholder="Mensagem..." required/>
    </div>
    <div class="mb-3">    
        <x-form.select name="select" label="Select" :values="['' => '-', 'One' => 'One','Two' => 'Two', 'Three' => 'Three']" hint="Selecione uma opção" required/>
    </div>
    <div class="mb-3">    
        <x-form.radio name="radio[]" label="Radio Button" hint="Selecione uma opção" :values="['One' => 'One','Two' => 'Two', 'Three' => 'Three', 'Four' => 'Four']" required/>
    </div>
    <div class="mb-3">    
        <x-form.radio name="radio[]" label="Radio Button" inline hint="Selecione uma opção" :values="['One' => 'One','Two' => 'Two', 'Three' => 'Three', 'Four' => 'Four']" required/>
    </div>
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

## Select

@demo
<div class="mb-3">
    <x-form.select name="select" :values="['' => '-', 'One' => 'One','Two' => 'Two', 'Three' => 'Three']"/>
</div>
<div class="mb-3">
    <x-form.select label="select" name="select" :values="['' => '-', 'One' => 'One','Two' => 'Two', 'Three' => 'Three']" required/>
</div>
<div class="mb-3">
    <x-form.select label="select" name="select" hint="Selecione uma opção" :values="['' => '-', 'One' => 'One','Two' => 'Two', 'Three' => 'Three']"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.select name="select" :values="['' => '-', One' => 'One', 'Two' => 'Two', 'Three' => 'Three']"/>
</div>
<div class="mb-3">
    <x-form.select label="select" name="select" :values="['' => '-', 'One' => 'One','Two' => 'Two', 'Three' => 'Three']" required/>
</div>
<div class="mb-3">
    <x-form.select label="select" name="select" hint="Selecione uma opção" :values="['' => '-', 'One' => 'One','Two' => 'Two', 'Three' => 'Three']"/>
</div>
```

@endverbatim

## Radios

@demo
<div class="mb-3">
    <x-form.radio name="radio1" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']"/>
</div>
<div class="mb-3">
    <x-form.radio name="radio2" label="Radio Button" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']" required/>
</div>
<div class="mb-3">
    <x-form.radio name="radio3" label="Radio Button" hint="Selecione uma opção" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.radio name="radio1" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']"/>
</div>
<div class="mb-3">    
    <x-form.radio name="radio2" label="Radio Button" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']" required/>
</div>
<div class="mb-3">    
    <x-form.radio name="radio3" label="Radio Button" hint="Selecione uma opção" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']"/>
</div>
```

@endverbatim

## Inline Radios

@demo
<div class="mb-3">
    <x-form.radio name="inlineradio1" inline :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']"/>
</div>
<div class="mb-3">
    <x-form.radio name="inlineradio2" inline label="Inline Radio Button" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']" required/>
</div>
<div class="mb-3">
    <x-form.radio name="inlineradio3" inline label="Inline Radio Button" hint="Selecione uma opção" :values="['Option 1' => 'Option 1','Option 2' => 'Option 2', 'Option 3' => 'Option 3', 'Option 4' => 'Option 4']"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.radio name="inlineradio1" inline :values="['One' => 'One', 'Two' => 'Two', 'Three' => 'Three', 'Four' => 'Four']"/>
</div>
<div class="mb-3">
    <x-form.radio name="inlineradio2" inline label="Inline Radio" :values="['One' => 'One','Two' => 'Two', 'Three' => 'Three', 'Four' => 'Four']" required/>
</div>
<div class="mb-3">    
    <x-form.radio name="inlineradio3" inline label="Inline Radio" hint="Selecione uma opção" :values="['One' => 'One','Two' => 'Two', 'Three' => 'Three', 'Four' => 'Four']"/>
</div>
```

@endverbatim

## Checkboxes

@demo
<div class="mb-3">
    <x-form.checkbox name="checkbox1[]" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
<div class="mb-3">
    <x-form.checkbox name="checkbox2[]" label="Checkbox" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]" required/>
</div>
<div class="mb-3">
    <x-form.checkbox name="checkbox3[]" label="Checkbox" hint="Selecione uma opção" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.checkbox name="checkbox1[]" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
<div class="mb-3">    
    <x-form.checkbox name="checkbox2[]" label="Checkbox" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]" required/>
</div>
<div class="mb-3">    
    <x-form.checkbox name="checkbox3[]" label="Checkbox" hint="Selecione uma opção" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
```

@endverbatim

## Checkboxes with description

@demo
<div class="mb-3">
    <x-form.checkbox name="checkbox1[]" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input', 'description' => 'Description Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox', 'description' => 'Description Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox', 'description' => 'Description Checked checkbox']]"/>
</div>
<div class="mb-3">
    <x-form.checkbox name="checkbox2[]" label="Checkbox" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input', 'description' => 'Description Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox', 'description' => 'Description Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox', 'description' => 'Description Checked checkbox']]" required/>
</div>
<div class="mb-3">
    <x-form.checkbox name="checkbox3[]" label="Checkbox" hint="Selecione uma opção" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input', 'description' => 'Description Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox', 'description' => 'Description Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox', 'description' => 'Description Checked checkbox']]"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.checkbox name="checkbox1[]" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input', 'description' => 'Description Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox', 'description' => 'Description Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox', 'description' => 'Description Checked checkbox']]"/>
</div>
<div class="mb-3">    
    <x-form.checkbox name="checkbox2[]" label="Checkbox" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input', 'description' => 'Description Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox', 'description' => 'Description Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox', 'description' => 'Description Checked checkbox']]" required/>
</div>
<div class="mb-3">    
    <x-form.checkbox name="checkbox3[]" label="Checkbox" hint="Selecione uma opção" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input', 'description' => 'Description Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox', 'description' => 'Description Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox', 'description' => 'Description Checked checkbox']]"/>
</div>
```

@endverbatim

## Inline Checkboxes

@demo
<div class="mb-3">
    <x-form.checkbox name="inlinecheckbox1[]" inline :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
<div class="mb-3">
    <x-form.checkbox name="inlinecheckbox2[]" inline label="Inline Checkbox" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]" required/>
</div>
<div class="mb-3">
    <x-form.checkbox name="inlinecheckbox3[]" inline label="Inline Checkbox" hint="Selecione uma opção" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.radio name="inlinecheckbox1[]" inline :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
<div class="mb-3">
    <x-form.checkbox name="inlinecheckbox2[]" inline label="Inline Checkbox" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]" required/>
</div>
<div class="mb-3">    
    <x-form.checkbox name="inlinecheckbox3[]" inline label="Inline Checkbox" hint="Selecione uma opção" :values="[['value' => 'Checkbox input', 'name' => 'Checkbox input'], ['value' => 'Disabled checkbox', 'name' => 'Disabled checkbox'], ['value' => 'Checked checkbox', 'name' => 'Checked checkbox']]"/>
</div>
```

@endverbatim


