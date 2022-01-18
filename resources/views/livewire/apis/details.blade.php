<main class="flex-1 relative z-0 overflow-y-auto focus:outline-none xl:order-last">
    <article>
        <!-- Profile header -->
        <div>
            <div class="bg-pink-500 h-16 text-white text-center pt-4 text-2xl font-bold">
                {{ $api->name }}
            </div>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="-mt-12 sm:flex sm:items-end sm:space-x-5">
                    <div class="flex">
                        <img class="h-20 w-20 rounded-full ring-4 ring-white" src="{{ $api->icon }}" alt="">
                    </div>
                    {{--
                    <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                        <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <button type="button" class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                <!-- Heroicon name: solid/mail -->
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                <span>Message</span>
                            </button>
                            <button type="button" class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                <!-- Heroicon name: solid/phone -->
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span>Call</span>
                            </button>

                        </div>
                    </div>
                    --}}
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mt-6 sm:mt-2 2xl:mt-5" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'description' }" id="tab_wrapper">
            <div class="border-b border-gray-200">
                <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8" >
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <!-- Current: "border-pink-500 text-gray-900", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                        <a :class="{ 'border-pink-500 text-gray-900': tab === 'description' }" @click.prevent="tab = 'description'; window.location.hash = 'description'" href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                            Description
                        </a>

                        <a :class="{ 'border-pink-500 text-gray-900': tab === 'installation' }" @click.prevent="tab = 'installation'; window.location.hash = 'installation'" href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Installation
                        </a>

                        <a :class="{ 'border-pink-500 text-gray-900': tab === 'methods' }" @click.prevent="tab = 'methods'; window.location.hash = 'methods'" href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Methods
                        </a>
                    </nav>
                </div>
            </div>


            <div x-show="tab === 'description'" class="text-gray-700 p-4 ml-4">
                {{ $api->description }}
            </div>
            <div x-show="tab === 'installation'" class="text-gray-700 p-4 ml-4">
                <code>php artisan api:install {{ $api->key }}</code>

                @if(count($api->documentation['env']) > 0)
                    <div class="mt-2">
                        <div class="font-bold">Needed .env keys:</div>
                        @foreach($api->documentation['env'] as $key => $description)
                            <div>
                                <code>{{ $key }}</code> - {{ $description }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div x-show="tab === 'methods'" class="text-gray-700 p-4 ml-4">
                @foreach($api->documentation['methods'] as $aMethod)
                    <div class="mb-2 hover:bg-gray-50 cursor-pointer flex justify-between" wire:click="setMethod('{{ $aMethod['name'] }}')">
                        <div>
                            <code>
                                api('{{ $api->key }}')-><span class="font-bold">{{ $aMethod['name'] }}({{ collect($aMethod['parameters'])->map(fn($parameter) => $parameter['typeHint'] . ' $' . $parameter['name'])->implode(', ') }})</span>
                            </code>

                            <div>
                                {{ $aMethod['summary'] }}
                            </div>

                            @if($method == $aMethod['name'])
                                @if($aMethod['description'])
                                    <span class="text-sm italic">
                                        {{ $aMethod['description'] }}
                                    </span>
                                @endif
                                @if(Arr::has($aMethod, 'exampleResponse'))
                                    <div class="text-xs font-bold mt-2">Example response</div>
                                    <pre><?php print_r($aMethod['exampleResponse']); ?></pre>
                                @endif
                            @endif
                        </div>

                        @if(Arr::has($aMethod, 'exampleResponse'))
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    fakeable
                                </span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </article>
</main>
