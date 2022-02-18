<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
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
            'author_id' => 1,
            'message' => 'hola que tal',
            'created_at' => '2/2/22',
            'updated_at' => '5/2/22',
            'publicgroup_id' => 5,
            'privateuser_id' => 0,
        ];

        //Responses
        $response = $this->postJson('/api/messages', $message);

        //Assertions
        $response->assertStatus(201);

        $json = json_decode($response->getContent());

        return $json->id;
    }
    /**
     * @depends test_messages_can_be_created
     */
    public function test_messages_can_be_retrieved($id)
    {
        //Responses
        $response = $this->get("/api/messages/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
     * @depends test_messages_can_be_created
     */
    public function test_messages_can_be_updated($id)
    {
        //Mock data ticket

        $message = [
            'message' => 'esto es un hola dos',
        ];

        //Responses
        $response = $this->put("/api/messages/{$id}", $message);

        //Assertions
        $response->assertStatus(200);

    }
    /**
     * @depends test_messages_can_be_created
     */
    public function test_messages_can_be_deleted($id)
    {

        //Responses            'id' => 'required',

        $response = $this->delete("/api/messages/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
