<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_note_listed()
    {
            //Responses
            $responseStatus = $this->get("/api/notes");
            $response = $this->getJson("/api/notes");
            
            //Assertions
            $responseStatus->assertStatus(200);
    }

    public function test_note_can_be_created()
    {

        $note_data = [
            'body' => 'notebichota',
        ];

        //Responses        $response = $this->postJson("/api/notes", $note_data);

        //Assertions
        $response->assertStatus(200);
        $json = json_decode($response->getContent());
        return $json->id;


    }
    /** 
    * @depends test_note_can_be_created 
    */

    public function test_note_can_be_retrieved($params)
    {
        $id = $params[0];
        $taid = $params[1];

        //Responses
        $response = $this->get("/api/task/{$taid}/notes");

        //Assertions
        $response->assertStatus(200);

    }
    /** 
    * @depends test_note_can_be_created 
    */
    public function test_note_can_be_updated($params)
    {
        $id = $params[0];
        $taid = $params[1];
        //Mock data ticket

        $note_data = [
            'body' => 'fabricarnar',
        ];

        //Responses
        $response = $this->put("/api/task/{$taid}/notes/{$id}", $note_data);

        //Assertions
        $response->assertStatus(200);

    }
    /** 
    * @depends test_note_can_be_created 
    */
    public function test_note_can_be_deleted($params)
    {
        $id = $params[0];
        $taid = $params[1];

        //Responses
        $response = $this->delete("/api/task/{$taid}/notes{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}

