# Formulário

## Form

@demo
<x-form>
    <div class="mb-3">
        <x-form.input name="name" label="Nome" required/>
    </div>
    <div class="mb-3">
        <x-form.textarea name="message" label="Mensagem" maxlength=100 required/>
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
                    'label' => 'Item02'
                ],
                [
                    'value' => 3,
                    'label' => 'Item03 (desabilitada)',
                    'disabled' => true
                ]
            ];
        @endphp
        <x-form.select name="select" label="Select" :options="$options" required/>
    </div>
</x-form>
@enddemo

## Input

@demo
<div class="mb-3">
    <x-form.input name="name" label="Input" required/>
</div>
<div class="mb-3">
    <x-form.input name="name" label="Input com hint" hint="Preencha com seu nome completo"/>
</div>
<div class="mb-3">
    <x-form.datetime name="published_at" label="Data e hora de publicação"/>
</div>
<div class="mb-3">
    <x-form.date name="published_at" label="Data de publicação"/>
</div>
<div class="mb-3">
    <x-form.time name="published_at" label="Hora de publicação"/>
</div>
<div class="mb-3">
    <x-form.password name="password" label="Senha"/>
</div>
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
    <x-form.select label="Select" name="select02" :options="$options"/>
</div>
<div class="mb-3">
    <x-form.textarea label="Textarea" name="message" hint="Máx. 1000 caracteres" maxlength="1000" placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.group label="Radios">
        <x-form.radio name="radio2" label="Option 01" value="option01"/>
        <x-form.radio name="radio2" label="Option 02" value="option02"/>
        <x-form.radio name="radio2" label="Option 03" value="option03" disabled/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio3" label="Option 01" value="option01" inline/>
        <x-form.radio name="radio3" label="Option 02" value="option02" inline/>
        <x-form.radio name="radio3" label="Option 03" value="option03" inline disabled/>
    </x-form.group>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.input name="name" label="Input" required/>
</div>
<div class="mb-3">
    <x-form.input name="name" label="Input com hint" hint="Preencha com seu nome completo"/>
</div>
<div class="mb-3">
    <x-form.password name="password" label="Senha"/>
</div>
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
    <x-form.select label="Select" name="select02" :options="$options"/>
</div>
<div class="mb-3">
    <x-form.textarea label="Textarea" name="message" hint="Máx. 1000 caracteres" maxlength="1000" placeholder="Mensagem..."/>
</div>
<div class="mb-3">
    <x-form.group label="Radios">
        <x-form.radio name="radio2" label="Option 01" value="option01"/>
        <x-form.radio name="radio2" label="Option 02" value="option02"/>
        <x-form.radio name="radio2" label="Option 03" value="option03" disabled/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio3" label="Option 01" value="option01" inline/>
        <x-form.radio name="radio3" label="Option 02" value="option02" inline/>
        <x-form.radio name="radio3" label="Option 03" value="option03" inline disabled/>
    </x-form.group>
</div>
```

@endverbatim

## Radios

@demo
<div class="mb-3">
    <x-form.group label="Radios">
        <x-form.radio name="radio2" label="Option 01" value="option01"/>
        <x-form.radio name="radio2" label="Option 02" value="option02"/>
        <x-form.radio name="radio2" label="Option 03" value="option03" disabled/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios">
    <x-form.radio name="radio2" label="Option 01" value="option01" required/>
    <x-form.radio name="radio2" label="Option 02" value="option02" required/>
    <x-form.radio name="radio2" label="Option 03" value="option03" required/>
 </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios">
        <x-form.radio name="radio2" label="Option 01" value="option01"/>
        <x-form.radio name="radio2" label="Option 02" value="option02"/>
        <x-form.radio name="radio2" label="Option 03" value="option03" hint="Selecione uma opção"/>
 </x-form.group>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.group label="Radios">
        <x-form.radio name="radio2" label="Option 01" value="option01"/>
        <x-form.radio name="radio2" label="Option 02" value="option02"/>
        <x-form.radio name="radio2" label="Option 03" value="option03" disabled/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios">
        <x-form.radio name="radio2" label="Option 01" value="option01" required/>
        <x-form.radio name="radio2" label="Option 02" value="option02" required/>
        <x-form.radio name="radio2" label="Option 03" value="option03" required/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios">
        <x-form.radio name="radio2" label="Option 01" value="option01"/>
        <x-form.radio name="radio2" label="Option 02" value="option02"/>
        <x-form.radio name="radio2" label="Option 03" value="option03" hint="Selecione uma opção"/>
    </x-form.group>
</div>
```

@endverbatim

## Inline Radios

@demo
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio2" label="Option 01" value="option01" inline/>
        <x-form.radio name="radio2" label="Option 02" value="option02" inline/>
        <x-form.radio name="radio2" label="Option 03" value="option03" inline disabled/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio2" label="Option 01" value="option01" inline required/>
        <x-form.radio name="radio2" label="Option 02" value="option02" inline required/>
        <x-form.radio name="radio2" label="Option 03" value="option03" inline required/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio2" label="Option 01" value="option01" inline/>
        <x-form.radio name="radio2" label="Option 02" value="option02" inline/>
        <x-form.radio name="radio2" label="Option 03" value="option03" hint="Selecione uma opção" inline/>
    </x-form.group>
</div>
@enddemo

@verbatim

```blade
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio2" label="Option 01" value="option01" inline/>
        <x-form.radio name="radio2" label="Option 02" value="option02" inline/>
        <x-form.radio name="radio2" label="Option 03" value="option03" inline disabled/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio2" label="Option 01" value="option01" inline required/>
        <x-form.radio name="radio2" label="Option 02" value="option02" inline required/>
        <x-form.radio name="radio2" label="Option 03" value="option03" inline required/>
    </x-form.group>
</div>
<div class="mb-3">
    <x-form.group label="Radios inline">
        <x-form.radio name="radio2" label="Option 01" value="option01" inline/>
        <x-form.radio name="radio2" label="Option 02" value="option02" inline/>
        <x-form.radio name="radio2" label="Option 03" value="option03" hint="Selecione uma opção" inline/>
    </x-form.group>
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
