<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
        ]);

        Listing::factory(6)->create(
            [
                'user_id' => $user->id,
            ]
        );

        // Listing::create([
        //     'title' => 'Laravel Developer',
        //     'tags' => 'laravel, JavaScript',
        //     'company' =>  'Google',
        //     'location' => 'New York',
        //     'email' => 'email@mail.com',
        //     'website' => 'www.google.com',
        //     'description' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
        // ]);
        // Listing::create([
        //     'title' => 'Full stack Engineer',
        //     'tags' => 'laravel, backend, api',
        //     'company' =>  'Stark Industries',
        //     'location' => 'New York, NY',
        //     'email' => 'email2@mail.com',
        //     'website' => 'www.starkindustries.com',
        //     'description' => 'lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
        // ]);
    }
}
