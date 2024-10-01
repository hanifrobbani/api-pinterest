<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // $password = Hash::make('budi');

        // User::factory()->create([
        //     'username' => 'budi',
        //     'email' => 'budi@email.com',
        //     'password' => $password
        // ]);
        Comment::create([
            'post_id' => '12',
            'user_id' => '1',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim placeat similique.',
        ]);
    }
}
