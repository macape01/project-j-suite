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
            'author_id' => 6,
            'message' => 'mufasa',
            'publicgroup_id' => 5,
            'privateuser_id' => 0,
            'chatid'=>$chatid
        ];

        $response = $this->postJson("/api/chats/{$chatid}/messages", $message);

        $responseStatus->assertStatus(200);
        
        $json = json_decode($response->getContent());
        
        return [
            'chatid' => $chatid, 
            'id'  => $json->id
        ];
    }
    /**
    * @depends test_message_of_a_chat_can_be_created
    */
    public function test_message_of_a_chat_can_be_retrieved($params)
    {
        //Variables
        $chatid = $params[0];
        $id = $params[1];

        //Responses
        $response = $this->get("/api/chats/{$chatid}/messages/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_message_of_a_chat_can_be_created
    */
    public function test_message_of_a_chat_can_be_updated($params)
    {
        //Variables
        $chatid = $params[0];
        $id = $params[1];

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
    public function test_message_of_a_chat_can_be_deleted($params)
    {
        //Variables
        $chatid = $params[0];
        $id = $params[1];

        //Responses
        $response = $this->delete("/api/chats/{$chatid}/messages/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
