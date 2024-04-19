<?php

namespace Agenciafmd\Ui\LaravelLivewireTables\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class DeleteColumn extends LinkColumn
{
    protected string $view = 'admix-ui::livewire-tables.columns.delete';
}