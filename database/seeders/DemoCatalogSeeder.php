<?php

namespace Database\Seeders;

use App\Models\Apprentice;
use App\Models\areas;
use App\Models\Computer;
use App\Models\course;
use App\Models\Teacher;
use App\Models\TrainingCenter;
use Illuminate\Database\Seeder;

class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            'software' => areas::firstOrCreate(['name' => 'Desarrollo de Software']),
            'networks' => areas::firstOrCreate(['name' => 'Infraestructura Tecnologica']),
            'data' => areas::firstOrCreate(['name' => 'Analitica de Datos']),
        ];

        $centers = [
            'cali' => TrainingCenter::firstOrCreate(
                ['name' => 'Centro de Formacion Digital'],
                ['location' => 'Cali']
            ),
            'bogota' => TrainingCenter::firstOrCreate(
                ['name' => 'Centro Tecnologico Regional'],
                ['location' => 'Bogota']
            ),
        ];

        $computers = [
            'software' => Computer::firstOrCreate(['number' => 'LAB-PC-101'], ['brand' => 'Acer']),
            'networks' => Computer::firstOrCreate(['number' => 'LAB-PC-102'], ['brand' => 'Lenovo']),
            'data' => Computer::firstOrCreate(['number' => 'LAB-PC-201'], ['brand' => 'HP']),
        ];

        $teachers = [
            'software' => Teacher::firstOrCreate(
                ['email' => 'camila.rojas.seed@example.test'],
                ['name' => 'Camila Rojas', 'area_id' => $areas['software']->id, 'training_center_id' => $centers['cali']->id]
            ),
            'networks' => Teacher::firstOrCreate(
                ['email' => 'julian.pardo.seed@example.test'],
                ['name' => 'Julian Pardo', 'area_id' => $areas['networks']->id, 'training_center_id' => $centers['bogota']->id]
            ),
            'data' => Teacher::firstOrCreate(
                ['email' => 'valeria.mora.seed@example.test'],
                ['name' => 'Valeria Mora', 'area_id' => $areas['data']->id, 'training_center_id' => $centers['cali']->id]
            ),
        ];

        $courses = [
            'software' => course::firstOrCreate([
                'course_number' => 'API REST con Laravel',
                'day' => 'Lunes',
                'area_id' => $areas['software']->id,
                'training_center_id' => $centers['cali']->id,
            ]),
            'networks' => course::firstOrCreate([
                'course_number' => 'Redes para Servicios Web',
                'day' => 'Martes',
                'area_id' => $areas['networks']->id,
                'training_center_id' => $centers['bogota']->id,
            ]),
            'data' => course::firstOrCreate([
                'course_number' => 'Introduccion a Bases de Datos',
                'day' => 'Miercoles',
                'area_id' => $areas['data']->id,
                'training_center_id' => $centers['cali']->id,
            ]),
        ];

        foreach ($courses as $key => $course) {
            $course->teachers()->syncWithoutDetaching([$teachers[$key]->id]);
        }

        $apprentices = [
            ['name' => 'Andres Munoz', 'email' => 'andres.munoz.seed@example.test', 'cell_number' => '3000000101', 'course_id' => $courses['software']->id, 'computer_id' => $computers['software']->id],
            ['name' => 'Laura Gil', 'email' => 'laura.gil.seed@example.test', 'cell_number' => '3000000102', 'course_id' => $courses['networks']->id, 'computer_id' => $computers['networks']->id],
            ['name' => 'Mateo Rios', 'email' => 'mateo.rios.seed@example.test', 'cell_number' => '3000000103', 'course_id' => $courses['data']->id, 'computer_id' => $computers['data']->id],
        ];

        foreach ($apprentices as $attributes) {
            Apprentice::firstOrCreate(['email' => $attributes['email']], $attributes);
        }
    }
}