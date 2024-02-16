# Formulário

## Form

@demo
<x-form>
    <div class="mb-3">
        <x-form.input name="name" label="Nome" required/>
    </div>
    <div class="mb-3">
        <x-form.textarea name="message" label="Mensagem" required/>
    </div>
    <div class="mb-3">
        @php
            $options = [
                [
                    'value' => '',
                    'label' => '-'
                ],
                [
                    'value' => 1,
                    'label' => 'Item01'
                ],
                [
                    'value' => 2,
                    'label' => 'Item02 (desabilitada)',
                    'disabled' => true
                ]
            ];
        @endphp
        <x-form.select name="select" label="Select" :options="$options" required/>
    </div>
    <div class="mb-3"> 
        <x-form.radio name="radio[]" label="Radio Button" hint="Selecione uma opção" :values="['One' => 'One', 'Two' => 'Two', 'Three' => 'Three', 'Four' => 'Four']" required/>
    </div>
    <div class="mb-3"> 
        <x-form.radio name="radio[]" label="Radio Button" inline hint="Selecione uma opção" :values="['One' => 'One', 'Two' => 'Two', 'Three' => 'Three', 'Four' => 'Four']" required/>
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
    <x-form.textarea name="message" placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" placeholder="Mensagem..." required/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" hint="Max 1000 chars" maxlength="1000" placeholder="Mensagem..."/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.textarea name="message" placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" placeholder="Mensagem..." required/>
</div>
<div class="mb-3">
    <x-form.textarea label="mensagem" name="message" hint="Max 1000 chars" maxlength="1000" placeholder="Mensagem..."/>
</div>
```

@endverbatim

## Select

@demo
@php
    $options = [
        [
            'value' => '',
            'label' => '-'
        ],
        [
            'value' => 1,
            'label' => 'Item01'
        ],
        [
            'value' => 2,
            'label' => 'Item02 (desabilitada)',
            'disabled' => true
        ]
    ];
@endphp
<div class="mb-3">
    <x-form.select name="select01" :options="$options"/>
</div>
<div class="mb-3">
    <x-form.select label="Cidade" name="select02" :options="$options" required/>
</div>
<div class="mb-3">
    <x-form.select label="Cidade" name="select03" :options="$options" hint="Selecione uma opção"/>
</div>
@enddemo

@verbatim

```blade
@php
    $options = [
        [
            'value' => '',
            'label' => '-'
        ],
        [
            'value' => 1,
            'label' => 'Item01'
        ],
        [
            'value' => 2,
            'label' => 'Item02 (desabilitada)',
            'disabled' => true
        ]
    ];
@endphp
<div class="mb-3">
    <x-form.select name="select01" :options="$options"/>
</div>
<div class="mb-3">
    <x-form.select label="Cidade" name="select02" :options="$options" required/>
</div>
<div class="mb-3">
    <x-form.select label="Cidade" name="select03" :options="$options" hint="Selecione uma opção"/>
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

## Toggle Switches

@demo
<div class="mb-3">
    <x-form.toggle name="toggle1[]" :values="[['value' => 'Toggle input', 'name' => 'Toggle input'], ['value' => 'Disabled toggle', 'name' => 'Disabled toggle'], ['value' => 'Checked toggle', 'name' => 'Checked toggle']]"/>
</div>
<div class="mb-3">
    <x-form.toggle name="toggle2[]" label="Toggle Switch" :values="[['value' => 'Toggle input', 'name' => 'Toggle input'], ['value' => 'Disabled toggle', 'name' => 'Disabled toggle'], ['value' => 'Checked toggle', 'name' => 'Checked toggle']]" required/>
</div>
<div class="mb-3">
    <x-form.toggle name="toggle3[]" label="Toggle Switch" hint="Selecione uma opção" :values="[['value' => 'Toggle input', 'name' => 'Toggle input'], ['value' => 'Disabled toggle', 'name' => 'Disabled toggle'], ['value' => 'Checked toggle', 'name' => 'Checked toggle']]"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.toggle name="toggle1[]" :values="[['value' => 'Toggle input', 'name' => 'Toggle input'], ['value' => 'Disabled toggle', 'name' => 'Disabled toggle'], ['value' => 'Checked toggle', 'name' => 'Checked toggle']]"/>
</div>
<div class="mb-3">    
    <x-form.toggle name="toggle2[]" label="Toggle Switch" :values="[['value' => 'Toggle input', 'name' => 'Toggle input'], ['value' => 'Disabled toggle', 'name' => 'Disabled toggle'], ['value' => 'Checked toggle', 'name' => 'Checked toggle']]" required/>
</div>
<div class="mb-3">    
    <x-form.toggle name="toggle3[]" label="Toggle Switch" hint="Selecione uma opção" :values="[['value' => 'Toggle input', 'name' => 'Toggle input'], ['value' => 'Disabled toggle', 'name' => 'Disabled toggle'], ['value' => 'Checked toggle', 'name' => 'Checked toggle']]"/>
</div>
```

@endverbatim

## Single Switch

@demo
<div class="mb-3">
    <x-form.toggle name="singletoggle" label="Single Switch" hint="Selecione a opção" :values="[['value' => 'I agree with terms and conditions', 'name' => 'I agree with terms and conditions']]"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">    
    <x-form.toggle name="singletoggle" label="Single Switch" hint="Selecione a opção" :values="[['value' => 'I agree with terms and conditions', 'name' => 'I agree with terms and conditions']]"/>
</div>
```

@endverbatim

## Notification

@demo
<div class="mb-3">
    <x-form.toggle-notification name="togglenotification[]" label="Notification" :values="[['value' => 'Push Notifications', 'name' => 'Push Notifications'], ['value' => 'SMS Notifications', 'name' => 'SMS Notifications'], ['value' => 'Email Notifications', 'name' => 'Email Notifications']]"/>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.toggle-notification name="togglenotification[]" label="Notification" :values="[['value' => 'Push Notifications', 'name' => 'Push Notifications'], ['value' => 'SMS Notifications', 'name' => 'SMS Notifications'], ['value' => 'Email Notifications', 'name' => 'Email Notifications']]"/>
</div>
```

@endverbatim
