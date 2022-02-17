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
    public function test_messages_can_be_listed()
    {
        //Responses
        $responseStatus = $this->get('/api/messages');

        $response = $this->getJson('/api/messages');
        
        //Assertions
        $responseStatus->assertStatus(200);
        /* $response->assertJson(fn (AssertableJson $json) =>
        $json->hasAll('id', 'description', 'title', 'assigned_id', 'asset_id')
        ); */
    }
    public function test_messages_can_be_created()
    {
        //Mock data ticket

        $message = [
            'id' => 1,
            'author_id' => 3,
            'message' => 'hola que tal',
            'created' => '2/2/22',
            'publicgroup_id' => 5,
            'privateuser_id' => null,
        ];

        //Responses
        $response = $this->postJson('/api/messages', $message);

        //Assertions
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
    public function test_messages_can_be_retrieved()
    {
        //Responses
        $response = $this->get('/api/messages/1');

        //Assertions
        $response->assertStatus(200);

    }
    public function test_messages_can_be_updated()
    {
        //Mock data ticket

        $message = [
            'message' => 'esto es un hola dos',
        ];

        //Responses
        $response = $this->put('/api/messages/1', $message);

        //Assertions
        $response->assertStatus(200);

    }
    public function test_messages_can_be_deleted()
    {

        //Responses
        $response = $this->delete('/api/messages/1');

        //Assertions
        $response->assertStatus(200);

    }
}
