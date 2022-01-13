<div class="p-6">
    <h1 class="text-3xl font-bold">
        {{ $service->name }}
    </h1>

    <h2 class="text-2xl font-bold mt-4">
        Description
    </h2>
    {{ $service->description }}


    <h2 class="text-2xl font-bold mt-4">
        Installation
    </h2>
    <code>php artisan api:install {{ $service->key }}</code>

    @if(count($service->documentation['env']) > 0)
        <div class="mt-2">
            <div class="font-bold">Needed .env keys:</div>
            @foreach($service->documentation['env'] as $key => $description)
                <code>{{ $key }}</code> - {{ $description }}
            @endforeach
        </div>
    @endif

    <h2 class="text-2xl font-bold mt-4">
        Documentation
    </h2>

    @foreach($service->documentation['methods'] as $method)
        <div class="mb-2">
            <code>
                api('{{ $service->key }}')-><span class="font-bold">{{ $method['name'] }}({{ collect($method['parameters'])->map(fn($parameter) => $parameter['typeHint'] . ' $' . $parameter['name'])->implode(', ') }})</span>
            </code>

            <div>
                {{ $method['summary'] }}
            </div>
        </div>
    @endforeach

</div>
