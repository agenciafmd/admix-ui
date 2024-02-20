<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

class Time extends Input
{
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $type = 'time',
    ) {
        parent::__construct(
            $name,
            $label,
            $hint,
            $type,
        );
    }
}
