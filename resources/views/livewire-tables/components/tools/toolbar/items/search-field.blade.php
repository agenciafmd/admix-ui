@aware(['component', 'tableName'])

<div x-cloak x-show="!currentlyReorderingStatus"
        @class([
            'mb-3 mb-md-0 input-group input-group-flat' => $component->isBootstrap(),
            'flex rounded-md shadow-sm' => $component->isTailwind(),
        ])>
    <input
            wire:model{{ $component->getSearchOptions() }}="search"
            placeholder="{{ $component->getSearchPlaceholder() }}"
            type="text"
            {{
                $attributes->merge($component->getSearchFieldAttributes())
                ->class([
                    'block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-none rounded-l-md focus:ring-0 focus:border-gray-300' => $component->isTailwind() && $component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-gray-700 dark:text-white dark:border-gray-600 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' => $component->isTailwind() && !$component->hasSearch() && $component->getSearchFieldAttributes()['default'] ?? true,
                    'form-control' => $component->isBootstrap() && $component->getSearchFieldAttributes()['default'] ?? true,
                ])
                ->except('default')
            }}
    />

    @if ($component->hasSearch())
        <span class="input-group-text">
            <a href="#" wire:click.prevent="clearSearch" class="link-secondary" -data-bs-toggle="tooltip"
               aria-label="{{ __('Clear search') }}" data-bs-original-title="{{ __('Clear search') }}"><!-- Download SVG icon from http://tabler-icons.io/i/x -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                     stroke-linejoin="round"><path
                            stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path
                            d="M6 6l12 12"></path></svg>
            </a>
        </span>
    @endif
</div>
