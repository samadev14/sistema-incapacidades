<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Healthcare;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test N°1 */
    public function it_creates_an_employee()
    {
        $position = Position::factory()->create();
        $healthcare = Healthcare::factory()->create();

        $employee = Employee::create([
            'name_employee' => 'Carlos',
            'last_name_employee' => 'Ramírez',
            'id_employee' => '1234567890',
            'email_employee' => 'CARLOS@EMPRESA.COM', // Se guardará en minúsculas
            'position_id' => $position->id,
            'healthcare_id' => $healthcare->id,
        ]);

        $this->assertDatabaseHas('employees', [
            'name_employee' => 'Carlos',
            'last_name_employee' => 'Ramírez',
            'id_employee' => '1234567890',
            'email_employee' => 'carlos@empresa.com', // Verifica minúsculas por el mutator
        ]);
    }

    /** @test N°2 */
    public function it_validates_duplicate_id_and_email()
    {
        $position = Position::factory()->create();
        $healthcare = Healthcare::factory()->create();

        // Se crea el primer empleado
        Employee::create([
            'name_employee' => 'Ana',
            'last_name_employee' => 'López',
            'id_employee' => '9998887776',
            'email_employee' => 'ana@empresa.com',
            'position_id' => $position->id,
            'healthcare_id' => $healthcare->id,
        ]);

        // Se espera una excepción al crear un empleado con datos duplicados
        $this->expectException(\Illuminate\Database\QueryException::class);

        Employee::create([
            'name_employee' => 'Ana 2',
            'last_name_employee' => 'López 2',
            'id_employee' => '9998887776', // ID duplicado
            'email_employee' => 'ana@empresa.com', // Correo electrónico duplicado
            'position_id' => $position->id,
            'healthcare_id' => $healthcare->id,
        ]);
    }
}
