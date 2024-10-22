<p align="center"><a href="https://fmd.ag" target="_blank"><img src="https://raw.githubusercontent.com/agenciafmd/admix-ui/v11/docs/fmd.png" alt="Logo da F&MD"></a></p>

<p align="center">
<a href="https://packagist.org/packages/agenciafmd/admix-ui"><img src="https://img.shields.io/packagist/dt/agenciafmd/admix-ui" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/agenciafmd/admix-ui"><img src="https://img.shields.io/packagist/v/agenciafmd/admix-ui" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/agenciafmd/admix-ui"><img src="https://img.shields.io/packagist/l/agenciafmd/admix-ui" alt="License"></a>
</p>

## Acesso rápido

- [Instalação](#instalação)
- [Formulário](#formulário)
    - [Input](#input)
    - [Password](#password)
    - [Datetime / Date / Time](#datetime--date--time)
    - [Select](#select)
    - [Textarea](#textarea)
    - [Radio](#radio)
    - [Checkbox](#checkbox)
- [Página](#página)
    - [Form](#form)
- [UI](#ui)
    - [Card](#card)
    - [Card sem header](#card-sem-header)
- [Contribuindo](#contribuindo-com-o-projeto)
- [Licença](#licença)

## Instalação

```bash
composer install agenciafmd/admix-ui:v11.x-dev
```

## Formulário

![print do form](docs/forms/form.png "print do form")

```html

<x-form>
    <div class="mb-3">
        <x-form.input name="form.name" label="Nome" required/>
    </div>
    <div class="mb-3">
        <x-form.textarea name="form.message" label="Mensagem" maxlength=100 required/>
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
        <x-form.select name="form.select" label="Select" :options="$options" required/>
    </div>
</x-form>
```

### Input

![print do input](docs/forms/input.png "print do input")

```html

<div class="mb-3">
    <x-form.input name="form.name" label="Nome" required/>
</div>
<div class="mb-3">
    <x-form.input name="form.name" label="Nome" hint="Preencha com seu nome completo"/>
</div>
```

### Password

![print do password](docs/forms/password.png "print do password")

```html

<div class="mb-3">
    <x-form.password name="form.password" label="Senha"/>
</div>
<div class="mb-3">
    <x-form.password name="form.password" label="Senha"
                     hint="Utilize pelo menos 1 letra maiúscula e caracteres especiais"/>
</div>
```

### Datetime / Date / Time

![print do datetime-date-time](docs/forms/datetime-date-time.png "print do datetime-date-time")

```html

<div class="mb-3">
    <x-form.datetime name="form.published_at" label="Data e hora de publicação"/>
</div>
<div class="mb-3">
    <x-form.date name="form.published_at" label="Data de publicação"/>
</div>
<div class="mb-3">
    <x-form.time name="form.published_at" label="Hora de publicação"/>
</div>
```

### Select

![print do select](docs/forms/select.png "print do select")

```html

<div class="mb-3">
    @php
    $options = [
    [
    'value' => '',
    'label' => '-'
    ],
    [
    'value' => 1,
    'label' => 'São Paulo'
    ],
    [
    'value' => 2,
    'label' => 'Rio de Janeiro',
    'disabled' => true
    ]
    ];
    @endphp
    <x-form.select label="Estados" name="form.state" :options="$options"/>
</div>
```

### Textarea

![print do textarea](docs/forms/textarea.png "print do textarea")

```html
<div class="mb-3">
    <x-form.textarea name="form.message" label="Mensagem" maxlength=100 required/>
</div>
```
### Radio

![print do radio](docs/forms/radio.png "print do radio")

```html
<div class="mb-3">
  <x-form.group label="Escolha o Tipo de Imóvel:">
    <x-form.radio name="propertyType" label="Apartamento" value="apartamento"/>
    <x-form.radio name="propertyType" label="Casa" value="casa"/>
    <x-form.radio name="propertyType" label="Imóvel Comercial" value="imovel-comercial" hint="Selecione uma opção"/>
  </x-form.group>
</div>
<div class="mb-3">
  <x-form.group label="Escolha o Tipo de Imóvel:">
    <x-form.radio name="propertyType" label="Apartamento" value="apartamento"  inline/>
    <x-form.radio name="propertyType" label="Casa" value="casa"  inline/>
    <x-form.radio name="propertyType" label="Imóvel Comercial" value="imovel-comercial" hint="Selecione uma opção" inline disabled/>
  </x-form.group>
</div>
```

### Checkbox

## Página

### Form

## UI

### Card

### Card sem header

## Contribuindo com o projeto

Para rodar o projeto localmente e contribuir com o desenvolvimento:

Inicie um projeto Laravel

```bash
composer create-project laravel/laravel:v11.x-dev ui
```

Clone o repositório no projeto (não esqueça de entrar nele com `cd ui`), dentro da pasta `packages/agenciafmd/admix-ui`

```bash
git clone git@github.com:agenciafmd/admix-ui.git packages/agenciafmd/admix-ui
```

Adicione o pacote no composer.json do projeto

```json
{
    ...
    "license": "MIT",
    <!--adicione-este-nó-->
    "repositories": {
        "agenciafmd/admix-ui": {
            "type": "path",
            "url": "packages/agenciafmd/admix-ui",
            "options": {
                "symlink": true
            }
        }
    },
    "require": {
        ...
        <!--adicione-o-pacote-->
        "agenciafmd/admix-ui": "*"
    },
    ...
}
```

Agora, fazemos um update no composer para que ele reconheça o pacote

```bash
composer update
```

Se tudo correu bem, a ide vai reconhecer o pacote e você já pode começar a contribuir.

## Licença

Este projeto é entregue sob a [Licença MIT](./LICENSE).
