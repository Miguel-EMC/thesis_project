<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-customer');
    }

    //Funcion para mostrar todos los clientes registrados en la base de datos
    public function index()
    {
        $customers = User::where('role_id', 2)->get();
        return $this->sendResponse(
            message: "Customers returned successfully",
            result: [
                'customers' => $customers,
            ]
        );
    }

    //Funcion para mostrar un cliente en especifico
    public function show($customer)
    {
        $customer = User::find($customer);
        return  $this->sendResponse(
            message: "Customer returned successfully",
            result: [
                'customer' => $customer,
            ]
        );
    }
    public function store(Request $request)
    {

    }
    public function update(Request $request, $id)
    {

    }

    //Funcion para eliminar un cliente
    public function destroy(User $customer)
    {
        //Se elimina el cliente de la base de datos
        $customer->delete();
        //Se invoca a la funcion padre
        return $this->sendResponse(
            message: "Customer deleted successfully",
            result:  []
        );
    }
}
