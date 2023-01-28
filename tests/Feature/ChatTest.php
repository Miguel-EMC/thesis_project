<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
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

    /**@test create chat */
    public function test_create_chat(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->post('http://127.0.0.1:8000/api/user/send', [
            "to" => 21,
            "message" => "Hola esto es una prueba unitaria de la ruta para crear un chat"
        ]);
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test view messages received */
    public function test_view_messages_received(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/user/received');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test see message on a specific user*/
    public function test_see_message_on_a_specific_user(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/user/21/messages');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }

    /**@test view contacts */
    public function test_view_contacts(){
        $response = $this->withHeaders([
            'Authorization' => 'Bearer 8|Nff2WFqOIXFxQs5hRXAUb6fDqKUoSKTUjgidO8w9',
        ])->get('http://127.0.0.1:8000/api/user/contacts');
        $response->assertStatus(200);
        $data = $response->getData();
        print_r($data);
    }
}
