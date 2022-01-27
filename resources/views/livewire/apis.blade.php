<div class="flex-1 relative z-0 flex overflow-hidden">
    @include('livewire.apis.list')
    @if($currentApi)
        @include('livewire.apis.details')
    @endif
</div>
