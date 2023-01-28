<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
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

    /**@test subscription requested*/
    public function test_subscription_requested(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/subscriptions', [
            "product_id" => 11
        ]);
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test view subscription */
    public function test_view_subscription(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/subscriptions');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
