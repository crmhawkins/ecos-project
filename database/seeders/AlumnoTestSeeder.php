<?php

namespace Database\Seeders;

use App\Models\Alumnos\Alumno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AlumnoTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un alumno de prueba
        Alumno::create([
            'username' => 'alumno_test',
            'name' => 'Juan',
            'surname' => 'Pérez García',
            'email' => 'alumno@test.com',
            'password' => Hash::make('123456'),
            'phone' => '+34 666 777 888',
        ]);

        // Crear algunos alumnos adicionales
        $alumnos = [
            [
                'username' => 'maria_lopez',
                'name' => 'María',
                'surname' => 'López Martín',
                'email' => 'maria.lopez@test.com',
                'password' => Hash::make('123456'),
                'phone' => '+34 666 111 222',
            ],
            [
                'username' => 'carlos_ruiz',
                'name' => 'Carlos',
                'surname' => 'Ruiz Fernández',
                'email' => 'carlos.ruiz@test.com',
                'password' => Hash::make('123456'),
                'phone' => '+34 666 333 444',
            ],
            [
                'username' => 'ana_garcia',
                'name' => 'Ana',
                'surname' => 'García Sánchez',
                'email' => 'ana.garcia@test.com',
                'password' => Hash::make('123456'),
                'phone' => '+34 666 555 666',
            ]
        ];

        foreach ($alumnos as $alumnoData) {
            Alumno::create($alumnoData);
        }

        $this->command->info('✅ Alumnos de prueba creados exitosamente:');
        $this->command->info('   - Usuario: alumno_test | Email: alumno@test.com | Password: 123456');
        $this->command->info('   - Usuario: maria_lopez | Email: maria.lopez@test.com | Password: 123456');
        $this->command->info('   - Usuario: carlos_ruiz | Email: carlos.ruiz@test.com | Password: 123456');
        $this->command->info('   - Usuario: ana_garcia | Email: ana.garcia@test.com | Password: 123456');
    }
}