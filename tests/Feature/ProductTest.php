<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Type\Integer;
use Tests\TestCase;

class ProductTest extends TestCase
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

    /** @test views products */
    public function test_views_products()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/products');

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
    /** @test view product */
    public function test_view_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
            ])->get("http://127.0.0.1:8000/api/products/1");

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /** @test create product */
    public function test_create_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/products', [
                'title' => 'Test Product',
                'price' => 100,
                'description' => 'Test Product Description',
                'detail' => 'Test Product Detail',
                'stock' => 10,
                'state_appliance' => 'Nuevo',
                'delivery_method' => 'Envio gratis',
                'brand' => 'Test Brand',
                'categorie_id' => 5,
                'image' => $this->getUploadedFile(),
                'address' => 'Quito-Ecuador',
                'phone' => '2787675'
            ]);
        $response->assertStatus(201);
        $data = $response->getData();
        print_r($data);
    }
    private function getUploadedFile()
    {
        return new UploadedFile(
            'D:\Users\Miguel\Pictures\deaa2843c2768397d9d0830fed8d7987.jpg',
            'deaa2843c2768397d9d0830fed8d7987.jpg',
            'image/jpeg',
            null,
            true
        );
    }

    /**@test update product */
    public function test_update_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/products/103/update', [
                'title' => 'Test Update Product',
                'price' => 100,
                'description' => 'Test Product Description',
                'detail' => 'Test Product Detail',
                'stock' => 10,
                'state_appliance' => 'Nuevo',
                'delivery_method' => 'Envio gratis',
                'brand' => 'Test Brand',
                'categorie_id' => 5,
                'image' => $this->getUploadedFile(),
                'address' => 'Quito-Ecuador',
                'phone' => '2787675'
            ]);
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test delete product */
    public function test_delete_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
            ])->delete("http://127.0.0.1:8000/api/products/103");

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test search product */
    public function test_search_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
            ])->get("http://127.0.0.1:8000/api/search?title=sistema");

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test filter product */
    public function test_filter_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
            ])->get("http://127.0.0.1:8000/api/filter/products?state_appliance=nuevo&categorie_id=1");

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
