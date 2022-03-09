<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusTest extends TestCase
{
    const TID = 2;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_statuses_can_be_listed()
    {
        $tid = self::TID;
        $responseStatus = $this->get("/api/statuses");

        $responseStatus->assertStatus(200);

    }

    public function test_status_created()
    {
        $tid = self::TID;

        $status=[
            'name'=>'acabado'
        ];

        $response = $this->postJson("/api/statuses", $status);

        $response->assertStatus(200);

        $json = json_decode($response->getContent());

        return $json->id;
    }
    /**
    * @depends test_status_created
    */
    public function test_status_can_be_retrieved($id)
    {

        //Responses
        $response = $this->get("/api/statuses/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_status_created
    */
    public function test_status_can_be_updated($id)
    {

        //Mock data ticket

        $status = [
            'name' => 'amor'
        ];

        //Responses
        $response = $this->put("/api/statuses/{$id}", $status);

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_status_created
    */
    public function test_status_can_be_deleted($id)
    {

        //Responses
        $response = $this->delete("/api/statuses/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
