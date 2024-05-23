<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('role_id', RoleType::Owner->value)->each(function ($user) {
            Profile::factory()->owner()->create(['user_id' => $user->id]);
        });

        User::where('role_id', RoleType::Customer->value)->each(function ($user) {
            Profile::factory()->create(['user_id' => $user->id]);
        });
    }
}
