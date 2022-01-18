<?php

namespace Database\Seeders;

use App\Models\Api;
use Illuminate\Database\Seeder;

class ApiSeeder extends Seeder
{
    protected $apis = [
        [
            'key' => 'dummy',
            'name' => 'Dummy',
            'package' => 'laravel-api/dummy',
            'version' => 'dev-master',
            'wrapper_class' => 'LaravelApi\Dummy\DummyWrapper',
            'description' => 'This is the description for the Dummy Api',
            'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/OS_X_10.11_Beta_Beach_Ball.jpg/220px-OS_X_10.11_Beta_Beach_Ball.jpg',
        ],
        [
            'key' => 'twitter',
            'name' => 'Twitter',
            'package' => 'laravel-api/twitter',
            'version' => 'dev-master',
            'wrapper_class' => 'LaravelApi\Twitter\TwitterWrapper',
            'description' => 'This is the description for the Twitter Api',
            'icon' => 'https://www.ynovation.de/wordpress/wp-content/uploads/2018/07/Twitter_Social_Icon_Circle_Color.png',
        ],
        [
            'key' => 'github',
            'name' => 'GitHub',
            'package' => 'laravel-api/github',
            'version' => 'dev-master',
            'wrapper_class' => 'LaravelApi\GitHub\GitHubWrapper',
            'description' => 'This is the description for the GitHub Api',
            'icon' => 'https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png',
        ],
        [
            'key' => 'youtube',
            'name' => 'YouTube',
            'package' => 'laravel-api/youtube',
            'version' => 'dev-master',
            'wrapper_class' => 'LaravelApi\YouTube\YouTubeWrapper',
            'description' => 'This is the description for the YouTube Api',
            'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/2560px-YouTube_full-color_icon_%282017%29.svg.png',
        ],
    ];

    public function run()
    {
        Api::insert($this->apis);
    }
}
