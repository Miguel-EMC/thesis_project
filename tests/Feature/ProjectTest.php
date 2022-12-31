<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
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

    //Metodo para probar la ruta de inicio de sesion

    /** @test login */
    public function test_login()
    {
        $response = $this->post('http://127.0.0.1:8000/api/loginCust', [
            'email' => 'test_1@example.com',
            'password' => 'Test.123456'
        ]);

        $user = User::where('email', 'test_1@example.com')->first();

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Successfully authenticated',
            'data'=>[
                'access_token' => $response->json('data.access_token'),
                'token_type',
            ]
        ]);
    }

    /** @test register */
    public function test_register()
    {
        $response = $this->post('http://127.0.0.1:8000/api/register', [
            'username' => 'Test 1_1',
            'first_name' => 'Test 1',
            'last_name' => 'Test 1',
            'email' => 'test_1@example.com',
            'home_phone' => '1234567',
            'personal_phone' => '1234567890',
            'address' => 'Test 1',
            'password' => 'Test.123456',
            'password_confirmation' => 'Test.123456',
        ]);
        $response->assertStatus(201);
    }

}
