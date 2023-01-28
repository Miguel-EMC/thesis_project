<?php

namespace Tests\Feature\AdminTest;

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

    /**@test view users */
    public function test_view_users()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
        ])->get('http://127.0.0.1:8000/api/admin/customers');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test view user in specific*/
    public function test_view_user_in_specific(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
        ])->get('http://127.0.0.1:8000/api/admin/customers/6');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test delete user */
    public function test_delete_user(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
        ])->delete('http://127.0.0.1:8000/api/admin/customers/6');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
