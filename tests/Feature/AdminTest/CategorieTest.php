<?php

namespace Tests\Feature\AdminTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategorieTest extends TestCase
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
        /**@test view categories */
        public function test_view_categories()
        {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->get('http://127.0.0.1:8000/api/admin/categories');
            $response->assertStatus(200);
            $data = $response->getData();
            print_r($data);
        }

        /**@test view categorie in specific*/
        public function test_view_categorie_in_specific(){
            $response = $this->withHeaders([
                'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->get('http://127.0.0.1:8000/api/admin/categories/4');
            $response->assertStatus(200);
            $data = $response->getData();
            print_r($data);
        }
        /**@test create categorie */
        public function test_create_categorie()
        {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->post('http://127.0.0.1:8000/api/admin/categories',[
                "name" => "test categorie",
                "imagen" => "https://m.media-amazon.com/images/I/81DIBUvqDtL._SR1260,840_SR630,420_.jpg"
            ]);
            $response->assertStatus(201);
        }
        /**@test update categorie */
        public function test_update_categorie()
        {
            $response = $this->withHeaders([
                'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->put('http://127.0.0.1:8000/api/admin/categories/5',[
                "name" => "test categorie",
                "imagen" => "https://m.media-amazon.com/images/I/81DIBUvqDtL._SR1260,840_SR630,420_.jpg"
            ]);
            $response->assertStatus(200);
            $data = $response->getData();
            print_r($data);
        }

}
