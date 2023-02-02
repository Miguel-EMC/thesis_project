<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** @test login */
    public function test_login()
    {
        $response = $this->post('http://127.0.0.1:8000/api/login', [
            'email' => 'zcarrasco@example.com',
            'password' => 'secreto'
        ]);
        $response->assertStatus(200);
    }
    /** @test register */
    public function test_register()
    {
        $response = $this->post('http://127.0.0.1:8000/api/register', [
            'username' => 'camilaRionoso_1',
            'first_name' => 'Test ',
            'last_name' => 'Test 1',
            'email' => 'camilaReinoso.12@example.com',
            'home_phone' => '1234567',
            'personal_phone' => '1234567890',
            'address' => 'Test 1',
            'password' => 'Test.123456',
            'password_confirmation' => 'Test.123456',
        ]);
        $response->assertStatus(201);
    }

    /** @test view my profile */
    public function test_profile()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/profile');
        $response->assertStatus(200);
    }

    /** @test update my profile */
    public function test_update_profile()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/profile', [
                "username" => "MiguelMuzo Test",
                "first_name" => "Test 1",
                "last_name" => "Cliente",
                "email" => "example_01@gmail.com",
                "home_phone" => "029570994",
                "personal_phone" => "0919756468",
                "address" => "Guayaquil"
            ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'Profile updated successfully',
        ]);
    }

    /** @test update avatar */
    public function test_update_avatar()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/profile/avatar', [
                'image' => $this->getUploadedFile()
            ]);
        $response->assertStatus(200)->assertSee('Avatar updated successfully');
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

    /**@test subscription requested*/
    public function test_subscription_requested()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/subscriptions', [
                "product_id" => 30
            ]);
        $response->assertStatus(201);
    }

    /**@test view subscription */
    public function test_view_subscription()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/subscriptions');
        $response->assertStatus(200);
    }
    /**@test create report on a product specific*/
    public function test_create_report_on_a_specific_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/products/56/reports', [
                "title" => "Titulo Reporte al producto 4",
                "description" => "Esto es la description"
            ]);
        $response->assertStatus(200);
    }

    /** @test views products */
    public function test_views_products()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/products');

        $response->assertStatus(200);
    }
    /** @test view product */
    public function test_view_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get("http://127.0.0.1:8000/api/products/1");

        $response->assertStatus(200);
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
    }
    /**@test update product */
    public function test_update_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/products/71/update', [
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
    }

    /**@test delete product */
    public function test_delete_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->delete("http://127.0.0.1:8000/api/products/91");

        $response->assertStatus(200);
    }

    /**@test search product */
    public function test_search_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get("http://127.0.0.1:8000/api/search?title=sistema");

        $response->assertStatus(200);
    }

    /**@test filter product */
    public function test_filter_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get("http://127.0.0.1:8000/api/filter/products?state_appliance=nuevo&categorie_id=1");

        $response->assertStatus(200);
    }
    /**view @test comments on a specific product*/
    public function test_view_comments_on_a_specific_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/products/1/comments');
        $response->assertStatus(200);
    }
    /**@test create comment on a specfic product */
    public function test_create_comment_on_a_specific_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/products/70/comments', [
                'comment' => 'This is a test comment',
            ]);
        $response->assertStatus(201);
    }
    /**@test update comment on a specfic product */
    public function test_update_comment_on_a_specific_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->put('http://127.0.0.1:8000/api/products/70/comments/219', [
                'comment' => 'This is a test comment updated',
            ]);
        $response->assertStatus(200);
    }
    /**@test delete comment on a specfic product */
    public function test_delete_comment_on_a_specific_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->delete('http://127.0.0.1:8000/api/products/70/comments/224');
        $response->assertStatus(200);
    }
    /**@test create chat */
    public function test_create_chat()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/user/send', [
                "to" => 21,
                "message" => "Hola esto es una prueba unitaria de la ruta para crear un chat"
            ]);
        $response->assertStatus(200);
    }
    /**@test view messages received */
    public function test_view_messages_received()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/user/received');
        $response->assertStatus(200);
    }

    /**@test see message on a specific user*/
    public function test_see_message_on_a_specific_user()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/user/21/messages');
        $response->assertStatus(200);
    }
    /**@test view contacts */
    public function test_view_contacts()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/user/contacts');
        $response->assertStatus(200);
    }
}
