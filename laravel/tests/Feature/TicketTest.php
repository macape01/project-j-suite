<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    /**
     * A test to check if a ticket can be listed
     *
     * @return void
     */
    public function test_tickets_can_be_listed()
    {
        //Responses
        $responseStatus = $this->get('/api/tickets');

        $response = $this->getJson('/api/tickets');
        
        //Assertions
        $responseStatus->assertStatus(200);
        /* $response->assertJson(fn (AssertableJson $json) =>
        $json->hasAll('id', 'description', 'title', 'assigned_id', 'asset_id')
        ); */

    }
    public function test_ticket_can_be_created()
    {
        //Mock data ticket

        $ticket_data=[
            'title'=>'sexo en New TICKET',
            'description'=>'no se pudo rodar por falta de LOS FATALISIMOS TICKETSSSSSSS',
            'assigned_id'=>1,
            'asset_id'=>2,
            'author_id'=>1,
            'status_id'=>1
        ];

        //Responses
        $response = $this->postJson('/api/tickets', $ticket_data);

        //Assertions
        $response->assertStatus(200);
        
        $json = json_decode($response->getContent());
        
        return $json->id;

    }
    /**
    * @depends test_ticket_can_be_created
    */
    public function test_ticket_can_be_retrieved($id)
    {
        //Responses
        $response = $this->get("/api/tickets/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_ticket_can_be_created
    */
    public function test_ticket_can_be_updated($id)
    {
        //Mock data ticket

        $ticket_data = [
            'description' => 'amor',
            'title' => 'foda',
        ];

        //Responses
        $response = $this->put("/api/tickets/{$id}", $ticket_data);

        //Assertions
        $response->assertStatus(200);

    }
    /**
    * @depends test_ticket_can_be_created
    */
    public function test_ticket_can_be_deleted($id)
    {

        //Responses
        $response = $this->delete("/api/tickets/{$id}");

        //Assertions
        $response->assertStatus(200);

    }
}
