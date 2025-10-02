<?php

namespace Database\Seeders;

use App\Models\Users\UserAccessLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateUserAccessLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newAccessLevels = [
            ['id' => 7, 'name' => 'Marketing'],
            ['id' => 8, 'name' => 'Soporte'],
            ['id' => 9, 'name' => 'Recursos Humanos'],
            ['id' => 10, 'name' => 'Solo Lectura'],
        ];

        foreach ($newAccessLevels as $level) {
            UserAccessLevel::updateOrCreate(
                ['id' => $level['id']], 
                ['name' => $level['name']]
            );
        }
    }
}