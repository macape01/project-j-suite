<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    const TID = 2;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_comments_of_a_ticket_can_be_listed()
    {
        $tid = self::TID;
        $responseStatus = $this->get("/api/tickets/{$tid}/comments");

        $responseStatus->assertStatus(200);

    }

    public function test_comment_of_a_ticket_can_be_created()
    {
        $tid = self::TID;

        $comment_data=[
            'author_id'=>1,
            'msg'=>"2022-02-17 17:49:56",
            'created'=>"2022-02-17 17:49:56",
            'ticket_id'=>$tid
        ];

        $response = $this->postJson("/api/tickets/{$tid}/comments", $comment_data);

        $response->assertStatus(201);

        $json = json_decode($response->getContent());

        return $json->id;
    }
    /**
    * @depends test_comment_of_a_ticket_can_be_created
    */
    public function test_comment_of_a_ticket_can_be_retrieved($id)
    {
        //Variables
        $tid = self::TID;

        //Responses
        $response = $this->get("/api/tickets/{$tid}/comments/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_comment_of_a_ticket_can_be_created
    */
    public function test_comment_of_a_ticket_can_be_updated($id)
    {
        //Variables
        $tid = self::TID;

        //Mock data ticket

        $comment_data = [
            'msg' => 'amor'
        ];

        //Responses
        $response = $this->put("/api/tickets/{$tid}/comments/{$id}", $comment_data);

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_comment_of_a_ticket_can_be_created
    */
    public function test_comment_of_a_ticket_can_be_deleted($id)
    {
        //Variables
        $tid = self::TID;

        //Responses
        $response = $this->delete("/api/tickets/{$tid}/comments/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
