<?php

namespace Agenciafmd\Ui\LaravelLivewireTables\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class EmitColumn extends LinkColumn
{
    protected string $view = 'admix-ui::livewire-tables.columns.emit';
}