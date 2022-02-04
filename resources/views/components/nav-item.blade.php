@props(['current' => request()->routeIs($route), 'icon', 'label', 'route', 'mobile' => false])

<a href="{{ route($route) }}" class="{{ $current ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'}} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
    <div class="mr-3 flex-shrink-0 h-6 w-6">
        <x-dynamic-component :component="'heroicon-o-' . $icon" :class="$current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500'"/>
    </div>
    {{ $label }}
</a>
