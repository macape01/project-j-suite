<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{

    const TAID = 1;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_note_listed()
    {
        $taid = self::TAID;
        $responseStatus = $this->get("/api/tasks/{$taid}/notes");

        $responseStatus->assertStatus(200);

    }

    public function test_note_can_be_created()
    {
        $taid = self::TAID;

        $note_data = [
            'body' => 'notebichota',
            'task_id' => $taid,
        ];

        //Responses        $response = $this->postJson("/api/notes", $note_data);

        //Assertions
        $response = $this->postJson("/api/tasks/{$taid}/notes", $note_data);

        $response->assertStatus(200);

        $json = json_decode($response->getContent());

        return $json->id;


    }
    /** 
    * @depends test_note_can_be_created 
    */
    public function test_note_can_be_retrieved($id)
    {
        $taid = self::TAID;

        //Responses
        $response = $this->get("/api/tasks/{$taid}/notes/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /** 
    * @depends test_note_can_be_created 
    */
    public function test_note_can_be_updated($id)
    {

        $taid = self::TAID;
        //Mock data ticket

        $note_data = [
            'body' => 'fabricarnar',
        ];

        //Responses
        $response = $this->put("/api/tasks/{$taid}/notes/{$id}", $note_data);

        //Assertions
        $response->assertStatus(200);

    }
    /** 
    * @depends test_note_can_be_created 
    */
    public function test_note_can_be_deleted($id)
    {
        $taid = self::TAID;
        //Responses
        $response = $this->delete("/api/tasks/{$taid}/notes/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}

