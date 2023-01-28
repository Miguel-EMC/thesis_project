<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Product;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{

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
}
