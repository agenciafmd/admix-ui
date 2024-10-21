<?php

namespace Agenciafmd\Ui\Traits;

trait WithKeyValue
{
    public function updatedForm(mixed $value, string $key): void
    {
        $this->validateOnly('form.' . $key);
    }

    public function keyValueAdd(string $field): void
    {
        $this->form->{$field}[] = [
            'key' => '',
            'value' => '',
        ];
    }

    public function keyValueRemove(string $field, int $i): void
    {
        unset($this->form->{$field}[$i]);

        $this->form->{$field} = array_values($this->form->{$field});
    }
}
