<?php
/* Archivo que contiene la regla UniqueFullNameEmployee, la cual valida que un empleado no tenga duplicado de nombres y apellidos. */

namespace App\Rules;

use App\Models\Employee;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueFullNameEmployee implements ValidationRule
{
    protected ?int $ignoreId;

    // Constructor para recibir el ID del registro actual (si es una edición)
    public function __construct(?int $ignoreId = null)
    {
        $this->ignoreId = $ignoreId;
    }

    // Método para ejecutar la validación
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $lastName = request()->input('last_name_employee');  // Obtén el valor de last_name_employee

        // Realiza la consulta para verificar si existe un empleado con la misma combinación de nombre y apellido
        $exists = Employee::where('name_employee', $value)
            ->where('last_name_employee', $lastName)
            ->when($this->ignoreId, fn($query) => $query->where('id', '!=', $this->ignoreId))  // Ignora el ID si es una edición
            ->exists();  // Si existe, retorna false (fallo la validación)

        if ($exists) {
            $fail('Ya existe un empleado con ese nombre y apellido.');
        }
    }
}
