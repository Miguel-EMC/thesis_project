<?php

namespace Tests\Feature\AdminTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionsTest extends TestCase
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
    /**@test views admin subscripcions*/
    public function test_views_admin_subscriptions()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->get('http://127.0.0.1:8000/api/admin/subscriptions');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
    /**@test cancel subscripcions*/
    public function test_cancel_subscriptions()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->get('http://127.0.0.1:8000/api/admin/subscriptions/16/cancel');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
    /**@test accept subscripcions*/
    public function test_accept_subscriptions()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
            ])->get('http://127.0.0.1:8000/api/admin/subscriptions/3');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
