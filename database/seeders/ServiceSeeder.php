<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    protected $services = [
        [
            'name' => 'dummy',
            'package' => 'laravel-api/dummy',
            'definition' => 'LaravelApi\Dummy\DummyWrapper',
        ],
        [
            'name' => 'twitter',
            'package' => 'laravel-api/twitter',
            'definition' => 'LaravelApi\Twitter\TwitterWrapper',
        ],
        [
            'name' => 'github',
            'package' => 'laravel-api/github',
            'definition' => 'LaravelApi\Github\GithubWrapper',
        ],
        [
            'name' => 'youtube',
            'package' => 'laravel-api/youtube',
            'definition' => 'LaravelApi\YouTube\YouTubeWrapper',
        ],
    ];

    public function run()
    {
        Service::insert($this->services);
    }
}
