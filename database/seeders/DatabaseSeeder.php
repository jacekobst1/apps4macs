<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $apps = App::factory(30)->for(User::factory())->create();

        $apps->each(function (App $app) {
            $app->addMediaFromUrl('https://img.freepik.com/darmowe-wektory/logo-instagrama_1199-122.jpg')
                ->toMediaCollection('logo');
        });
    }
}
