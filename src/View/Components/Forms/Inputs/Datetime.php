<?php

namespace Agenciafmd\Ui\View\Components\Forms\Inputs;

class Datetime extends Input
{
    public function __construct(
        public string $name = '',
        public string $label = '',
        public string $hint = '',
        public string $type = 'datetime-local',
    ) {
        parent::__construct(
            $name,
            $label,
            $hint,
            $type,
        );
    }
}
