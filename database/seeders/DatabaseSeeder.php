<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws FileCannotBeAdded
     */
    public function run(): void
    {
        $apps = App::factory(100)->for(User::factory())->create();

        $exampleLogos = [
            'https://img.freepik.com/darmowe-wektory/logo-instagrama_1199-122.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Facebook_logo_%28square%29.png/640px-Facebook_logo_%28square%29.png',
            'https://static.vecteezy.com/system/resources/thumbnails/023/986/480/small_2x/youtube-logo-youtube-logo-transparent-youtube-icon-transparent-free-free-png.png',
            'https://cdn.logojoy.com/wp-content/uploads/20220329171710/telegram-app-logo.png',
            'https://thumbs.dreamstime.com/b/web-184356092.jpg',
            'https://img.freepik.com/free-psd/3d-icon-social-media-app_23-2150049593.jpg',
            'https://logos-world.net/wp-content/uploads/2021/03/App-Store-Logo-2020.png',
            'https://seeklogo.com/images/T/tiktok-app-icon-logo-0F5AD7AE01-seeklogo.com.png',
            'https://s3.us-east-1.amazonaws.com/cdn.designcrowd.com/blog/25-famous-app-logos-to-keep-you-amused/Snapchat.png',
            'https://img.freepik.com/free-psd/3d-icon-social-media-app_23-2150049601.jpg',
            'https://s3.us-east-1.amazonaws.com/cdn.designcrowd.com/blog/25-famous-app-logos-to-keep-you-amused/Apple%20Music%20App.png'
        ];

        $apps->each(function (App $app) use ($exampleLogos) {
            $app->addMediaFromUrl(Arr::random($exampleLogos))
                ->toMediaCollection('logo');
        });
    }
}
