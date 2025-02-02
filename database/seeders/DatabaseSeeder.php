<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PHPUnit\Framework\Constraint\Count;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::insert([
            [
                'name' => 'Uzbekistan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kazakkhstan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    

        User::create([
            'country_id' => Country::inRandomOrder()->first()->id,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'phone' => '998975427877',
            'phone_verified_at' => now(),
            'password' => 12345678
        ])->point()->create();

        User::factory(9)->create()->map(fn ($user) => $user->point()->create());
        Post::factory(500)->create();

        $this->call([
            TagSeeder::class
        ]);
    }
}
