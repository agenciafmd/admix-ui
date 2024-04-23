<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

class Email extends Input
{
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $type = 'email',
    ) {
        parent::__construct(
            $name,
            $label,
            $hint,
            $type,
        );
    }
}
