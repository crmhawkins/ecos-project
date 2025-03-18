<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            alert_status::class,
            budget_status::class,
            budget_concept_type::class,
            holiday_status::class,
            incidencesStatusSeeder::class,
            invoice_status::class,
            payments_method::class,
            stages::class,
            task_status::class,
            user_access_level::class,
            user_department::class,
            user_position::class,
        ]);
    }
}
