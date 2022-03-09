<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompletionTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_completion_listed()
    {

            //Responses
            $responseStatus = $this->get("/api/completions");
            
            //Assertions
            $responseStatus->assertStatus(200);
            /* $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll('id', 'description', 'title', 'assigned_id', 'asset_id')
            ); */

    }

    public function test_completion_can_be_created()
    {
        $completion_data = [
            'name' => 'minombre',
        ];

        //Responses
        $response = $this->postJson("/api/completions", $completion_data);

        //Assertions
        $response->assertStatus(200);

        $json = json_decode($response->getContent());

        return $json->id;
    }
    /**
    * @depends test_completion_can_be_created
    */
    public function test_completion_can_be_retrieved($id)
    {
        {
            //Responses
            $response = $this->get("/api/completions/{$id}");
    
            //Assertions
            $response->assertStatus(200);
    
        }

    }
    /**
    * @depends test_completion_can_be_created
    */
    public function test_completion_can_be_updated($id)
    {
        //Mock data ticket

        $completion_data = [
            'name' => 'si',
        ];

        //Responses
        $response = $this->put("/api/completions/{$id}", $completion_data);

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_completion_can_be_created
    */
    public function test_completion_can_be_deleted($id)
    {
        //Variables

        //Responses
        $response = $this->delete("/api/completions/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
