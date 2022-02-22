<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;



class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tasks_listed()
    {

            //Responses
            $responseStatus = $this->get('/api/tasks');

            $response = $this->getJson('/api/tasks');
            
            //Assertions
            $responseStatus->assertStatus(200);
            /* $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll('id', 'description', 'title', 'assigned_id', 'asset_id')
            ); */
    }

    public function test_task_can_be_created()
    {
        //Mock data ticket

        $task_data = [
            'comentari' => 'jeepeta',
            'author_id' => 1,
            'titol' => 'bichota',
        ];

        //Responses
        $response = $this->postJson('/api/tasks', $task_data);

        //Assertions
        $response->assertStatus(200);
        $json = json_decode($response->getContent());
        return $json->id;

    }
    /** 
    * @depends test_task_can_be_created 
    */

    public function test_task_can_be_retrieved($id)
    {
        //Responses
        $response = $this->get('/api/tasks/{$id}');

        //Assertions
        $response->assertStatus(200);

    }
    /** 
    * @depends test_task_can_be_created 
    */
    public function test_task_can_be_updated($id)
    {
        //Mock data ticket

        $task_data = [
            'titol' => 'preg',
            'comentari' => 'nat',
        ];

        //Responses
        $response = $this->put("/api/tasks/{$id}", $task_data);

        //Assertions
        $response->assertStatus(200);

    }
    /** 
    * @depends test_task_can_be_created 
    */
    public function test_task_can_be_deleted($id)
    {

        //Responses
        $response = $this->delete("/api/tasks/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
