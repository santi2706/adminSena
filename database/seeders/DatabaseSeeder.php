<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\areas;
use App\Models\course;
use App\Models\Apprentice;
use App\Models\Computer;
use App\Models\CourseTeacher;
use App\Models\Teacher;
use App\Models\TrainingCenter;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // firstOrCreate: si el registro ya existe NO lo crea otra vez,
        // así se puede ejecutar `php artisan db:seed` las veces que sea.
        $area1 = areas::firstOrCreate(['name' => 'Desarrollo de Software']);
        $area2 = areas::firstOrCreate(['name' => 'Infraestructura Tecnologica']);
        $area3 = areas::firstOrCreate(['name' => 'Analitica de Datos']);

        $tc1 = TrainingCenter::firstOrCreate(
            ['name' => 'Centro de Formacion SENA'],
            ['location' => 'Bogota']
        );
        $tc2 = TrainingCenter::firstOrCreate(
            ['name' => 'Centro de Formacion Virtual'],
            ['location' => 'Medellin']
        );

        $c1 = Computer::firstOrCreate(['number' => 'LAB-PC-101'], ['brand' => 'Lenovo']);
        $c2 = Computer::firstOrCreate(['number' => 'LAB-PC-102'], ['brand' => 'HP']);

        $course1 = course::firstOrCreate(
            ['course_number' => 'API REST con Laravel'],
            ['day' => 'Lunes a Viernes', 'area_id' => $area1->id, 'training_center_id' => $tc1->id]
        );
        $course2 = course::firstOrCreate(
            ['course_number' => 'Redes y Servidores'],
            ['day' => 'Sabados', 'area_id' => $area2->id, 'training_center_id' => $tc1->id]
        );

        $teacher1 = Teacher::firstOrCreate(
            ['email' => 'profesor1@sena.edu.co'],
            ['name' => 'Profesor Uno', 'area_id' => $area1->id, 'training_center_id' => $tc1->id]
        );
        $teacher2 = Teacher::firstOrCreate(
            ['email' => 'profesor2@sena.edu.co'],
            ['name' => 'Profesor Dos', 'area_id' => $area2->id, 'training_center_id' => $tc1->id]
        );

        Apprentice::firstOrCreate(
            ['email' => 'aprendiz1@sena.edu.co'],
            ['name' => 'Aprendiz Uno', 'cell_number' => '3001112222', 'course_id' => $course1->id, 'computer_id' => $c1->id]
        );
        Apprentice::firstOrCreate(
            ['email' => 'aprendiz2@sena.edu.co'],
            ['name' => 'Aprendiz Dos', 'cell_number' => '3003334444', 'course_id' => $course2->id, 'computer_id' => $c2->id]
        );

        CourseTeacher::firstOrCreate(['course_id' => $course1->id, 'teacher_id' => $teacher1->id]);
        CourseTeacher::firstOrCreate(['course_id' => $course2->id, 'teacher_id' => $teacher2->id]);
    }
}
