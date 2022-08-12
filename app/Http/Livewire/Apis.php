<?php

namespace App\Http\Livewire;

use App\Enums\ApiStatus;
use App\Models\Api;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Apis extends Component
{
    public $search;
    public Api $currentApi;
    public $method;
    public $api;

    protected $queryString = [
        'api' => ['except' => ''],
    ];

    public function mount()
    {
        if($this->api) {
            $this->currentApi = Api::firstWhere('key', $this->api);
        }
    }

    public function render()
    {
        return view('livewire.apis', [
            'countApis' => DB::table('apis')->count(),
            'apis' => $this->getApis(),
        ])
        ->layout('layouts.app');
    }

    public function setApi(Api $api)
    {
        $this->currentApi = $api;
        $this->api = $api->key;
    }

    public function setMethod($method)
    {
        $this->method = $method == $this->method ? null : $method;
    }

    private function getApis()
    {
        return Api::query()
            ->when($this->search, fn($query) => $query->where('name', 'LIKE', '%' . $this->search . '%'))
            ->where('status', ApiStatus::PUBLISHED)
            ->orderBy('name')
            ->get()
            ->groupBy(fn(Api $api) => substr($api->name, 0, 1));
    }
}
