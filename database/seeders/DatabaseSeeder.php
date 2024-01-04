<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AccumulatePoint;
use App\Models\CancellationPolicy;
use App\Models\Department;
use App\Models\PenaltyPolicy;
use App\Models\Role;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AccumulatePoint::factory(20)->create();
        CancellationPolicy::factory(5)->create();
        Department::factory(6)->create();
        PenaltyPolicy::factory(5)->create();
        Role::factory(6)->create();
        Service::factory(10)->create();
    }
}
