<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    protected $services = [
        [
            'key' => 'dummy',
            'name' => 'Dummy',
            'package' => 'laravel-api/dummy',
            'definition' => 'LaravelApi\Dummy\DummyWrapper',
        ],
        [
            'key' => 'twitter',
            'name' => 'Twitter',
            'package' => 'laravel-api/twitter',
            'definition' => 'LaravelApi\Twitter\TwitterWrapper',
        ],
        [
            'key' => 'github',
            'name' => 'GitHub',
            'package' => 'laravel-api/github',
            'definition' => 'LaravelApi\Github\GithubWrapper',
        ],
        [
            'key' => 'youtube',
            'name' => 'YouTube',
            'package' => 'laravel-api/youtube',
            'definition' => 'LaravelApi\YouTube\YouTubeWrapper',
        ],
    ];

    public function run()
    {
        Service::insert($this->services);
    }
}
