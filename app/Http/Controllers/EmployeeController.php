<?php
/* Este archivo contiene el controlador que permite la creación de un documento PDF que contiene los datos de los empleados */

namespace App\Http\Controllers;

use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    public function generatePDF($id)
    {
        $employee = Employee::with(['position', 'healthcare'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.employee', compact('employee'));

        return $pdf->stream('Empleado_' . $employee->id_employee . '.pdf');
    }
}
