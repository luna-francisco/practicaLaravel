<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Teacher>
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = [
            'Informática',
            'Electricidad y Electrónica',
            'Administración y Gestión',
            'Comercio y Marketing',
            'Sanidad',
            'Servicios Socioculturales y a la Comunidad',
            'Hostelería y Turismo',
            'Mantenimiento de Vehículos',
            'Instalación y Mantenimiento',
            'Fabricación Mecánica',
            'Edificación y Obra Civil',
            'Imagen Personal',
            'Agraria',
            'Industrias Alimentarias',
            'Artes Gráficas',
            'Orientación',
            'FOL (Formación y Orientación Laboral)',
        ];

        return [
            'name' => $this->faker->name(),
            'departament' => $this->faker->randomElement($departments),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'photo_path' => null,
        ];
    }
}
