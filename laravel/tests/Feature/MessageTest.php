<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
{
    const CID = 1;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_message_of_a_chat_can_be_listed()
    {
        $chatid = self::CID;
        $responseStatus = $this->get("/api/chats/{$chatid}/messages");

        $responseStatus->assertStatus(200);

    }
    
    public function test_message_of_a_chat_can_be_created()
    {
        $chatid = self::CID;

        $message=[
            'author_id' => 1,
            'message' => 'mufasa',
            'chatid'=>$chatid
        ];

        $response = $this->postJson("/api/chats/{$chatid}/messages", $message);

        $response->assertStatus(200);
        
        $json = json_decode($response->getContent());
        
        return $json->id;
    }
    /**
    * @depends test_message_of_a_chat_can_be_created
    */
    public function test_message_of_a_chat_can_be_retrieved($id)
    {
        //Variables
        $chatid = self::CID;

        //Responses
        $response = $this->get("/api/chats/{$chatid}/messages/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_message_of_a_chat_can_be_created
    */
    public function test_message_of_a_chat_can_be_updated($id)
    {
        //Variables
        $chatid = self::CID;

        //Mock data ticket

        $message = [
            'message' => 'amor'
        ];

        //Responses
        $response = $this->put("/api/chats/{$chatid}/messages/{$id}", $message);

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_message_of_a_chat_can_be_created
    */
    public function test_message_of_a_chat_can_be_deleted($id)
    {
        //Variables
        $chatid = self::CID;

        //Responses
        $response = $this->delete("/api/chats/{$chatid}/messages/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
