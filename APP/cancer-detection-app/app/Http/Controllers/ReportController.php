<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Patient;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        // dd($request);
        $patient = Patient::find($request->id);
        $result  = json_decode($request->result, true); // decode JSON string back to array
        $type    = $patient->disease_type;
        $imagePath = $request->imagePath;

        $pdf = Pdf::loadView('cancer_detection', compact('patient', 'result', 'type', 'imagePath'));
        // dd($patient);
        return $pdf->download('cancer_report_' . $patient->name . '.pdf');
    }
}
