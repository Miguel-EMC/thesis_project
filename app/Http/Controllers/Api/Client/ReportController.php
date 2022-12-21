<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Product;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    //Function to get all reports 
    //Se recibe como parametro el id del producto
    //Se verifica si el usuario tiene permiso para ver los reportes 
    public function index(Product $product)
    {
        $this->authorize('view', Report::class);

        return $this->sendResponse(
        message: "Reports returned successfully",
        result: [
                'reports' => ReportResource::collection($product->reports->sortByDesc('created_at'))
            ]
        );

    }

    // Funcion para mostrar un reporte de un producto en especifico
    // Se recibe como parametro el id del producto y el id del reporte 
    public function show(Product $product, Report $report)
    {
        $this->authorize('viewAny', Report::class);

        $report = $product->reports()->where('id', $report->id)->firstOrFail();
        return $this->sendResponse(
        message: "Report returned successfully",
        result: [
                'report' => new ReportResource($report)
            ]
        );
    }

    //Funcion para crear un reporte
    // Se recibe como parametro el id del producto y los datos del reporte
    public function store(Request $request, Product $product)
    {
        $this->authorize('create', Report::class);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $report = $product->reports()->save(new Report($request->all()));
        return $this->sendResponse(
        message: "Report created successfully",
        result: [
                'report' => new ReportResource($report)
            ]
        );
    }

    // public function update(Request $request, $id)
    // {
    //     //
    // }

    //Funcion para eliminar un reporte
    // Se recibe como parametro el id del producto y el id del reporte
    public function destroy(Product $product, Report $report)
    {
        $this->authorize('delete', $report);
        $report = $product->reports()->where('id', $report->id)->firstOrFail();
        $report->delete();
        return $this->sendResponse(
        message: "Report deleted successfully",
        result: []
        );
    }
}