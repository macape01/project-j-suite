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
            'id' => 1,
            'author_id' => 1,
            'titol' => 'bichota',
        ];

        //Responses
        $response = $this->postJson('/api/tasks', $task_data);

        //Assertions
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);

    }
    public function test_task_can_be_retrieved()
    {
        //Responses
        $response = $this->get('/api/tasks/1');

        //Assertions
        $response->assertStatus(200);

    }
    public function test_task_can_be_updated()
    {
        //Mock data ticket

        $task_data = [
            'titol' => 'cosas',
            'comentari' => 'cositas',
        ];

        //Responses
        $response = $this->put('/api/tasks/1', $task_data);

        //Assertions
        $response->assertStatus(200);

    }
    public function test_task_can_be_deleted()
    {

        //Responses
        $response = $this->delete('/api/tasks/1');

        //Assertions
        $response->assertStatus(200);

    }
}
