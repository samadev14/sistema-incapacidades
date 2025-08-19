<?php
/* Este archivo contiene el controlador que permite la creación de un documento PDF que contiene los registros de incapacidades de los empleados */

namespace App\Http\Controllers;

use App\Models\Incapacity;
use Barryvdh\DomPDF\Facade\Pdf;

class IncapacityController extends Controller
{
    public function generatePDF(Incapacity $incapacity)
    {
        $pdf = Pdf::loadView('pdf.report_incapacity', compact('incapacity'));

        return $pdf->stream('reporte_incapacidad_' . $incapacity->id . '.pdf');
    }
}
