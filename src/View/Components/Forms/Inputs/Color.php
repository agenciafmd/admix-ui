<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

class Color extends Input
{
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $type = 'color',
        public array $defaultClass = [
            'form-control',
            'form-control-color',
        ],
    ) {
        parent::__construct(
            $name,
            $label,
            $hint,
            $type,
            $defaultClass,
        );
    }
}
