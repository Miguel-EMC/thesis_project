<?php

namespace Tests\Feature\AdminTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
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
    /**@test views admin products */
    public function test_views_admin_products()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->get('http://127.0.0.1:8000/api/admin/products');

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test delete admin products */
    public function test_delete_admin_product()
    {
         $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
        ])->delete('http://127.0.0.1:8000/api/admin/products/26');

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
