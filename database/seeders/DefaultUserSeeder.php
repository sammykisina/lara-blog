<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DefaultUserSeeder extends Seeder {
    
    public function run(): void {
        User::factory()->create([
            'first_name' => 'Sammy',
            'last_name' => 'Kisina',
            'email' => 'sammy.k.mutua@gmail.com'
        ]);
    }
}
