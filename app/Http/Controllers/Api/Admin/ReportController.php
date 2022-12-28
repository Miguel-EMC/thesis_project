<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-report');
    }

    // Funcion para mostrar todos los reportes registrados en la base de datos
    public function index()
    {
        $reports = Report::all();
        return $this->sendResponse(
            message: "Reports returned successfully",
            code: 200,
            result: [
                'reports' => $reports,
            ]
        );
    }
    public function show(Report $report)
    {
        return $this->sendResponse(
            message: "Report returned successfully",
            code: 200,
            result: [
                'report' => $report,
            ]
        );
    }

    //Funcion para actualizar el state de un reporte
    public function update(Request $request, Report $report)
    {
        $report = Report::find($report->id);
        if (!$report) {
            return $this->sendResponse(
                message: "Report not found",
                code: 404,
                result: []
            );
        }
        $report->state = $request->state;
        $report->save();
        return $this->sendResponse(
            message: "Report updated successfully",
            code: 200,
            result: [
                'report' => $report,
            ]
        );
    }

    //Funcion para eliminar un reporte
    public function destroy(Report $report)
    {
        $report = Report::find($report->id);
        if (!$report) {
            return $this->sendResponse(
                message: "Report not found",
                code: 404,
                result: []
            );
        }
        $report->delete();
        return $this->sendResponse(
            message: "Report deleted successfully",
            code: 200,
            result: []
        );
    }
}
