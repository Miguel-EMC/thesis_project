<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
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

    /**view @test comments on a specific product*/
    public function test_view_comments_on_a_specific_product()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/products/1/comments');

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**view @test comment on a specific product*/
    public function test_view_comment_on_a_specific_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/products/1/comments/6');

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test create comment on a specfic product */
    public function test_create_comment_on_a_specific_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/products/70/comments', [
            'comment' => 'This is a test comment',
        ]);

        $response->assertStatus(201);
        $data = $response->getData();
        print_r($data);
    }

    /**@test update comment on a specfic product */
    public function test_update_comment_on_a_specific_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->put('http://127.0.0.1:8000/api/products/70/comments/9', [
            'comment' => 'This is a test comment updated',
        ]);

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test delete comment on a specfic product */
    public function test_delete_comment_on_a_specific_product(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->delete('http://127.0.0.1:8000/api/products/70/comments/9');

        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
