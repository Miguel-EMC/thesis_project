<?php

namespace Tests\Feature\AdminTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResportsTest extends TestCase
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
     /**@test view reports */
     public function test_view_reports()
    {
        $response = $this->withHeaders([
             'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
        ])->get('http://127.0.0.1:8000/api/admin/reports');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test update state */
    public function test_update_state_reports()
    {
        $response = $this->withHeaders([
             'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
        ])->get('http://127.0.0.1:8000/api/admin/reports/7',[
            "state" => false
        ]
    );
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test delete report */
    public function test_delete_reports()
    {
        $response = $this->withHeaders([
             'Authorization' => 'Bearer 11|5gaJX0T4ijo5LelKLk3SDBstjN5L6to4L6GGO36T',
        ])->delete('http://127.0.0.1:8000/api/admin/reports/7');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }


}
