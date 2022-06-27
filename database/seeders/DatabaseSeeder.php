<?php

namespace Database\Seeders;

use Domain\Blogging\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    
    public function run(): void {
    //    if(app()->environment('local')){
    //     $this->call(
    //         class:DefaultUserSeeder::class
    //     );
    //    }

    Post::factory(20)->for(
         User::factory()->create([
            'first_name' => 'Sammy',
            'last_name' => 'Kisina',
            'email' => 'sammy.k.mutua@gmail.com'
            ])
        )->create();
    }
}
