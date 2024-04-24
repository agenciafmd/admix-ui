<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

class Number extends Input
{
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $type = 'number',
    ) {
        parent::__construct(
            $name,
            $label,
            $hint,
            $type,
        );
    }
}
