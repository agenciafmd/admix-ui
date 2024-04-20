<?php

namespace Agenciafmd\Ui\LaravelLivewireTables\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ModalColumn extends LinkColumn
{
    protected string $view = 'admix-ui::livewire-tables.columns.modal';
}
