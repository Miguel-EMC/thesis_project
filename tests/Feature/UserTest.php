<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
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
    /** @test login */
    public function test_login()
    {
        $response = $this->post('http://127.0.0.1:8000/api/login', [
            'email' => 'test_1@example.com',
            'password' => 'Test.123456'
        ]);

        $user = User::where('email', 'test_1@example.com')->first();

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Successfully authenticated',
            'data' => [
                'access_token' => $response->json('data.access_token'),
                'token_type',
            ]
        ]);
    }

    /** @test register */
    public function test_register()
    {
        $response = $this->post('http://127.0.0.1:8000/api/register', [
            'first_name' => 'Test 1',
            'last_name' => 'Test 1',
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
        $data = $response->getData();
        print_r($data);
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
        $data = $response->getData();
        print_r($data);
        return $response->assertJsonFragment([
            'message' => 'Avatar updated successfully',
        ]);

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
}
