<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Service extends Component
{
    public \App\Models\Service $service;

    public function render()
    {
        return view('livewire.service')
            ->layout('layouts.guest');
    }
}
