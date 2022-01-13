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
            'description' => 'This is the description for the Dummy service',
        ],
        [
            'key' => 'twitter',
            'name' => 'Twitter',
            'package' => 'laravel-api/twitter',
            'definition' => 'LaravelApi\Twitter\TwitterWrapper',
            'description' => 'This is the description for the Twitter service',
        ],
        [
            'key' => 'github',
            'name' => 'GitHub',
            'package' => 'laravel-api/github',
            'definition' => 'LaravelApi\Github\GithubWrapper',
            'description' => 'This is the description for the GitHub service',
        ],
        [
            'key' => 'youtube',
            'name' => 'YouTube',
            'package' => 'laravel-api/youtube',
            'definition' => 'LaravelApi\YouTube\YouTubeWrapper',
            'description' => 'This is the description for the YouTube service',
        ],
    ];

    public function run()
    {
        Service::insert($this->services);
    }
}
