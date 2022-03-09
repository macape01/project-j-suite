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
    public function test_chat_can_be_listed()
    {
        $responseStatus = $this->get("/api/chats");

        $responseStatus->assertStatus(200);

    }
    
    public function test_chat_can_be_created()
    {

        $chat=[
            'name' => 'Chat Oliver',
            'author_id' => 1,
        ];

        $response = $this->postJson("/api/chats", $chat);

        $response->assertStatus(200);
        
        $json = json_decode($response->getContent());
        
        return $json->id;
    }
    /**
    * @depends test_chat_can_be_created
    */
    public function test_chat_can_be_retrieved($id)
    {
        //Variables

        //Responses
        $response = $this->get("/api/chats/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_chat_can_be_created
    */
    public function test_chat_can_be_updated($id)
    {

        //Mock data ticket

        $chat = [
            'name' => 'mayonesa'
        ];

        //Responses
        $response = $this->put("/api/chats/{$id}", $chat);

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_chat_can_be_created
    */
    public function test_chat_can_be_deleted($id)
    {

        //Responses
        $response = $this->delete("/api/chats/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
