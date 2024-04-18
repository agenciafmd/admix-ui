@aware(['component'])
@props([
    'filter',
    'theme' => 'tailwind',
    'filterLayout' => 'popover',
    'tableName' => 'table'
])

<label for="{{ $tableName }}-filter-{{ $filter->getKey() }}"
       class="form-label">
    {{ str($filter->getName())->ucfirst() }}
</label>
