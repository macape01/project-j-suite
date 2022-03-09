<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatTest extends TestCase
{
    const CID = 1;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_chat_can_be_listed()
    {
        $chatid = self::CID;
        $responseStatus = $this->get("/api/chats/{$chatid}");

        $responseStatus->assertStatus(200);

    }
    
    public function test_chat_can_be_created()
    {
        $chatid = self::CID;

        $chat=[
            'id'=>$chatid,
            'name' => 'Chat Oliver',
            'author_id' => 6,
            'created' => '20/5/2000'
        ];

        $response = $this->postJson("/api/chats", $chat);

        $responseStatus->assertStatus(200);
        
        $json = json_decode($response->getContent());
        
        return [
            'id'  => $json->id
        ];
    }
    /**
    * @depends test_chat_can_be_created
    */
    public function test_chat_can_be_retrieved($params)
    {
        //Variables
        $chatid = $params[0];

        //Responses
        $response = $this->get("/api/chats/{$chatid}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_chat_can_be_created
    */
    public function test_chat_can_be_updated($params)
    {
        //Variables
        $chatid = $params[0];

        //Mock data ticket

        $chat = [
            'name' => 'mayonesa'
        ];

        //Responses
        $response = $this->put("/api/chats/{$chatid}", $chat);

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_chat_can_be_created
    */
    public function test_chat_can_be_deleted($params)
    {
        //Variables
        $chatid = $params[0];

        //Responses
        $response = $this->delete("/api/chats/{$chatid}");

        //Assertions
        $response->assertStatus(200);

    }
}
