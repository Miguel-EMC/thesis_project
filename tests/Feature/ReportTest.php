<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**@test create report on a product specific*/
    public function test_create_report_on_a_specific_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/products/56/reports', [
            "title" => "Titulo Reporte al producto 4",
            "description" =>"Esto es la description"
        ]);
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
