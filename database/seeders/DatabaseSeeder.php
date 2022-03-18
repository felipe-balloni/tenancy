<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create();
        User::factory(9)->create(['tenant_id' => 1]);
        User::factory(10)->create();

        Department::factory(10)->create(['tenant_id' => 1]);
    }
}
