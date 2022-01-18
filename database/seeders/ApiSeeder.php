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
            'wrapper_package' => 'laravel-api/dummy',
            'api_package' => 'laravel-api/dummy',
            'version' => 'dev-master',
            'wrapper_class' => 'LaravelApi\Dummy\DummyWrapper',
            'description' => 'This is the description for the Dummy Api',
            'icon' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/OS_X_10.11_Beta_Beach_Ball.jpg/220px-OS_X_10.11_Beta_Beach_Ball.jpg',
        ],
        [
            'key' => 'twitter',
            'name' => 'Twitter',
            'wrapper_package' => 'laravel-api/twitter',
            'api_package' => 'abraham/twitteroauth',
            'version' => 'dev-master',
            'wrapper_class' => 'LaravelApi\Twitter\TwitterWrapper',
            'description' => 'This is the description for the Twitter Api',
            'icon' => 'https://www.ynovation.de/wordpress/wp-content/uploads/2018/07/Twitter_Social_Icon_Circle_Color.png',
        ],
        [
            'key' => 'github',
            'name' => 'GitHub',
            'wrapper_package' => 'laravel-api/github',
            'api_package' => 'graham-campbell/github',
            'version' => 'dev-master',
            'wrapper_class' => 'LaravelApi\GitHub\GitHubWrapper',
            'description' => 'This is the description for the GitHub Api',
            'icon' => 'https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png',
        ],
        [
            'key' => 'youtube',
            'name' => 'YouTube',
            'wrapper_package' => 'laravel-api/youtube',
            'api_package' => 'alaouy/youtube',
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
