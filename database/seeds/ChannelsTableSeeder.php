<?php

use LaravelForum\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'name' => "laravel 5.8",
            'slug' => str_slug('laravel 5.8')
        ]);

        Channel::create([
            'name' => "Vue js 3",
            'slug' => str_slug('Vue js 3')
        ]);

        Channel::create([
            'name' => "Angular 6",
            'slug' => str_slug('Angular 6')
        ]);

        Channel::create([
            'name' => "React native",
            'slug' => str_slug('React native')
        ]);
    }
}
